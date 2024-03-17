<!DOCTYPE html>
<html>

<head>
    <title>{{env('APP_NAME')}} | {{env('APP_TAG')}}</title>

    <meta content="{{ env('APP_DES') }}" name="description">
    <meta content="{{ env('APP_NAME') }}" name="keywords">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="shortcut icon" href="{{ asset('assets/logo.png') }}" type="image/x-icon">
</head>
<style>
    body {
        font-size: 16px;
    }

    table {
        border-collapse: collapse;
        border-spacing: 0;
    }

    td {
        border: 1px solid black;
    }

    ol {
        margin-top: 0rem;
        margin-left: 0rem;
    }
</style>

<body>
    <header>
        <table style="width: 100%; border:none">
            <tr>
                <td width="10%" style="border:none;vertical-align:middle"><img
                        style="margin-left: 2rem;display:block" src="{{ gambar('surat.png') }}" /></td>
                <td style="border:none; text-align:center">
                    <p>
                        <span style="font-size:18px">PEMERINTAH KABUPATEN TEGAL</span><br>
                        <span style="font-weight: bold; font-size:18px">
                            DINAS PEKERJAAN UMUM DAN PENATAAN RUANG
                        </span><br>
                        Alamat : Jalan Cut Nyak Dien No. 13 Slawi Kode Pos 52416
                    </p>
                </td>
            </tr>
        </table>
    </header>
    <div style="border-bottom: 3px solid black;width:100%;margin-bottom:0.1rem"></div>
    <div style="border-bottom: 1px solid black;width:100%"></div>
    <div style="margin: auto; display:block; width:600px; max-width:100%">
        <table style="width:100%; margin-top: 0.5rem">
            <tr>
                <td width="10%" style="border:none">Nomor</td>
                <td width="1%" style="border:none;">:</td>
                <td style="border:none">{{ $schedule->nomor }}</td>
                <td style="border:none;text-align:right">Slawi, {{ dateID($schedule->tanggal) }}</td>
            </tr>
            <tr>
                <td width="10%" style="border:none;vertical-align:top">Perihal</td>
                <td width="1%" style="border:none;vertical-align:top">:</td>
                <td style="border:none;">Surat Pemberitahuan / Undangan <br>Konsultasi PBG dan/atau SLF</td>
            </tr>
        </table>

        @php
        $time = explode('#', $schedule->waktu);
        $place = explode('#', $schedule->tempat);
        $header = json_decode($schedule->doc->header);
        @endphp

        <p style="margin-left:24rem">
            Kepada Yth.<br>
            Bapak/Ibu<br>
            {{ $header[2] }}<br>
            di -<br>
            <span style="margin-left:2.5rem">Tempat</span>
        </p>

        <p style="text-align: justify"><span style="margin-right: 1rem">&nbsp;</span>
            Sehubungan dengan Permohonan Persetujuan Bangunan Gedung (PBG) dan/atau Sertifikat Laik (SLF) yang diunggah
            melalui Sistem Informasi Manajemen Bangunan Gedung (SIMBG) :
        </p>

        <table style="width:95%; margin:auto" align="center">
            <tr>
                <td width="30%" style="border:none">Nomr Registrasi</td>
                <td width="1%" style="border:none">: </td>
                <td style="border:none">{{ $schedule->doc->reg }}</td>
            </tr>
            <tr>
                <td width="30%" style="border:none">Nama Pemohon/Pemilik</td>
                <td width="1%" style="border:none">: </td>
                <td style="border:none">{{ $header[2] }}</td>
            </tr>
            <tr>
                <td width="30%" style="border:none">Alamat Pemohon/Pemilik</td>
                <td width="1%" style="border:none">: </td>
                <td style="border:none">{{ $header[4] }}</td>
            </tr>
            <tr>
                <td width="30%" style="border:none">Nama Bangunan</td>
                <td width="1%" style="border:none">: </td>
                <td style="border:none">{{ $header[5] }}</td>
            </tr>
            <tr>
                <td width="30%" style="border:none;vertical-align:top">Alamat Bangunan</td>
                <td width="1%" style="border:none;vertical-align:top">: </td>
                <td style="border:none;vertical-align:top">{{ $header[7] }} <br>Kec.
                    {{ $schedule->doc->region->name }} Kab. {{ $schedule->doc->region->kecamatan->name }} </td>
            </tr>
        </table>

        <p style="text-align: justify">
            Dapat kami informasikan bahwa permohonan PBG dan/atau SLF tersebut dilanjutkan ketahap Konsultasi yang akan
            dilaksanakan pada :
        </p>

        <table style="width:95%; margin:auto" align="center">
            <tr>
                <td width="30%" style="border:none">Hari, Tanggal</td>
                <td width="1%" style="border:none">: </td>
                <td style="border:none">{{ hari($time[1]) }}</td>
            </tr>
            <tr>
                <td width="30%" style="border:none">Pukul</td>
                <td width="1%" style="border:none">: </td>
                <td style="border:none">{{ $time[0] }} WIB s.d. Selesai</td>
            </tr>
            <tr>
                <td width="30%" style="border:none">Jenis Konsultasi</td>
                <td width="1%" style="border:none">: </td>
                <td style="border:none">{{ ucwords(str_replace('_', ' ', $schedule->jenis)) }}</td>
            </tr>
            <tr>
                <td width="30%" style="border:none">Tempat</td>
                <td width="1%" style="border:none">: </td>
                <td style="border:none"> {{ ucwords(str_replace('_', ' ', $place[0])) }}</td>
            </tr>
            <tr>
                <td width="30%" style="border:none;vertical-align:top">Keterangan</td>
                <td width="1%" style="border:none;vertical-align:top">: </td>
                <td style="border:none;vertical-align:top">
                    {!! $schedule->keterangan !!}
                </td>
            </tr>
        </table>

        <p style="text-align: justify">
            Demikian surat pemberitahuan / undangan ini dibuat untuk dipergunakan sebagaimana mestinya. Terima kasih.
        </p>


        <table style="width:100%; margin:auto" align="center">
            <tr>
                <td width="35%" style="border:none">&nbsp;</td>
                <td style="border:none;">
                    <p style="text-align: center">
                        a.n. Kepala DPUPR Kabupaten Tegal<br>
                        Kepala Bidang Penataan Bangunan, Lingkungan<br>
                        dan Tata Ruang<br><br>
                        TTD<br><br>
                        <b><u>WIDODO SETIA NUGRAHA, ST, MA. MURP.</u></b><br>
                        NIP. 198410292009031003z
                    </p>
                </td>
            </tr>
        </table>
    </div>    
</body>

</html>
