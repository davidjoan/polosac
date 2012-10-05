<?php slot('title') ?>
  Contactos
<?php end_slot() ?>

<?php slot('subtitle') ?>
  Nombre: <?php echo $form->getObject()->getName() ?>
<?php end_slot() ?>

<?php include_component('Crud', 'show', array('form' => $form)) ?>
