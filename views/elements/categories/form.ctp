<?php
echo $this->Html->css(array('colorpicker'));
echo $this->Javascript->link(array('colorpicker','eye','utils','layout'));
?>
<div class="forms">
	<!--[if !IE]>start row<![endif]-->
    <?php
    echo $this->Form->input('parent_id', array(
        'options' => $parents,
        'empty' => 'None',
        'selected' => (isset($parent_id) ? $parent_id : null)
    ));
    echo $this->Form->input('title');
    echo $this->Form->input('description');
    ?>

    <?php if(isset($this->data['Category']['id'])): ?>
        <div class="input">
            <label>Icon Thumbnail</label>
            <?php
            if (!empty($this->data['Category']['icon_path'])) {
                echo $this->Html->image($this->data['Category']['image_path'], array('id'=>"photo"));
            }
            ?>
        </div>
    <?php endif; ?>
    <?php
    echo $this->Form->input('icon_path', array("type" => "file", 'label' => 'Icon'));
    echo $this->Form->hidden('icon_dir');
    echo $this->Form->input('color', array('label'=>'Background Color'));
    echo $this->Form->input('lft', array('type' => "hidden"));
    echo $this->Form->input('rght', array('type' => "hidden"));
    echo $this->Form->input('is_published');
    ?>
    <div class="input">
      <label>&nbsp;</label>
      <div class="buttons" style="padding:0;">
        <span class="button send_form_btn"><span><span>SAVE</span></span><input name="" type="submit" /></span>
      </div>
    </div>
</div>
<!--[if !IE]>end forms<![endif]-->

<script type="text/javascript">
    $(document).ready(function() {
        $('#CategoryColor').ColorPicker({
            onSubmit: function(hsb, hex, rgb, el) {
                $(el).val(hex);
                $(el).ColorPickerHide();
            },
            onBeforeShow: function () {
                $(this).ColorPickerSetColor(this.value);
            }
        })
        .bind('keyup', function(){
            $(this).ColorPickerSetColor(this.value);
        });
  });
</script>
