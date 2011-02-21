<div class="forms">
    <?php
        echo $this->Form->input('Service.title');
        echo $this->Form->input('Service.description');
    ?>
    <?php if (!empty($this->data['Service']['id']) && !empty($this->data['Service']['icon'])): ?>
        <div class="input">
            <label>Icon Preview:</label>
            <div class="buttons" style="padding:0;">
                <?php echo $this->Html->image(
                    $this->data['Service']['image_path'],
                    array('width' => 33, 'height' => 33)
                ); ?>
            </div>
        </div>
    <?php endif; ?>
    <?php
    echo $this->Form->input('Service.icon', array('type' => 'file'));
    echo $this->Form->input('Service.icon_dir', array('type' => 'hidden'));
    ?>
    <div class="input">
        <label>&nbsp;</label>
        <div class="buttons" style="padding:0;">
            <span class="button send_form_btn"><span><span>SAVE</span></span><input name="" type="submit" /></span>
        </div>
    </div>
</div>
<!--[if !IE]>end forms<![endif]-->
