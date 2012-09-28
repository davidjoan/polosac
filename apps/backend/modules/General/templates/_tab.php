<?php $is_selected = $sf_user->getCurrentRouteName() == $uri ?>
<td class="<?php echo $is_selected ? 'menu_l_sel' : 'menu_l' ?>"></td>
<td class="main <?php echo $is_selected ? 'active' : 'inactive' ?>" onclick="location.href = '<?php echo url_for($uri) ?>';" ?>
  <?php echo image_tag($image, array('size' => '18x18')) ?> <?php echo $title ?>&nbsp;
</td>
<td class="<?php echo $is_selected ? 'menu_r_sel' : 'menu_r' ?>"></td>
