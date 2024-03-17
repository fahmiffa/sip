<!DOCTYPE html>
<html>

<head>
    <title>{{env('APP_NAME')}} | {{env('APP_TAG')}}</title>
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
                        <span style="font-weight: bold; font-size:0.8rem;text-wrap:none">BERITA ACARA RAPAT PLENO (BARP)</span>
                        <br>No.&nbsp;&nbsp;{{(str_replace('SPm','BARP',str_replace('600.1.15','600.1.15/PBLT',$head->nomor)))}}
                    </p>
                </td>
                <td style="border:none"><img class="img" src="{{ gambar('logo.png') }}" /></td>
            </tr>
        </table>
    </header>
    @php  
        $header = (array) json_decode($news->doc->header); 
        $mheader = json_decode($meet->header); 
        $items = json_decode($meet->item);  
        $item = (array) json_decode($news->item);
        $umum = $item['informasi_umum'];
        $bangunan = $item['informasi_bangunan_gedung'];
    @endphp

    <p>Sehubungan telah dilakukannya Konsultasi dengan TPT/TPA DPUPR Kabupaten Tegal pada :</p>
    <table style="width:98%" align="center">        
            <tr>
                <td width="40%" style="border:none">Hari / Tanggal</td>
                <td width="60%" style="border:none">: {{dateID($meet->tanggal)}} </td>
                <td width="40%" style="border:none">Permohonan </td>
                <td width="60%" style="border:none">: {{strtoupper($header[1])}}</td>
            </tr>
            <tr>
                <td width="40%" style="border:none">No. Registrasi PBG</td>
                <td width="60%" style="border:none">: {{$header[0]}}</td>
                <td width="40%" style="border:none"></td>
                <td width="60%" style="border:none"></td>
            </tr>              
    </table> 
    <p>Atas pengajuan Persetujuan Bangunan Gedung :</p>
    <table style="width:98%;" align="center">
        <tbody>  
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
            <tr>
                <td width="40%" style="border:none">Status Kepemilikan</td>
                <td width="60%" style="border:none">: {{ucwords($mheader->status)}}</td>
                <td width="40%" style="border:none">NIB </td>
                <td width="60%" style="border:none">: {{$mheader->nib}}</td>
            </tr>    
            <tr>
                <td width="40%" style="border:none">Jenis Permohonan</td>
                <td width="60%" style="border:none">: {{ucwords($mheader->jenis)}}</td>
                <td width="40%" style="border:none"></td>
                <td width="60%" style="border:none"></td>
            </tr>   
            <tr>
                <td width="40%" style="border:none">Fungsi Bangunan</td>
                <td width="60%" style="border:none">: {{ucwords($mheader->jenis)}}</td>
                <td width="40%" style="border:none"></td>
                <td width="60%" style="border:none"></td>
            </tr>      


        </tbody>
    </table>  

    <p>Sebagaimana terlampir pada Lembar Berita Acara Konsultasi
        No.
        {{ str_replace('SPm', 'BAK', str_replace('600.1.15', '600.1.15/PBLT', $meet->doc->nomor)) }}
        yang
        merupakan bagian tidak terpisahkan dari Berita Acara Rapat Pleno ini,
        TPT/TPA memberikan masukkan:
        <br>
        {{$items->item[0]}}
    </p>

    <p>Dan dengan pertimbangan bahwa :<br>{{$items->item[1]}}</p>
    Memutuskan untuk :   
    <table style="width:100%;">   
        <tr>
            <td width="3%" style="border: none;vertical-align:top">&#x2611;</td>
            <td style="border: none;vertical-align:top">Merekomendasikan penerbitan Surat Pernyataan Pemenuhan Standar Teknis PBG dan/atau SLF dengan :													
            </td>
        </tr>       
    </table>
    <table style="width:98%;">   
        <tr align="center">
            <td>Uraian</td>
            <td>Pengajuan</td>
            <td>Disetujui</td>           
            <td>Keterangan</td>           
        </tr>    
        <tr>
            <td style="padding: 0.3rem">Luas Total Bangunan termasuk <br> Luas Total Basement (LLt)									
            </td>
            @foreach($items->luas as $key => $val)
            <td style="padding: 0.3rem">{{$val}}</td>
            @endforeach       
        </tr>   
        <tr>
            <td style="padding: 0.3rem">Prasarana (jika ada)																	
            </td>
            @foreach($items->pra as $key => $val)
            <td style="padding: 0.3rem">{{$val}}</td>
            @endforeach              
        </tr>       
    </table>
    <table style="width:100%;">   
        <tr>
            <td width="3%" style="border: none;vertical-align:top">&#x2611;</td>
            <td style="border: none;vertical-align:top">Merekomendasikan pemohon untuk memperbaiki
                dokumen / informasi yang diunggah melalui SIMBG</td>
        </tr>
        <tr>
            <td style="border: none;vertical-align:top">&#x2611;</td>
            <td style="border: none;vertical-align:top">
                Merekomendasikan pemohon untuk melakukan
                pendaftaran ulang PBG dan/atau SLF melalui SIMBG</td>
        </tr>
        <tr>
            <td style="border: none;vertical-align:top">&#x2611;</td>
            <td style="border: none;vertical-align:top">
                Proses PBG dan/atau SLF tidak dapat dilanjutkan
                / ditolak</td>
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
            <td width="60%" style="border: none" align="center">
            </td> 
            <td style="border: none" align="center">
                <p>Mengetahui,<br>
                    Ketua TPT/TPA Kab. Tegal
                </p>
                    @if($news->sign)
                    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('storage/'.$news->sign))) }}"  width="50%"  style="margin: auto">
                    <br>
                    @else
                    <br><br><br><br>
                    @endif
                    {{$head->kons->not->name}}		
            </td>    
        </tr>    
    </table>        
</body>

</html>
