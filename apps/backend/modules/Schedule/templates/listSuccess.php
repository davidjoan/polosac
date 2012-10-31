<?php slot('title') ?>
  Programación
<?php end_slot() ?>

<?php slot('subtitle') ?>
  Lista de los Programaciones
<?php end_slot() ?>
  
  <?php slot('buttons') ?>
  <td><?php echo button_to_get_url('Manifiesto de Pasajeros', '@schedule_report?slug=slug', array('slug' => array('id' =>'schedule_slug', 'list' => true, 'validate' => true, 'single' => true)), array('onclick' => true, 'class' => 'inputbutton')) ?></td>
<?php end_slot() ?>

<?php include_component('Crud', 'list', array
      (
        'pager'              => $pager,
                                
        'uri'                => '@schedule_list?filter_by=filter_by&filter=filter&order_by=order_by&order=order&max=max&page=page',
                                
        'edit_field'         => 'travel_date',
        'filter_fields'      => array('bus_name' => 'Bus',
                                      'travel_date' => 'Fecha', 
                                      'travel_time' => 'Hora',
                                      'place_from_name' => 'Origen',
                                      'place_to_name' => 'Destino'),
        'columns'            => array
                                (
                                  array('2' , ''                , ''              , ''                       ),
                                  array('15', 'bus_name'        , 'Bus'           , 'getBusNameForSChedule'  ),
                                  array('10', 'travel_date'     , 'Fecha de Viaje', 'getFormattedTravelDate' ),
                                  array('10', 'travel_time'     , 'Hora de Viaje' , 'getTravelTime'           ),
                                  array('10', 'place_from_name' , 'Origen'        , 'getPlaceFrom'           ),
                                  array('10', 'place_to_name'   , 'Destino'       , 'getPlaceTo'             ),
                                  array('6' , 'disable_image'   , 'Activo'        , 'getDisableImage', 'center', false),
                                  array('2' , ''                , ''              , 'checkbox'         ),
                                )
      ))
?>
