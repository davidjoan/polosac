<table class="menu">
  <tr>
    <td width="99%">
      <table class="submenu">
        <tr>
          <?php include_partial('General/tab', array
                (
                  'title'       => 'Inicio', 
                  'uri'         => '@home',
                  'image'       => 'backend/menu/user.gif',
                ))
          ?>
          <?php include_partial('General/tab', array
                (
                  'title'       => 'Programación', 
                  'uri'         => '@schedule_list',
                  'image'       => 'backend/menu/marketing.gif',
                ))
          ?>
          <?php include_partial('General/tab', array
                (
                  'title'       => 'Tripulación', 
                  'uri'         => '@crew_list',
                  'image'       => 'backend/menu/marketing.gif',
                ))
          ?>
          <?php include_partial('General/tab', array
                (
                  'title'       => 'Buses', 
                  'uri'         => '@bus_list',
                  'image'       => 'backend/menu/marketing.gif',
                ))
          ?>            
          <?php include_partial('General/tab', array
                (
                  'title'       => 'Propietarios', 
                  'uri'         => '@company_list',
                  'image'       => 'backend/menu/campaigns.gif',
                ))
          ?>
          <?php include_partial('General/tab', array
                (
                  'title'       => 'Contactos', 
                  'uri'         => '@contact_list',
                  'image'       => 'backend/menu/user.gif',
                ))
          ?>
          <?php include_partial('General/tab', array
                (
                  'title'       => 'Pasajeros', 
                  'uri'         => '@passenger_list',
                  'image'       => 'backend/menu/user.gif',
                ))
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
          <?php include_partial('General/tab', array
                (
                  'title'       => 'Lugares', 
                  'uri'         => '@place_list',
                  'image'       => 'backend/menu/campaigns.gif',
                ))
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