  <p>Saran dan Masukkan Lain :<br>
    {!! $head->saran !!}
  </p>               
  <table style="width:100%">          
    <tr>         
        <td width="40%" style="border:none">               
        </td>
        <td width="20%" style="border:none">                          
            Verifikator :<br>
            - {!! ucfirst(implode("<br>- ",$head->verif)) !!}
        </td>
        <td width="40%" style="border:none">
          <p style="text-align:center">Slawi, {{dateID($head->created_at)}}</p>                   
          <center><img src="data:image/png;base64, {{ $qrCode }}" width="25%"></center>
          <p style="text-align:center">DPUPR Kabupaten Tegal</p>
        </td>                                                                     
    </tr>
  </table>    
