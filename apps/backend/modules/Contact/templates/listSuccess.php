<?php slot('title') ?>
  Contactos
<?php end_slot() ?>

<?php slot('subtitle') ?>
  Lista de Contactos
<?php end_slot() ?>

<?php include_component('Crud', 'list', array
      (
        'pager'              => $pager,
                                
        'uri'                => '@contact_list?filter_by=filter_by&filter=filter&order_by=order_by&order=order&max=max&page=page',
                                
        'edit_field'         => 'name',
        'filter_fields'      => array
                                (
                                  'name'           => 'Nombres'
                                ),
        'columns'            => array
                                (
                                  array('2' , ''               , ''         , ''                 ),
                                  array('10', 'company_name'   , 'Empresa'  , 'getCompany'       ),
                                  array('20', 'name'           , 'Nombres'  , 'getName'          ),
                                  array('10', 'email'          , 'Email'    , 'getEmail'         ),
                                  array('10', 'phone'          , 'Telefono' , 'getPhone'         ),
                                  array('6' , 'disable_image'  , 'Activo'   , 'getDisableImage', 'center', false),
                                  array('2' , ''               , ''         , 'checkbox'         ),
                                )
      ))
?>
