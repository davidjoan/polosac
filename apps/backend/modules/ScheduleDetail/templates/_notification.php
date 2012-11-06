<h3>Usted ha recibido un nuevo mensaje autogenerado por el Sistema de Reservaciones POLOSAC</h3>


<p>La presente para hacer de conocimiento que se est&aacute; agregando  un Pasajero al <b>Manifiesto de Pasajeros</b> del Bus con placa <b><?php echo $schedule_detail->getSchedule()->getBus()->getCode(); ?></b> desde la Cuenta Administrador ya que dicho Pasajero no fue registrado en nuestro Sistema Web<br/> 
 dentro de los plazos establecidos por los administradores; esperando que  no se vuelva a suscitar dicho contratiempo <br/> ya que nos retrasa la salida de los buses a fin de brindarles un servicio de Calidad.
</p>
<p></p>
<h3><u>Informaci&oacute;n Complementaria</u></h3>
<b>Bus</b>  <?php echo $schedule_detail->getSchedule()->getBus()->getBusNameForSChedule(); ?>
<b>Origen</b> <?php echo $schedule_detail->getSchedule()->getPlaceFromName(); ?><br>
<b>Destino</b> <?php echo $schedule_detail->getSchedule()->getPlaceToName(); ?><br>

<b>Fecha:</b> <?php echo $schedule_detail->getSchedule()->getFormattedTravelDate(); ?><br>
<b>Hora de Viaje:</b> <?php echo $schedule_detail->getSchedule()->getTravelTime(); ?><br>
<b>Hora de Modificación:</b> <?php echo date("H:i:s"); ?><br>

<b>Empresa:</b> <?php echo $schedule_detail->getCompanyName(); ?><br>
<b>Cantidad Asientos Asignados:</b> <?php echo $schedule_detail->getQtySeats(); ?><br>
 <p>&nbsp;</p>
 
<h3><u>Administradores Asignados a <?php echo $schedule_detail->getCompanyName(); ?></u></h3><br>
    
    <ul>
        <?php foreach($schedule_detail->getCompany()->getUsers() as $user): ?>
        <li><?php echo $user->getRealName() ?></li>
        <?php endforeach; ?>
    </ul>


    
<p>Esperando su comprensión</p>
<br/>
<p>Atentamente,</p>
 
Administrador Sistema Web.<br>
Área Reservas Lima<br>
Inv. y Rep. Polo SAC.<br>
Rpc. 989217834 <br>
Telef. 01-356-0379 Anexo 20<br>
Av. Pedro Ruiz Gallo Nº 2251 - ATE. 