<?php slot('title') ?>
  Tripulación
<?php end_slot() ?>

<?php slot('subtitle') ?>
  <?php echo $form->isNew() ? 'Agregar' : 'Editar' ?> Tripulación
<?php end_slot() ?>

<?php include_component('Crud', 'edit', array('form' => $form)) ?>
