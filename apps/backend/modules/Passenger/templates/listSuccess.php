<?php slot('title') ?>
  Pasajeros
<?php end_slot() ?>

<?php slot('subtitle') ?>
  Listar Buses
<?php end_slot() ?>

<?php include_component('Crud', 'list', array
      (
        'pager'              => $pager,
                                
        'uri'                => '@passenger_list?filter_by=filter_by&filter=filter&order_by=order_by&order=order&max=max&page=page',
                                
        'edit_field'         => 'names',
        'filter_fields'      => array
                                (
                                  'dni'         => 'DNI',
                                  'names'  => 'Nombres'
                                ),
        'columns'            => array
                                (
                                  array('2' , ''              , ''         , ''           ),
                                  array('10', 'boarding_name' , 'Paradero' , 'getBoardingName'   ),
                                  array('10', 'company_name'  , 'Empresa'  , 'getCompanyName'   ),
                                  array('10', 'names'     , 'Nombres'      , 'getNames'   ),
                                  array('10', 'dni'       , 'DNI'          , 'getDni'     ),

                                  array('6' , 'disable_image'  , 'Activo'          , 'getDisableImage', 'center', false),
                                  array('2' , ''               , ''                , 'checkbox'         ),
                                )
      ))
?>
