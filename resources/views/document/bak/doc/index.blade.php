<!DOCTYPE html>
<html>
<head>
    <title>{{env('APP_NAME')}} | {{env('APP_TAG')}}</title>
    <link rel="shortcut icon" href="{{asset('assets/logo.png')}}" type="image/x-icon">    
</head>
<style>
    body {
        font-size: 12px;
        font-family: DejaVu Sans;
    }

    table {
        border-collapse: collapse;
        border-spacing: 0;
    }

    td {
        border: 1px solid black;
    }

    .img {
        object-fit: cover;
        width: 50px;
        height: 50px;
    }
</style>
<body>
    <header >
        <table style="width: 100%; border:none">
            <tr>
                <td style="border:none"><img class="img" src="{{ gambar('kab.png') }}" /></td>
                <td width="100%" style="border:none; text-align:center">
                    <p>
                        <span style="font-weight: bold; font-size:0.8rem;text-wrap:none">BERITA ACARA KONSULTASI (BAK)</span>
                        <br>No.&nbsp;&nbsp;{{(str_replace('SPm','BAK',str_replace('600.1.15','600.1.15/PBLT',$head->nomor)))}}
                    </p>
                </td>
                <td style="border:none"><img class="img" src="{{ gambar('logo.png') }}" /></td>
            </tr>
        </table>
    </header>
    @php  
        $header = (array) json_decode($head->header); 
        $item = (array) json_decode($news->item);
        $umum = $item['informasi_umum'];
        $bangunan = $item['informasi_bangunan_gedung'];
    @endphp
    <table style="width:100%" align="center">
        <tbody>
            <tr>
                <td width="40%" style="border:none">No. Registrasi </td>
                <td width="60%" style="border:none">: {{$header[0]}} </td>
                <td width="40%" style="border:none">Pengajuan </td>
                <td width="60%" style="border:none">: {{$header[1]}}</td>
            </tr>
            <tr>
                <td width="40%" style="border:none">Nama Pemohon </td>
                <td width="60%" style="border:none">: {{$header[2]}}</td>
                <td width="40%" style="border:none">No. Telp. / HP </td>
                <td width="60%" style="border:none">: {{$header[3]}}</td>
            </tr>
            <tr>
                <td width="40%" style="border:none">Alamat Pemohon </td>
                <td width="60%" style="border:none">: {{$header[4]}}</td>
            </tr>
            <tr>
                <td width="40%" style="border:none">Nama Bangunan </td>
                <td width="60%" style="border:none">: {{$header[5]}}</td>
                <td width="40%" style="border:none">Fungsi </td>
                <td width="60%" style="border:none">: {{$header[6]}}</td>
            </tr>
            <tr>
                <td width="40%" style="border:none;vertical:align:top">Alamat Bangunan </td>
                <td colspan="3" style="border:none;vertical-align:top">
                    : {{$header[7]}}, Kec. {{$head->region->name}}, Kab. {{$head->region->kecamatan->name}}                  
                </td>
            </tr>      
        </tbody>
    </table>    
    <table style="width:100%;" align="center">
        <tbody>         
            @php
                $area = json_decode($news->header);              
            @endphp
            <tr>
                <td width="40%" style="border:none">Batas Lahan / Lokasi </td>
                <td style="border:none" width="30%">: Utara </td>                
                <td style="border:none" width="30%">: {{$area->north}}</td>
                <td style="border:none" width="40%">Timur </td>                
                <td style="border:none" width="60%">: {{$area->east}}</td>
            </tr>
            <tr>
                <td width="40%" style="border:none"></td>
                <td style="border:none">&nbsp;&nbsp;&nbsp;Selatan </td>                
                <td style="border:none">: {{$area->south}}</td>
                <td style="border:none">Barat </td>                
                <td style="border:none">: {{$area->west}}</td>
            </tr>
        </tbody>
    </table>    
    <table style="width:100%;" align="center">
        <tr>
            <td width="40%" style="border:none">Kondisi </td>       
            <td width="60%" style="border:none">: {{ucwords($area->kondisi)}} </td> 
            <td width="40%" style="border:none">Tahun Pembangunan</td>       
            <td width="60%" style="border:none">: {{$news->plan}} </td>       
        </tr>
        <tr>
            <td width="40%" style="border:none">Tingkat Permanen </td>       
            <td width="60%" style="border:none">: {{ucwords(str_replace('_',' ',$area->permanensi))}} </td>     
        </tr>
    </table>
    <table style="width:100%;margin-top:1rem;margin-bottom:1rem">
        <tr>
            <td colspan="3" style="border: none">Informasi Umum :</td>
            <td colspan="3" style="border: none">Informasi Bangunan Gedung :</td>
        </tr>
        <tr>
            <td align="center">Uraian</td>
            <td align="center">Dimensi</td>
            <td style="border: none"></td>
            <td align="center">Uraian</td>
            <td align="center">Dimensi</td>
            <td align="center">Catatan</td>
        </tr>
        @for ($i = 0; $i < count($bangunan); $i++)
        <tr>
            @isset($umum[$i])
            <td>&nbsp;&nbsp;{{$umum[$i]->uraian}}</td>
            <td>&nbsp;&nbsp;{{$umum[$i]->value}}</td>
            @else
            <td></td>
            <td></td>
            @endif
    
            <td style="border: none"></td>
    
            <td>&nbsp;&nbsp;{{ucwords(str_replace('_',' ',$bangunan[$i]->uraian))}}</td>
            <td>&nbsp;&nbsp;{{$bangunan[$i]->dimensi}}</td>
            <td>&nbsp;&nbsp;{{$bangunan[$i]->note}}</td>
        </tr>            
        @endfor
    </table> 
    <table style="width:100%;">
        <tr>
            <td style="border: none">Informasi Dimensi Bangunan dan Prasarana :</td>
            <td style="border: none">Informasi Dimensi Prasarana :</td>
        </tr>
        <tr>
            <td align="center">Bangunan Gedung</td>
            <td align="center">Prasarana</td>                
        </tr>
        <tr>
            <td>&nbsp;&nbsp;{{$item['idb'][1]}}</td>
            <td>&nbsp;&nbsp;{{$item['idp'][1]}}</td>
        </tr>
    </table> 
    <p>Saran :<br>
        {{$news->note}}
    </p>    
    <table style="width:100%;">
        <tr>
            <td style="border: none" colspan="2">Dengan ditandatanganinya Berita Acara ini, maka Pemohon bersedia untuk :</td>
        </tr>
        <tr>
            <td width="3%" style="border: none;vertical-align:top">&#x2611;</td>
            <td style="border: none;vertical-align:top">Bertanggungjawab terhadap seluruh dokumen dan sebab akibat adanya bangunan yang diajukan</td>
        </tr>
        <tr>
            <td style="border: none;vertical-align:top">&#x2611;</td>
            <td style="border: none;vertical-align:top">Pemohon bersedia mematuhi dan memenuhi persyaratan administrasi dan teknis sesuai persyaratan yang berlaku</td>
        </tr>
        <tr>
            <td style="border: none;vertical-align:top">&#x2611;</td>
            <td style="border: none;vertical-align:top">Pemohon bersedia melakukan pembayaran retribusi sesuai perhitungan nilai retribusi yang dikenakan</td>
        </tr>
    </table>    
    <p>Demikian hasil konsultasi TPT/TPA yang dihadiri oleh:</p>
    <ol>    
        @foreach($head->kons->kons as $val)
        <li>{{$val}}</li>
        @endforeach
    </ol>  
    <table style="width:100%;">
        <tr>      
            <td style="border: none" align="center">
                <p>Mengetahui,<br>
                    Ketua TPT/TPA Kab. Tegal
                </p>
                    @if($news->sign)
                    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('storage/'.$news->sign))) }}"  width="20%"  style="margin: auto">
                    <br>
                    @else
                    <br><br><br><br>
                    @endif
                    {{$head->kons->not->name}}		
            </td>
            <td style="border: none" align="center">Setuju hasil pemeriksaan<br>Pemohon PBG<br>
                @if($news->signs)
                <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('storage/'.$news->signs))) }}"  width="20%"  style="margin: auto">
                <br>
                @else
                <br><br><br><br>
                @endif	
                {{$header[2]}}
            </td>
        </tr>    
    </table>        
</body>
</html>
