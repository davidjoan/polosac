<?php slot('title') ?>
  Lugares
<?php end_slot() ?>

<?php slot('subtitle') ?>
  <?php echo $form->isNew() ? 'Agregar' : 'Editar' ?>  Lugar
<?php end_slot() ?>

<?php include_component('Crud', 'edit', array('form' => $form)) ?>
