<div class="forms">
    <?php
    echo $this->Form->hidden('product_id', array('value' => $product_id));
    echo $this->Form->input('service_id', array(
        'options' => $this->data['ProductService']['service_id'],
        'multiple' => true
    ));
    ?>

    <div class="input">
        <label>&nbsp;</label>
        <div class="buttons" style="padding:0;">
            <span class="button send_form_btn">
                <span><span>SAVE</span></span><input name="" type="submit" />
            </span>
        </div>
    </div>
</div>
