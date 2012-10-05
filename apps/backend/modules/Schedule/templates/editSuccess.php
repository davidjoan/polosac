<?php slot('title') ?>
  Programación
<?php end_slot() ?>

<?php slot('subtitle') ?>
  <?php echo $form->isNew() ? 'Agregar' : 'Editar' ?> Programación
<?php end_slot() ?>

<?php include_component('Crud', 'edit', array('form' => $form)) ?>
