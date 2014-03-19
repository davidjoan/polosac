<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/images/general/favicon.ico" type="image/x-icon" />
    <?php use_stylesheet('backend/log/layout.css', 'first') ?>
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
  </head>
  
  <body>
    <div class="wrap">
      <div class="header">
        <?php echo image_tag('general/logo.gif', array('height' => '160px'))?>
      </div>
      
      <div class="content">
        <?php echo $sf_content ?>
      </div>
      
      <div class="footer">
          &copy; 2012  - <?php echo link_to('POLO S.A.C.', '/') ?> .  Todos los Derechos Reservados. 
      </div>
    </div>
  </body>
</html>
