<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php echo $this->Html->charset(); ?>
    <title>
        <?php __('Correzioni Administration Panel - '); ?>
        <?php echo $title_for_layout; ?>
    </title>
    <?php
        echo $this->Html->meta('icon');
        echo $this->Html->css(array('admin','nyroModal.full'));
        echo $scripts_for_layout;
        echo $this->Javascript->link(array(
            'jquery.min','behaviour','css','jquery.nyroModal-1.6.2.pack',
            'ckeditor/ckeditor'
        ));
    ?>

</head>
  <body>
  <!--[if !IE]>start wrapper<![endif]-->
	<div id="wrapper">
		<!--[if !IE]>start head<![endif]-->
		<div id="head">
			<?php echo $this->element('admins/header'); ?>
		</div>
		<!--[if !IE]>end head<![endif]-->
		<div id="content">
		<!--[if !IE]>start content<![endif]-->
		  <?php echo $content_for_layout; ?>
      <?php echo $this->element(strtolower($controllerName).'/sidebar'); ?>
		<!--[if !IE]>end content<![endif]-->
		</div>
	</div>
	<!--[if !IE]>end wrapper<![endif]-->

	<?php echo $this->element('admins/footer'); ?>
  </body>
</html>
