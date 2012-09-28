<table class="left_box">
  <tr>
    <th colspan="2">POLOSAC - ADMIN</th>
  </tr>
  <tr><td></td></tr>
  <tr>
    <td>Cantidad de Visitas:</td>
    <td><?php echo $visits ?></td>
  </tr>
  <tr><td></td></tr>
  <tr><td></td></tr>
  <tr><td></td></tr>
  <tr>
    <th colspan="2">Ultima Visita</th>
  </tr>
  <tr><td></td></tr>
  <tr>
    <td>Remote Address</td>
    <td><b><?php echo $lastVisit->getRemoteAddress() ?></b></td>
  </tr>
  <tr>
    <td>HTTP User Agent</td>
    <td><b><small><?php echo $lastVisit->getHttpUserAgent() ?></small></b></td>
  </tr>
  <tr>
    <td>Datetime</td>
    <td><b><?php echo $lastVisit->getDatetime() ?></b></td>
  </tr>
  <tr><td></td></tr>
  <tr>
    <th colspan="2">POLOSAC Versi&oacute;n</th>
  </tr>
  <tr><td></td></tr>
  <tr>
    <td>Version</td>
    <td><b>1.0</b></td>
  </tr>
  <tr><td></td></tr>
  <tr><td></td></tr>
</table>