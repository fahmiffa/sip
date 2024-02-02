<!DOCTYPE html>
<html>

<head>
    <title>{{ env('APP_NAME') }}</title>
</head>
<style>
    body {
        font-size: 12px;
    }

    table {
        border-collapse: collapse;
        border-spacing: 0;
    }

    td {
        border: 1px solid black;
    }

    img {
        object-fit: cover;
        width: 50px;
        height: 50px;
    }
</style>

<body>
    @include('verifikator.doc.header')

    @if($head->steps->count() > 0)
    @php
    $no = 1;
    $doc = $head->steps->where('kode','VL3')->first();
    $doc2 = $head->steps->where('kode','VL2')->first();    
    @endphp
    <main style="margin-top: 1rem">
        <p style="font-weight: bold; margin-top:1rem;">{{ $docs->tag }}</p>
        <table autosize="1" style="width: 100%">
            <tbody>
            
                {{-- dokumen_administrasi --}}
                @if($doc)
                    <tr style="font-weight: bold;">
                        <td width="5%" align="center">A.</td>
                        <td colspan="2" width="50%">Dokumen Administrasi</td>
                        <td width="10%" align="center">Status</td>
                        <td width="35%" align="center">Catatan / Saran</td>
                    </tr>
                    @php              
                    $da = json_decode($doc->item);          
                    $item = (array) $da->dokumen_administrasi->item;
                    $saranItem = (array) $da->dokumen_administrasi->saranItem;   
                    $sub = (array) $da->dokumen_administrasi->sub;                 
                    @endphp

                    @foreach($item as $key => $value)
                        <tr>
                            <td style="text-align: right; vertical-align:top">{{$no++}}&nbsp;</td>
                            <td colspan="2">{{named($key,'item')}}
                            <td align="center">{{status($value)}}</td>
                            <td align="center">&nbsp;{{$saranItem[$key]}}</td>
                        </tr>                    
                    @endforeach        

                    
                    @foreach($sub as $key => $value)
                        <tr>
                            <td style="text-align: right; vertical-align:top">{{$no++}}&nbsp;</td>
                            <td colspan="2">{{named($value->title,'item')}}</td>
                            <td></td>
                            <td></td>
                        </tr>
                        @php $saran = (array) $value->saran @endphp
                        @foreach($value->value as $key => $value)
                            <tr>
                                <td></td>
                                <td width="1%" style="vertical-align:top;border-right:0px">&nbsp;{{abjad($loop->index)}}. </td>
                                <td style="border-left:0px">{{named($key,'sub')}}</td>
                                <td align="center">{{status($value)}}</td>
                                <td align="center">{{$saran[$key]}}</td>
                            </tr>   
                        @endforeach
                    @endforeach        
                @endif


                @if($doc2)
                    @php           
                    $da = json_decode($doc2->item);        
                    $sub = (array) $da->dokumen_teknis->sub;
                    @endphp

                    <tr style="font-weight: bold;">
                        <td width="5%" style="text-align: center">B.</td>
                        @if($head->type == 'umum')                        
                            <td width="5%" colspan="4">Dokumen Teknis</td>
                        @else
                            <td colspan="4">Persyaratan Teknis</td>
                        @endif
                    </tr>

                    @foreach($sub as $key => $value)
                        <tr>
                            <td style="text-align: right; vertical-align:top">{{$loop->iteration}}&nbsp;</td>
                            <td colspan="2">{{named($value->title,'item')}}</td>
                            <td></td>
                            <td></td>
                        </tr>
                        @php $saran = (array) $value->saran @endphp
                        @foreach($value->value as $key => $value)
                            <tr>
                                <td></td>
                                <td width="1%" style="vertical-align:top;border-right:0px">&nbsp;{{abjad($loop->index)}}. </td>
                                <td style="border-left:0px">{{named($key,'sub')}}</td>
                                <td align="center">{{status($value)}}</td>
                                <td align="center">{{$saran[$key]}}</td>
                            </tr>   
                        @endforeach
                    @endforeach      
                @endif                          
              
            </tbody>
        </table>
    </main>
    @include('verifikator.doc.footer')
    @endif

</body>

</html>
