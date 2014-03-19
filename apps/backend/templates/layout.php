<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/images/general/favicon.ico" type="image/x-icon" />
    <?php use_stylesheet(sfConfig::get('sf_app').'/layout.css', 'first') ?>
    <?php use_stylesheet('backend/menu.css'  , 'first') ?>
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
    <script type="text/javascript" src="/js/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
    <script type="text/javascript" src="/sfMediaBrowserPlugin/js/WindowManager.js"></script>
  <!--<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=true&amp;key=ABQIAAAAGtT6x1Tbt2Dy3Aw2VY01BhQCgrDd7XUpK02QnQoBYPr2Ug0lYxSYsuwIMOCm9RFVd9pWnAwi3OfSbQ" type="text/javascript"></script>-->
  
  </head>
  
  <body>
  <script>
  //sfMediaBrowserWindowManager.init('<?php //echo url_for('sf_media_browser_select') ?>');
  </script>
    <div class="wrap">
      <div class="header">
        <?php include_partial('General/header') ?>
      </div>
      
      <div class="content">
        <table class="main">
          <tr>
            <td class="left">
              <?php include_component('General', 'leftBox') ?>
            </td>
            <td class="right">
              <?php include_partial('General/tabs_menu') ?>
              
              <div class="text">
                <?php echo $sf_content ?>
              </div>
            </td>
          </tr>
        </table>
      </div>
      
      <div class="footer">
        <?php include_partial('General/footer') ?>
      </div>
    </div>
  </body>
</html>
