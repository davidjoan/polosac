<?php slot('title') ?>
  Tripulación
<?php end_slot() ?>

<?php slot('subtitle') ?>
  Nombre: <?php echo $form->getObject()->getRealname() ?>
<?php end_slot() ?>

<?php include_component('Crud', 'show', array('form' => $form)) ?>
