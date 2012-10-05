<?php slot('title') ?>
  Contactos
<?php end_slot() ?>

<?php slot('subtitle') ?>
  <?php echo $form->isNew() ? 'Agregar' : 'Editar' ?> Contacto
<?php end_slot() ?>

<?php include_component('Crud', 'edit', array('form' => $form)) ?>
