<?php slot('title') ?>
  Empresas
<?php end_slot() ?>

<?php slot('subtitle') ?>
  <?php echo $form->isNew() ? 'Agregar' : 'Editar' ?> Empresa
<?php end_slot() ?>

<?php include_component('Crud', 'edit', array('form' => $form)) ?>
