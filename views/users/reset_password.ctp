<!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="<?php echo $this->Html->css(array('admin-login-ie'));?>" /><![endif]-->
<div id="wrapper">
  <!--[if !IE]>start login wrapper<![endif]-->
  <div id="login_wrapper">
    <?php if (!empty($this->validationErrors['User']['email'])): ?>
		<div class="error">
			<div class="error_inner">
				<strong><?php echo $this->validationErrors['User']['email']; ?></strong>
			</div>
		</div>
	<?php endif; ?>
    <!--[if !IE]>start login<![endif]-->
		<?php
		echo $this->Form->create('User', array(
		    'url' => Router::url(array(
		        'controller' => 'users', 'action' => 'reset_password', $code
            ))
		)); ?>
			<fieldset>
				<h1 id="logo"><a href="#">websitename Administration Panel</a></h1>
				<div class="formular">
					<div class="formular_inner">
					    <?php
					    echo $this->Form->input('id');
					    echo $this->Form->input('username', array('type' => 'hidden')); ?>
                        <label>
				             <strong>New Password:</strong>
				             <span class="input_wrapper">
				            <?php echo $this->Form->input('password', array(
				                'div' => false, 'label' => false, 'error' => false
				            )); ?>
				             </span>
                        </label>
                        <label>
				             <strong>Confirm Password:</strong>
				             <span class="input_wrapper">
				            <?php echo $this->Form->input('confirm_password', array(
				                'div' => false, 'label' => false, 'error' => false, 'type' => 'password'
				            )); ?>
				             </span>
                        </label>

                        <label class="inline">
                        </label>
						<ul class="form_menu">
						  <li><span class="button"><span><span>Submit</span></span><input type="submit" name=""/></span></li>
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
