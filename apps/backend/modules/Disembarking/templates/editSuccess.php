<?php slot('title') ?>
  Desembarques
<?php end_slot() ?>

<?php slot('subtitle') ?>
  <?php echo $form->isNew() ? 'Agregar' : 'Editar' ?> Desembarque
<?php end_slot() ?>

<?php include_component('Crud', 'edit', array('form' => $form)) ?>
