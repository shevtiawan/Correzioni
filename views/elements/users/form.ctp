<div class="forms">
  <?php
	if (!empty($this->data['User']['id'])) {
        //echo $this->Form->input('new_password', array('type' => 'password'));
    } else {
        echo $this->Form->input('username');
        //echo $this->Form->input('password');
    }

    echo $this->Form->input('new_password', array('type'=>"password", 'label' => 'Password'));
    echo $this->Form->input('confirm_password',array('type'=>"password"));
	echo $this->Form->input('full_name');
	echo $this->Form->input('email');
	echo $this->Form->input('group_id', array('options' => $groups, 'empty' => true));
	echo $this->Form->input('active');
  ?>

 <div class="input">
    <label>&nbsp;</label>
    <div class="buttons" style="padding:0;">
      <span class="button send_form_btn"><span><span>SAVE</span></span><input name="" type="submit" /></span>
  </div>
</div>
