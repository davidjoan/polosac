<?php slot('title') ?>
  Asignaciones
<?php end_slot() ?>

<?php slot('subtitle') ?>
  <?php echo $form->isNew() ? 'Agregar' : 'Editar' ?>  Asignación
<?php end_slot() ?>

<?php include_component('Crud', 'edit', array('form' => $form)) ?>
