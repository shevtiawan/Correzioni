<div class="forms">
    <?php
        if (!empty($this->data['Template']['id'])) {
            echo $this->Form->input('name', array('disabled' => true));
            echo $this->Form->input('package', array('disabled' => true));
        } else {
            echo $this->Form->input('package', array('type' => 'file'));
        }
        echo $this->Form->input('is_activated', array('label' => 'Activate now?'));
    ?>
    <div class="input">
        <label>&nbsp;</label>
        <div class="buttons" style="padding:0;">
            <span class="button send_form_btn"><span><span>SAVE</span></span><input name="" type="submit" /></span>
        </div>
    </div>
</div>
<!--[if !IE]>end forms<![endif]-->
