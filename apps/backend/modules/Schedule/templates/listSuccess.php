<?php slot('title') ?>
  Programación
<?php end_slot() ?>

<?php slot('subtitle') ?>
  Lista de los Programaciones
<?php end_slot() ?>

<?php include_component('Crud', 'list', array
      (
        'pager'              => $pager,
                                
        'uri'                => '@schedule_list?filter_by=filter_by&filter=filter&order_by=order_by&order=order&max=max&page=page',
                                
        'edit_field'         => 'travel_date',
        'filter_fields'      => null,
        'columns'            => array
                                (
                                  array('2' , ''               , ''         , ''                 ),
                                  array('10', 'bus_id'         , 'Bus'      , 'getBus'           ),
                                  array('10', 'travel_date'    , 'Fecha de Viaje', 'getFormattedTravelDate' ),
                                  array('10', 'place_from_id'  , 'Origen'   , 'getPlaceFrom'           ),
                                  array('10', 'place_to_id'    , 'Destino'  , 'getPlaceTo'             ),
                                  array('6' , 'disable_image'  , 'Activo'   , 'getDisableImage', 'center', false),
                                  array('2' , ''               , ''         , 'checkbox'         ),
                                )
      ))
?>
