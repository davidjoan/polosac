<?php slot('title') ?>
  Embarques
<?php end_slot() ?>

<?php slot('subtitle') ?>
  Embarque: <?php echo $form->getObject()->getName() ?>
<?php end_slot() ?>

<?php include_component('Crud', 'show', array('form' => $form)) ?>
