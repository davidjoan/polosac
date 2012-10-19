<h1>Bienvenidos al Administrador de Servicios Externos</h1>
<hr/>
<br/><br/>
<?php //echo kcCrypt::encrypt('1234') ?>

<?php include_component('Generic', 'form', array
      (
        'form'          => $form,
        'action_uri'    => '@log_login',
        'styles_folder' => 'log',
        'submit'        => 'Ingresar',
        'with_title'    => false
      ))
?>

