<?php slot('title') ?>
  Usuarios
<?php end_slot() ?>

<?php slot('subtitle') ?>
  Lista de Usuarios
<?php end_slot() ?>

<?php include_component('Crud', 'list', array
      (
        'pager'              => $pager,
                                
        'uri'                => '@user_list?filter_by=filter_by&filter=filter&order_by=order_by&order=order&max=max&page=page',
                                
        'edit_field'         => 'username',
        'filter_fields'      => array
                                (
                                  'realname'   => 'Nombres',
                                  'username'   => 'Usuario',
                                  'email'      => 'Email'
                                ),
        'columns'            => array
                                (
                                  array('2' , ''             , ''             , ''               ),
                                  array('30', 'realname'     , 'Nombres'      , 'getRealname'   ),
                                  array('26', 'username'     , 'Usuario'      , 'getUsername' ),
                                  array('26', 'email'        , 'Email'        , 'getEmail' ),
                                  array('26', 'phone'        , 'Telefono'        , 'getPhone' ),
                                  array('6' , 'disable_image' , 'Activo'  , 'getDisableImage', 'center', false),
                                  array('2' , ''             , ''            , 'checkbox'      ),
                                )
      ))
?>
