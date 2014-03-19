<?php slot('title') ?>
  Usuario
<?php end_slot() ?>

<?php slot('subtitle') ?>
  <?php echo $form->isNew() ? 'Agregar' : 'Editar' ?> Usuario
<?php end_slot() ?>

<?php include_component('Crud', 'edit', array('form' => $form)) ?>
