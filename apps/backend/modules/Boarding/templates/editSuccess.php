<?php slot('title') ?>
  Embarques
<?php end_slot() ?>

<?php slot('subtitle') ?>
  <?php echo $form->isNew() ? 'Agregar' : 'Editar' ?> Embarque
<?php end_slot() ?>

<?php include_component('Crud', 'edit', array('form' => $form)) ?>
