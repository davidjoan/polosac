<?php slot('title') ?>
  Empresas
<?php end_slot() ?>

<?php slot('subtitle') ?>
  Empresa: <?php echo $form->getObject()->getName() ?>
<?php end_slot() ?>

<?php include_component('Crud', 'show', array('form' => $form)) ?>
