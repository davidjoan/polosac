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
          <?php if($sf_user->hasPermission('@schedule_list')): ?>
          <?php include_partial('General/tab', array
                (
                  'title'       => 'Programación', 
                  'uri'         => '@schedule_list',
                  'image'       => 'backend/menu/marketing.gif',
                ))
          ?>
            <?php endif; ?>
            <?php if($sf_user->hasPermission('@crew_list')): ?>
          <?php include_partial('General/tab', array
                (
                  'title'       => 'Tripulación', 
                  'uri'         => '@crew_list',
                  'image'       => 'backend/menu/marketing.gif',
                ))
          ?>
            <?php endif; ?>
            <?php if($sf_user->hasPermission('@bus_list')): ?>
          <?php include_partial('General/tab', array
                (
                  'title'       => 'Buses', 
                  'uri'         => '@bus_list',
                  'image'       => 'backend/menu/marketing.gif',
                ))
          ?>
            <?php endif; ?>
            <?php if($sf_user->hasPermission('@company_list')): ?>
          <?php include_partial('General/tab', array
                (
                  'title'       => 'Empresas', 
                  'uri'         => '@company_list',
                  'image'       => 'backend/menu/campaigns.gif',
                ))
          ?>
            <?php endif; ?>
            <?php if($sf_user->hasPermission('@schedule_detail_list')): ?>
            <?php include_partial('General/tab', array
                (
                  'title'       => 'Distribución', 
                  'uri'         => '@schedule_detail_list',
                  'image'       => 'backend/menu/campaigns.gif',
                ))
          ?>        
            <?php endif; ?>            
            <?php if($sf_user->hasPermission('@passenger_list')): ?>
          <?php include_partial('General/tab', array
                (
                  'title'       => 'Pasajeros', 
                  'uri'         => '@passenger_list',
                  'image'       => 'backend/menu/user.gif',
                ))
          ?>
            <?php endif; ?>
            <?php if($sf_user->hasPermission('@boarding_list')): ?>          
          <?php include_partial('General/tab', array
                (
                  'title'       => 'Paraderos', 
                  'uri'         => '@boarding_list',
                  'image'       => 'backend/menu/campaigns.gif',
                ))
          ?>  
          <?php endif; ?>
            <?php if($sf_user->hasPermission('@place_list')): ?>
          <?php include_partial('General/tab', array
                (
                  'title'       => 'Lugares', 
                  'uri'         => '@place_list',
                  'image'       => 'backend/menu/campaigns.gif',
                ))
          ?><?php endif; ?>
            <?php if($sf_user->hasPermission('@user_list')): ?>
           
          <?php include_partial('General/tab', array
                (
                  'title'       => 'Usuarios', 
                  'uri'         => '@user_list',
                  'image'       => 'backend/menu/user.gif',
                ))
          ?>
            <?php endif; ?>
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