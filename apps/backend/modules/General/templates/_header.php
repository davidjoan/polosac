<script type="text/javascript">
    function create( template, vars, opts ){
        return $container.notify("create", template, vars, opts);
    }
    
    $(function(){

       
       <?php if($sf_user->isAdmin()): ?>
           $container = $("#container").notify({ stack:'above' } );
         <?php foreach($sf_user->getNotifications() as $notification): ?>
      create("default", { title:'Alerta', text:'<?php echo $notification; ?>'},{ expires: false });
      <?php endforeach; ?>
      <?php endif; ?>
          
          
          });
                   

</script>

<!--- container to hold notifications, and default templates --->
<div id="container" style="display:none; top:auto; left:0; bottom:0; margin:0 0 10px 10px">

    <div id="default">
        <a class="ui-notify-close ui-notify-cross" href="#">x</a>
        <h1>#{title}</h1>
        <p>#{text}</p>
    </div>

</div>


<table>
  <tr>
    <td class="left">
      <?php echo link_to(image_tag('general/logo.jpg', array('height' => '60px')), 'http://polosac.pe/') ?>
    </td>
    <td class="right">
      <?php echo image_tag('backend/secure_user.png') ?>&nbsp;<?php echo $sf_user->getUsername() ?> | <?php echo $sf_user->getCompanyName() ?><br/><br/>
      <?php echo $sf_user->getDatetimeFormatter()->getCurrentDateTime('dd / MMMM / yyyy - HH:mm:ss'); ?>
    </td>
  </tr>
</table>
