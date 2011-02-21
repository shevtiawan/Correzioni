<!--[if !IE]>start logo and user details<![endif]-->
<div id="logo_user_details">
  <h1 id="logo"><a href="#">websitename Administration Panel</a></h1>
  <!--[if !IE]>start user details<![endif]-->
  <div id="user_details">
    <?php echo $this->element('admins/login_status'); ?>
	  <!--[if !IE]>start search<![endif]-->
	  <div id="search_wrapper">
		<?php
		$formAction = array(
	        'controller' => 'products',
	        'action' => 'index',
	        'admin'=> true
	    );
	    if (isset($parent_id) && $this->params['controller'] == 'products') {
	        $formAction = array(
	            'controller' => 'products',
	            'action' => 'tabs',
	            'admin'=> true,
	            'parent_id' => $parent_id
	        );
	    }
		echo $this->Form->create('Product', array(
		    'url' => $formAction
		)); ?>
          <fieldset>
            <label><input class="text" name="data[Product][title]" type="text" /></label>
			<span class="go"><input name="" type="submit" /></span>
          </fieldset>
        <?php echo $this->Form->end(); ?>
    </div> <!--[if !IE]>end search<![endif]-->
  </div> <!--[if !IE]>end user details<![endif]-->
</div><!--[if !IE]>end logo end user details<![endif]-->

<!--[if !IE]>start menus_wrapper<![endif]-->
<div id="menus_wrapper">
	<?php echo $this->element('admins/menu'); ?>
</div>
<!--[if !IE]>end menus_wrapper<![endif]-->
