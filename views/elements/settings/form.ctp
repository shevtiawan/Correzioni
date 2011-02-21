<div class="forms">
  <div class="input">
    <ul class="system_messages">
      <li class="blue">
        <span class="ico"></span>
        <strong class="system_title">Company Information</strong>
      </li>
    </ul>
  </div>
  <?php
    echo $this->Form->input('company_name');
		echo $this->Form->input('about_us');
		echo $this->Form->input('contact_us');
		echo $this->Form->input('terms_of_conditions');
  ?>
  <div class="input">
    <ul class="system_messages">
      <li class="blue">
        <span class="ico"></span>
        <strong class="system_title">SMTP Configuration</strong>
      </li>
    </ul>
  </div>
  <?php
		echo $this->Form->input('id');
		echo $this->Form->input('smtp_username', array('label' => 'SMTP Username'));
		echo $this->Form->input('smtp_address', array('label' => 'SMTP Address'));
		echo $this->Form->input('smtp_password', array('label' => 'SMTP Password', 'type' => 'password'));
		echo $this->Form->input('smtp_port', array('label' => 'SMTP Port'));
  ?>
  <div class="input">
    <ul class="system_messages">
      <li class="blue">
        <span class="ico"></span>
        <strong class="system_title">Gallery Configuration</strong>
      </li>
    </ul>
  </div>
  <?php
    echo $this->Form->input('image_thumbnail_size', array('label' => 'Thumbnail Width'));
		echo $this->Form->input('image_medium_size', array('label' => 'Medium Width'));
		echo $this->Form->input('image_large_size', array('label' => 'Big Width'));
  ?>
    <div class="input">
        <label>&nbsp;</label>
        <div class="buttons" style="padding:0;">
            <span class="button send_form_btn"><span><span>SAVE</span></span><input name="" type="submit" /></span>
        </div>
    </div>
</div>
