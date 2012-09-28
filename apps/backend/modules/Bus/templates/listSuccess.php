<?php slot('title') ?>
  Buses
<?php end_slot() ?>

<?php slot('subtitle') ?>
  Listar Buses
<?php end_slot() ?>

<?php include_component('Crud', 'list', array
      (
        'pager'              => $pager,
                                
        'uri'                => '@bus_list?filter_by=filter_by&filter=filter&order_by=order_by&order=order&max=max&page=page',
                                
        'edit_field'         => 'code',
        'filter_fields'      => array
                                (
                                  'code'         => 'Placa',
                                  'mining_unit'  => 'Unidad Minera',
                                  'padron'       => 'Padron',
                                  'brand'        => 'Marca',
                                  'model'        => 'Modelo',
                                  'fuel'         => 'Combustible',
                                  'motor_number' => 'N° Motor',
                                  'vehicle_use'  => 'Uso de Vehiculo'
                                ),
        'columns'            => array
                                (
                                  array('2' , ''               , ''                , ''                 ),
                                  array('10', 'company_id'     , 'Propietario'     , 'getCompanyName'   ),
                                  array('10', 'code'           , 'Placa'           , 'getCode'          ),
                                  array('10', 'mining_unit'    , 'Unidad Minera'   , 'getMiningUnit'    ),
                                  array('10', 'padron'         , 'Padron'          , 'getPadron'        ),
                                  array('10', 'category_class' , 'Categoria/Clase' , 'getCategoryClass' ),
                                  array('10', 'brand'          , 'Marca'           , 'getBrand'         ),
                                  array('10', 'model'          , 'Modelo'          , 'getModel'         ),
                                  array('10', 'fuel'           , 'Combustible'     , 'getFuel'   ),
                                  array('10', 'serial_number'  , 'N° Serie'        , 'getSerialNumber'  ),
                                  array('10', 'motor_number'   , 'N° de Motor'     , 'getMotorNumber'   ),
                                  array('10', 'vehicle_use'    , 'Use de vehiculo' , 'getVehicleUse'    ),
                                  array('6' , 'disable_image'  , 'Activo'          , 'getDisableImage', 'center', false),
                                  array('2' , ''               , ''                , 'checkbox'         ),
                                )
      ))
?>
