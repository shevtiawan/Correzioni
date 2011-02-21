<div class="forms">
    <?php
	echo $this->Form->input('parent_id', array(
	    'options' => $parents,
        'empty' => 'None',
        'selected' => (isset($parent_id) ? $parent_id : null)
	));
	echo $this->Form->input('title'); ?>
	<?php if (!empty($this->data['Rating']['id']) && !empty($this->data['Rating']['icon_path'])): ?>
        <div class="input">
            <label>Icon Preview:</label>
            <div class="buttons" style="padding:0;">
                <?php echo $this->Html->image(
                    $this->data['Rating']['image_path'],
                    array('width' => 73, 'height' => 13)
                ); ?>
            </div>
        </div>
    <?php endif; ?>
    <?php
    echo $this->Form->input('icon_path', array('type' => "file", 'label' => 'Icon'));
	echo $this->Form->input('description');
	echo $this->Form->hidden('lft');
	echo $this->Form->hidden('rght');
	echo $this->Form->input('is_published');
	?>
    <div class="input">
        <label>&nbsp;</label>
        <div class="buttons" style="padding:0;">
            <span class="button send_form_btn">
                <span><span>SAVE</span></span>
                <input name="" type="submit" />
            </span>
        </div>
    </div>
</div>
