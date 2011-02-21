<div class="forms">
    <?php
    echo $this->Form->input('product_id', array(
        'value' => (isset($product_id) ? $product_id : null),
        'type' => 'hidden'
    ));
    echo $this->Form->input('caption'); ?>
    <?php if (!empty($this->data['ProductGallery']['id']) &&
        !empty($this->data['ProductGallery']['image'])): ?>
        <div class="input">
            <label>Image Thumbnail</label>
            <?php
            echo $this->Html->image($this->data['ProductGallery']['thumbnail_path'], array('id'=>"photo"));
            ?>
        </div>
    <?php endif; ?>
    <?php
    echo $this->Form->input('image', array('type' => 'file'));
    echo $this->Form->hidden('image_dir');
    echo $this->Form->input('is_featured');
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
