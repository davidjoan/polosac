<?php slot('title') ?>
  Paraderos
<?php end_slot() ?>

<?php slot('subtitle') ?>
  Paradero: <?php echo $form->getObject()->getName() ?>
<?php end_slot() ?>

<?php include_component('Crud', 'show', array('form' => $form)) ?>
