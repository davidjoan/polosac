<?php slot('title') ?>
  Desembarques
<?php end_slot() ?>

<?php slot('subtitle') ?>
  Desembarque: <?php echo $form->getObject()->getName() ?>
<?php end_slot() ?>

<?php include_component('Crud', 'show', array('form' => $form)) ?>
