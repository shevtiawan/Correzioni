<!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="<?php echo $this->Html->css(array('admin-login-ie'));?>" /><![endif]-->
<div id="wrapper">
  <!--[if !IE]>start login wrapper<![endif]-->
  <div id="login_wrapper">
   <?php
      if ($this->Session->check('Message.auth')):
    ?>
		<div class="error">
			<div class="error_inner">
				<strong>Access Denied</strong> | <span>user/password combination wrong</span>
			</div>
		</div>
		<?php
       endif;
    ?>
    <!--[if !IE]>start login<![endif]-->
		<?php echo $this->Form->create('User'); ?>
			<fieldset>
				<h1 id="logo"><a href="#">websitename Administration Panel</a></h1>
				<div class="formular">
					<div class="formular_inner">
            <label>
						 <strong>Username:</strong>
						 <span class="input_wrapper">
						  <input name="data[User][username]" type="text" />
						 </span>
            </label>

            <label>
						  <strong>Password:</strong>
						  <span class="input_wrapper">
							  <input name="data[User][password]" type="password" />
						  </span>
						</label>

            <label class="inline">

            </label>
						<ul class="form_menu">
						  <li><span class="button"><span><span>Submit</span></span><input type="submit" name=""/></span></li>
						  <li>
						    <?php echo $this->Html->link(
						        '<span><span>Forgot Pass</span></span>',
						        array('controller' => 'users', 'action' => 'forgot_password', 'admin' => false),
						        array('escape' => false)
						    ); ?>
						  </li>
						</ul>
          </div>
        </div>
      </fieldset>
    </form>
		<!--[if !IE]>end login<![endif]-->
  </div>
	<!--[if !IE]>end login wrapper<![endif]-->
</div>
<!--[if !IE]>end wrapper<![endif]-->
