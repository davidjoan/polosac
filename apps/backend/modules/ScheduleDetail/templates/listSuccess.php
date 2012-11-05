<?php slot('title') ?>
  Asignaciones
<?php end_slot() ?>

<?php slot('subtitle') ?>
  Lista de Asignaciones
<?php end_slot() ?>

<?php include_component('Crud', 'list', array
      (
        'pager'              => $pager,
                                
        'uri'                => '@schedule_detail_list?filter_by=filter_by&filter=filter&order_by=order_by&order=order&max=max&page=page',
                                
        'edit_field'         => 'bus_name',
        'filter_fields'      => array
                                (
                                  'bus_name'      => 'Bus',
                                  'company_name'  => 'Empresa',
                                ),
        'columns'            => array
                                (
                                  array('2' , ''               , ''            , ''                         ),
                                  array('20', 'company_name'   , 'Empresa'     , 'getCompanyName'           ),
                                  array('20', 'bus_name'       , 'Bus'         , 'getScheduleBusName'       ),
                                  array('15', 'place_from_name', 'Origen'      , 'getSchedulePlaceFromName' ),
                                  array('15', 'place_to_name'  , 'Destino'     , 'getSchedulePlaceToName'   ),
                                  array('15', 'schedule_date'  , 'Fecha Viaje' , 'getScheduleTravelDate'    ),
                                  array('15', 'schedule_time'  , 'Hora de Viaje' , 'getScheduleTravelTime'  ),
                                  array('6' , 'disable_image'  , 'Activo'      , 'getDisableImage', 'center', false),
                                  array('2' , ''               , ''            , 'checkbox'                 ),
                                )
      ))
?>
