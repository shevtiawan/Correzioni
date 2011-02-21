<div class="forms">
    <?php if (!empty($this->data['ProductInfo']['id'])): ?>
        <div class="input">
        <label>Logo Thumbnail</label>
        <?php echo $this->Html->image($this->data['ProductInfo']['thumbnail_path']); ?>
        </div>
    <?php endif; ?>
    <?php
    echo $this->Form->hidden('id');
    echo $this->Form->input('product_id', array(
        'type' => 'hidden',
        'value' => (!empty($product_id) ? $product_id : null)
    ));
    echo $this->Form->input('logo', array("type" => "file"));
	echo $this->Form->input('address');
	echo $this->Form->input('city');
	echo $this->Form->input('state');
	echo $this->Form->input('postcode');
	echo $this->Form->input('country');
	echo $this->Form->input('email');
	echo $this->Form->input('phone');
	echo $this->Form->input('fax');
	echo $this->Form->input('google_lat');
	echo $this->Form->input('google_lang');
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
