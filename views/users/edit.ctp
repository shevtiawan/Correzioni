<div class="users form">
<?php echo $this->Form->create('User');?>
	<fieldset>
 		<legend><?php __('Edit Your Account'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('full_name');
		echo $this->Form->input('email');
	?>
	</fieldset>
	<fieldset>
	    <legend><?php __('Change Password'); ?></legend>
	    <p><?php __("Leave these fields blank if you don't want to change your password"); ?></p>
	<?php
		echo $this->Form->input('password', array('label' => 'Old Password'));
		echo $this->Form->input('new_password', array(
		    'type' => 'password',
		    'div' => array(
		        'class' => 'input password required'
		    )
		));
		echo $this->Form->input('confirm_password', array(
		    'label' => 'Confirm New Password',
		    'type' => 'password',
		    'div' => array(
		        'class' => 'input password required'
		    )
	    ));
    ?>
	</fieldset>
<?php echo $this->Form->end(__('Update', true));?>
</div>
