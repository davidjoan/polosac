<table class="menu">
  <tr>
    <td width="99%">
      <table class="submenu">
        <tr>
          <?php include_partial('General/tab', array
                (
                  'title'       => 'Inicio', 
                  'uri'         => '@home',
                  'image'       => 'backend/menu/home.gif',
                ))
          ?>       
          <?php /*include_partial('General/tab', array
                (
                  'title'       => 'Info & Banner', 
                  'uri'         => '@company_list',
                  'image'       => 'backend/menu/marketing.gif',
                ))*/
          ?>
          <?php /*include_partial('General/tab', array
                (
                  'title'       => 'Menu', 
                  'uri'         => '@menu_list',
                  'image'       => 'backend/menu/marketing.gif',
                ))*/
          ?>            
          <?php /*include_partial('General/tab', array
                (
                  'title'       => 'Artículos', 
                  'uri'         => '@post_list',
                  'image'       => 'backend/menu/campaigns.gif',
                ))*/
          ?>
          <?php /*include_partial('General/tab', array
                (
                  'title'       => 'Categorias', 
                  'uri'         => '@category_list',
                  'image'       => 'backend/menu/campaigns.gif',
                ))*/
          ?>
          <?php /*include_partial('General/tab', array
                (
                  'title'       => 'Tags', 
                  'uri'         => '@tag_list',
                  'image'       => 'backend/menu/campaigns.gif',
                ))*/
          ?>         
          <?php /*include_partial('General/tab', array
                (
                  'title'       => 'Fotos', 
                  'uri'         => '@photo_list',
                  'image'       => 'backend/menu/campaigns.gif',
                ))*/
          ?>            
          <?php /*include_partial('General/tab', array
                (
                  'title'       => 'Videos', 
                  'uri'         => '@video_list',
                  'image'       => 'backend/menu/campaigns.gif',
                ))*/
          ?>            
          <?php include_partial('General/tab', array
                (
                  'title'       => 'Usuarios', 
                  'uri'         => '@user_list',
                  'image'       => 'backend/menu/user.gif',
                ))
          ?>
        </tr>
      </table>
    </td>
    <td width="1%">
      <table class="submenu">
        <tr>
          <?php include_partial('General/tab', array
                (
                  'title'       => 'Cerrar Sesi&oacute;n', 
                  'uri'         => '@log_logout',
                  'image'       => 'backend/menu/logout.gif',
                ))
          ?>
      </table>
    </td>
  </tr>
</table>