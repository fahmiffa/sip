  @if($head->step == 1)
  <p>Saran dan Masukkan Lain :</p>               
  @endif
  <table style="width:100%">          
    <tr>         
        <td width="30%" style="border:none">     
          {!! $head->saran !!}
        </td>
        <td width="30%" align="left" style="border:none">    
                      
            Verifikator :<br>
            - {!! ucfirst(implode("<br>- ",$head->verif)) !!}
        </td>
        <td width="40%" style="border:none">
          <p style="text-align:center">Slawi, {{dateID($head->created_at)}}</p>                   
          <center><img src="data:image/png;base64, {{ $qrCode }}"></center>
          <p style="text-align:center">DPUPR Kabupaten Tegal</p>
        </td>                                                                     
    </tr>
  </table>    
