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
    <table style="width: 100%; border:none">
        <tr>
            <td style="border:none"><img class="img" src="{{ gambar('kab.png') }}" /></td>
            <td width="100%" style="border:none; text-align:center">
                <p>
                    <span style="font-weight: bold; font-size:0.8rem;text-wrap:none">PERHITUNGAN RETRIBUSI PERSETUJUAN BANGUNAN GEDUNG</span>                    
                </p>
            </td>
            <td style="border:none"><img class="img" src="{{ gambar('logo.png') }}" /></td>
        </tr>
    </table>
    
    @php  
      $header = (array) json_decode($head->header); 
      $parameter = json_decode($head->tax->parameter);
      $par = $parameter->par;
      $gedung = json_decode($head->tax->gedung);  
      $pra = json_decode($head->tax->prasarana);       
      $luas = 0;
      $total = 0;
    @endphp
    <h4>A. INFORMASI UMUM</h4>
    <table style="width:95%;" align="center">        
        <tr>
            <td width="40%" style="border:none">No. Registrasi PBG </td>
            <td width="60%" style="border:none">: {{$header[0]}} </td>
            <td width="40%" style="border:none">Tanggal</td>
            <td width="60%" style="border:none">: {{ dateID($head->tax->tanggal) }}</td>
        </tr>
        <tr>
            <td width="40%" style="border:none">Nama Pemohon </td>
            <td width="60%" style="border:none">: {{$header[2]}}</td>
            <td width="40%" style="border:none"></td>
            <td width="60%" style="border:none"></td>
        </tr>
        <tr>
            <td width="40%" style="border:none">Alamat Pemohon </td>
            <td width="60%" style="border:none">: {{$header[4]}}</td>
        </tr>
        <tr>
            <td width="40%" style="border:none">Nama Bangunan </td>
            <td width="60%" style="border:none">: {{$header[5]}}</td>
            <td width="40%" style="border:none"></td>
            <td width="60%" style="border:none"></td>
        </tr>
        <tr>
            <td width="40%" style="border:none;vertical:align:top">Alamat Bangunan </td>
            <td colspan="3" style="border:none;vertical-align:top">
                : {{$header[7]}}, Kec. {{$head->region->name}}, Kab. {{$head->region->kecamatan->name}}                  
            </td>
        </tr>    
    </table> 
    <h4>B. PARAMETER</h4>
    <table style="width: 98%">
        <tr align="center" style="background-color:lightgrey">
           <td>No.</td>
           <td>Uraian</td>
           <td>Indexs</td>
        </tr>
        <tr>
            <td align="center">1</td>
            <td style="padding:0.2rem">Fungsi Bangunan <i>(If)</i></td>
            <td style="padding:0.2rem">{{$par[0]}}</td>
        </tr>
        <tr>
            <td align="center">2</td>
            <td style="padding:0.2rem">Kompleksitas <i>(Ik)</i></td>
            <td style="padding:0.2rem">{{$par[1]}}</td>
        </tr>
        <tr>
            <td align="center">3</td>
            <td style="padding:0.2rem">Tingkat Permanensi <i>(Ip)</i></td>
            <td style="padding:0.2rem">{{$par[3]}}</td>
        </tr>
        <tr>
            <td align="center">4</td>
            <td style="padding:0.2rem">Jumlah Lantai <i>(Il)</i></td>
            <td style="padding:0.2rem">{{$par[4]}}</td>
        </tr>
        <tr>
            <td align="center">5</td>
            <td style="padding:0.2rem">Status Kepemilikan <i>(Fm)</i></td>
            <td style="padding:0.2rem">{{$par[5]}}</td>
        </tr>
        <tr>
            <td align="center">6</td>
            <td style="padding:0.2rem">Indeks Terintegrasi <i>(It)</i></td>
            <td style="padding:0.2rem">{{$par[6]}}</td>
        </tr>
        <tr>
            <td align="center">7</td>
            <td style="padding:0.2rem">Indeks BG Terbangun <i>(Ibg)</i></td>
            <td style="padding:0.2rem">{{$par[7]}}</td>
        </tr>
        <tr>
            <td align="center">8</td>
            <td style="padding:0.2rem">Indeks Lokalitas <i>(Ilo)</i></td>
            <td style="padding:0.2rem">{{$par[8]}}</td>
        </tr>
        <tr>
            <td align="center">9</td>
            <td style="padding:0.2rem">SHST Tahun 2023</td>
            <td style="padding:0.2rem">{{$par[5]}}</td>
        </tr>
    </table>
    <h4>C. PERHITUNGAN NILAI RETRIBUSI BANGUNAN GEDUNG</h4>
    <table style="width: 98%">
        <tr align="center" style="background-color:lightgrey">
           <td>No.</td>
           <td>Uraian</td>
           <td>Luas (m<sup>2</sup>)</td>
        </tr>
        @for($i=0;$i < count($gedung); $i++)
        <tr>
            <td align="center">{{$i+1}}</td>
            <td style="padding:0.2rem">{{$gedung[$i]->uraian}}</td>
            <td style="padding:0.2rem">{{$gedung[$i]->luas}}</td>
        </tr>        
        @php
            $luas += $gedung[$i]->luas;
        @endphp
        @endfor

        @php
          $nilai = $par[6]*$par[7]*$par[8]*$luas
        @endphp
        <tr style="background-color:lightgrey">
            <td colspan="2" style="text-align:right">Luas Total Bangunan <i>(LLt)</i>&nbsp;</td>
            <td>{{$luas}}</td>
        </tr>
        <tr style="background-color:ivory">
            <td colspan="2" style="text-align:right">NILAI RETRIBUSI BANGUNAN GEDUNG&nbsp;<br>&nbsp;<i>(It x Ibg x Ilo x SHST x LLt)</i>&nbsp;</td>
            <td>{{$nilai}}</td>
        </tr>
    </table>
    <h4>D. PERHITUNGAN NILAI RETRIBUSI PRASARANA</h4>
    <table style="width: 98%">
        <tr align="center" style="background-color:lightgrey">
           <td>No.</td>
           <td>Uraian</td>
           <td>Volume</td>
           <td>Sat.</td>
           <td>Harga Satuan.</td>
           <td>Jumlah Harga</td>
        </tr>
        @for($i=0;$i < count($pra); $i++)
        <tr>
            <td align="center">{{$i+1}}</td>
            <td style="padding:0.2rem">{{$pra[$i]->uraian}}</td>
            <td style="padding:0.2rem">{{$pra[$i]->volume}}</td>
            <td style="padding:0.2rem">{{$pra[$i]->satuan}}</td>
            <td style="padding:0.2rem">{{$pra[$i]->harga}}</td>
            <td style="padding:0.2rem">{{$pra[$i]->jumlah}}</td>
        </tr>        
        @php
         $total += $pra[$i]->jumlah;
        @endphp
        @endfor
        <tr style="background-color:ivory">
            <td colspan="5" style="text-align:right">NILAI RETRIBUSI PRASARANA&nbsp;</td>
            <td>{{$total}}</td>
        </tr>
    </table>
    <p>Catatan :</p>
    <ol>
        <li>Perhitungan Retribusi ini merupakan simulasi dengan mengacu pada Perda Kab. Tegal Nomor 12 Tahun 2021 tentang Retribusi Daerah																			
        </li>
        <li>Dokumen ini BUKAN merupakan PBG / Bukti Penagihan / Bukti Pembayaran yang sah, proses penagihan dan pembayaran  tetap mengacu pada SKRD yang dikeluarkan oleh DPMPTSP																		
        </li>
        <li>Hasil perhitungan ini dimungkinan terdapat perbedaan dengan SIMBG karena faktor sistem, dan perhitungan yang digunakan adalah perhitungan melalui SIMBG						
        </li>
    </ol>
</body>

</html>
