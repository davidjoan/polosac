<?php slot('title') ?>
  Buses
<?php end_slot() ?>

<?php slot('subtitle') ?>
  <?php echo $form->isNew() ? 'Agregar' : 'Editar' ?> Bus
<?php end_slot() ?>

<?php include_component('Crud', 'edit', array('form' => $form)) ?>
