<?php slot('title') ?>
  Tripulación
<?php end_slot() ?>

<?php slot('subtitle') ?>
  Lista de toda la Tripulacion
<?php end_slot() ?>

<?php include_component('Crud', 'list', array
      (
        'pager'              => $pager,
                                
        'uri'                => '@crew_list?filter_by=filter_by&filter=filter&order_by=order_by&order=order&max=max&page=page',
                                
        'edit_field'         => 'name',
        'filter_fields'      => array
                                (
                                  'name'           => 'Nombres',
                                  'dni'            => 'DNI',
                                  'driver_license' => 'Licencia',
                                  'phone'          => 'Telefono',
                                ),
        'columns'            => array
                                (
                                  array('2' , ''               , ''         , ''                 ),
                                  array('10', 'bus_name'       , 'Bus'      , 'getBusCode'       ),
                                  array('20', 'name'           , 'Nombres'  , 'getNAme'          ),
                                  array('10', 'dni'            , 'DNI'      , 'getDni'           ),
                                  array('10', 'driver_license' , 'Licencia' , 'getDriverLicense' ),
                                  array('10', 'position'       , 'Cargo'    , 'getPositionStr'   ),
                                  array('10', 'phone'          , 'Telefono' , 'getPhone'         ),
                                  array('6' , 'disable_image'  , 'Activo'   , 'getDisableImage', 'center', false),
                                  array('2' , ''               , ''         , 'checkbox'         ),
                                )
      ))
?>
