<table class="buttons_container">
  <tr>
    <td align="right">
      <table class="buttons">
        <tr>
          <?php if (has_slot('buttons')): ?>
            <?php include_slot('buttons') ?>
          <?php endif ?>
          
          <?php if ($buttons['show']): ?>
            <td><?php echo button_to_get_url('Mostrar', sprintf('@%s_show?slug=slug', $usClass), array('slug' => array('id' => $usClass.'_slug', 'list' => true, 'validate' => true, 'single' => true)), array('onclick' => true, 'class' => 'inputbutton')) ?></td>
          <?php endif ?>
          
          <?php if ($buttons['add']): ?>
            <?php if (isset($object) && $object): ?>
              <td><?php echo button_to('Agregar', sprintf('@%s_new?parent_slug=%s', $usClass, $object->getSlug()), array('onclick' => true, 'class' => 'inputbutton')) ?></td>
            <?php else: ?>
              <td><?php echo button_to('Agregar', sprintf('@%s_new', $usClass), array('onclick' => true, 'class' => 'inputbutton')) ?></td>
            <?php endif ?>
          <?php endif ?>
          
          <?php if ($buttons['edit']): ?>
            <td><?php echo button_to_get_url('Modificar', sprintf('@%s_edit?slug=slug', $usClass), array('slug' => array('id' => $usClass.'_slug', 'list' => true, 'validate' => true, 'single' => true)), array('onclick' => true, 'class' => 'inputbutton')) ?></td>
          <?php endif ?>
          
          <?php if ($buttons['delete']): ?>
            <td><?php echo button_to_get_url('Eliminar', sprintf('@%s_delete?slug=slug', $usClass), array('slug' => array('id' => $usClass.'_slug', 'list' => true, 'validate' => true, 'to_delete' => true)), array('onclick' => true, 'class' => 'inputbutton')) ?></td>
          <?php endif ?>
        </tr>
      </table>
    </td>
  </tr>
</table>
