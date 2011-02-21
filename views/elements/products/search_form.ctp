<div class="sct_right">
    <?php
    $formURL = null;
    if (isset($parent_id)) {
        $formURL = array(
            'controller' => 'products',
            'action' => 'tabs',
            'admin' => true,
            'parent_id' => $parent_id
        );
    }
    echo $this->Form->create('Product', array(
        'inputDefaults' => array(
            'label' => false,
            'div' => false
        ),
        'url' => $formURL
    ));
    ?>
    <div class="input">
      <label>Title</label><br />
      <?php echo $this->Form->input('title'); ?>
    </div>
    <div class="input">
      <label>Category</label><br />
      <?php echo $this->Form->input('category'); ?>
    </div>
    <div class="input">
      <label>&nbsp;</label>
      <div class="buttons" style="padding:0;">
        <span class="button send_form_btn">
          <span><span>SEARCH</span></span>
          <input name="" type="submit" />
        </span>
      </div>
    </div>
    <br />
    <?php echo $this->Form->end(); ?>
</div>
