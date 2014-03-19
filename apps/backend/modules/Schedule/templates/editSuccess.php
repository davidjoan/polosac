<?php slot('title') ?>
  Programación
<?php end_slot() ?>

<?php slot('subtitle') ?>
  <?php echo $form->isNew() ? 'Agregar' : 'Editar' ?> Programación
<?php end_slot() ?>
<?php if (!$form->isNew()): ?>
  <?php slot('buttons') ?>
  <td><?php echo button_to('Manifiesto de Pasajeros', '@schedule_report?slug='.$form->getObject()->getSlug(), array('onclick' => true, 'class' => 'inputsubmit')) ?></td>
<?php end_slot() ?>
<?php endif; ?>
<?php include_component('Crud', 'edit', array('form' => $form)) ?>
