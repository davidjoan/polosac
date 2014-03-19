<?php slot('title') ?>
  Programación
<?php end_slot() ?>

<?php slot('subtitle') ?>
  Fecha Programa: <?php echo $form->getObject()->getTravelDate() ?>
<?php end_slot() ?>

<?php include_component('Crud', 'show', array('form' => $form)) ?>
