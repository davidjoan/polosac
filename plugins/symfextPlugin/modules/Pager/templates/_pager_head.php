<?php use_stylesheet(sfConfig::get('sf_app').'/modules/pager.css') ?>

<table class="pager_head">
  <tr>
    <td>
      Mostrando <?php echo $pager->getFirstIndice() ?> - <?php echo $pager->getLastIndice() ?> de  
      <?php echo $pager->getNbResults() ?> resultado<?php echo $pager->getNbResults() > 1 ? 's' : '' ?>
    </td>
  </tr>
</table>
