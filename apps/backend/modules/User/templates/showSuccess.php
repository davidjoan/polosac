<?php slot('title') ?>
  Usuarios
<?php end_slot() ?>

<?php slot('subtitle') ?>
  Usuario: <?php echo $form->getObject()->getRealname() ?>
<?php end_slot() ?>

<?php include_component('Crud', 'show', array('form' => $form)) ?>
