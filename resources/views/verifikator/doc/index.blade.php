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

    <main style="margin-top: 1rem">
        <p style="font-weight: bold; margin-top:1rem;">{{ $docs->tag }}</p>
        <table autosize="1" style="width: 100%">
            <tbody>
              {{-- dokumen_administrasi --}}
                <tr style="font-weight: bold;">
                    <td width="5%" align="center">A.</td>
                    <td colspan="2" width="50%">&nbsp;Dokumen Administrasi</td>
                    <td width="10%" align="center">Status</td>
                    <td width="35%" align="center">Catatan / Saran</td>
                </tr>
                @php                     
                  $da = json_decode($head->steps[0]->item);       
                  $item = (array) $da->dokumen_administrasi->item;  
                  $saranItem = (array) $da->dokumen_administrasi->saranItem;   
                  $sub = (array) $da->dokumen_administrasi->sub;                 
                @endphp

                @foreach($item as $key => $value)
                    <tr>
                        <td style="text-align: right; vertical-align:top">{{$loop->iteration}}&nbsp;</td>
                        <td colspan="2">&nbsp;{{named($key,'item')}}
                        <td align="center">{{status($value)}}</td>
                        <td>&nbsp;{{$saranItem[$key]}}</td>
                    </tr>                    
                @endforeach        

                
                @foreach($sub as $key => $value)
                    <tr>
                        <td style="text-align: right; vertical-align:top">7&nbsp;</td>
                        <td colspan="2">&nbsp;{{named($value->title,'item')}}</td>
                        <td></td>
                        <td></td>
                    </tr>
                     @php $saran = (array) $value->saran @endphp
                    @foreach($value->value as $key => $value)
                        <tr>
                            <td></td>
                            <td width="1%" style="vertical-align:top;border-right:0px">&nbsp;{{abjad($loop->index)}}. </td>
                            <td style="border-left:0px">&nbsp;{{named($key,'sub')}}</td>
                            <td align="center">{{status($value)}}</td>
                            <td align="center">{{$saran[$key]}}</td>
                        </tr>   
                    @endforeach
                @endforeach        

                @if($head->type == 'umum')
                    {{-- dokumen teknis --}}
                    <tr style="font-weight: bold;">
                        <td style="text-align: center">B.</td>
                        <td colspan="4">&nbsp;Dokumen Teknis</td>
                    </tr>

                    @php                   
                    $sub = (array) $da->dokumen_teknis->sub;
                    @endphp
                    @foreach($sub as $key => $value)
                        <tr>
                            <td style="text-align: right; vertical-align:top">{{$loop->iteration}}&nbsp;</td>
                            <td colspan="2">&nbsp;{{named($value->title,'item')}}</td>
                            <td></td>
                            <td></td>
                        </tr>
                        @php $saran = (array) $value->saran @endphp
                        @foreach($value->value as $key => $value)
                            <tr>
                                <td></td>
                                <td width="1%" style="vertical-align:top;border-right:0px">&nbsp;{{abjad($loop->index)}}. </td>
                                <td style="border-left:0px">&nbsp;{{named($key,'sub')}}</td>
                                <td align="center">{{status($value)}}</td>
                                <td align="center">{{$saran[$key]}}</td>
                            </tr>   
                        @endforeach
                    @endforeach      
            
                    {{-- dokumen pendukung --}}
                    <tr style="font-weight: bold;">
                        <td style="text-align: center">C.</td>
                        <td colspan="4">&nbsp;Dokumen Pendukung Lainnya (Untuk SLF)</td>
                    </tr>

                    @php                          
                    $item = (array) $da->dokumen_pendukung_lainnya->item;
                    $saranItem = (array) $da->dokumen_pendukung_lainnya->saranItem;   
                    $sub = (array) $da->dokumen_pendukung_lainnya->sub;   
                    @endphp

                    @foreach($item as $key => $value)
                        @if($value != 2)
                            <tr>
                                <td style="text-align: right; vertical-align:top">{{$loop->iteration}}&nbsp;</td>
                                <td colspan="2">&nbsp;{{named($key,'item')}}
                                <td align="center">{{status($value)}}</td>
                                <td>&nbsp;{{$saranItem[$key]}}</td>
                            </tr>          
                        @endif          
                    @endforeach        


                    @foreach($sub as $key => $value)
                        <tr>
                            <td style="text-align: right; vertical-align:top">{{$loop->iteration}}&nbsp;</td>
                            <td colspan="2">&nbsp;{{named($value->title,'item')}}</td>
                            <td></td>
                            <td></td>
                        </tr>
                        @php $saran = (array) $value->saran @endphp
                        @foreach($value->value as $key => $value)
                            <tr>
                                <td></td>
                                <td width="1%" style="vertical-align:top;border-right:0px">&nbsp;{{abjad($loop->index)}}. </td>                            
                                <td style="border-left:0px">&nbsp;{{named($key,'sub')}}</td>
                                <td align="center">{{status($value)}}</td>
                                <td align="center">{{$saran[$key]}}</td>
                            </tr>   
                        @endforeach
                    @endforeach   
                @else
                    {{-- dokumen persyaratan teknis --}}
                    <tr style="font-weight: bold;">
                        <td style="text-align: center">C.</td>
                        <td colspan="4">&nbsp;Dokumen Pendukung Lainnya (Untuk SLF)</td>
                    </tr>

                    @php                          
                        $item = (array) $da->persyaratan_teknis->item;
                        $saranItem = (array) $da->persyaratan_teknis->saranItem;   
                        $sub = (array) $da->persyaratan_teknis->sub;   
                    @endphp

                    @foreach($item as $key => $value)
                        @if($value != 2)
                            <tr>
                                <td style="text-align: right; vertical-align:top">{{$loop->iteration}}&nbsp;</td>
                                <td colspan="2">&nbsp;{{named($key,'item')}}
                                <td align="center">{{status($value)}}</td>
                                <td>&nbsp;{{$saranItem[$key]}}</td>
                            </tr>          
                        @endif          
                    @endforeach        


                    @foreach($sub as $key => $value)
                        <tr>
                            <td style="text-align: right; vertical-align:top">{{$loop->iteration}}&nbsp;</td>
                            <td colspan="2">&nbsp;{{named($value->title,'item')}}</td>
                            <td></td>
                            <td></td>
                        </tr>
                        @php $saran = (array) $value->saran @endphp
                        @foreach($value->value as $key => $value)
                            <tr>
                                <td></td>
                                <td width="1%" style="vertical-align:top;border-right:0px">&nbsp;{{abjad($loop->index)}}. </td>                            
                                <td style="border-left:0px">&nbsp;{{named($key,'sub')}}</td>
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
</body>

</html>
