<div id="page">
  <div class="inner">
    <div class="section">
      <!--[if !IE]>start title wrapper<![endif]-->
      <div class="title_wrapper">
        <h2><?php echo $product['Product']['title'] ?> Gallery</h2>
        <?php echo $this->element('products/section_menu'); ?>
        <span class="title_wrapper_left"></span>
        <span class="title_wrapper_right"></span>
      </div>
      <!--[if !IE]>end title wrapper<![endif]-->

      <!--[if !IE]>start section content<![endif]-->
      <div class="section_content">
        <!--[if !IE]>start section content top<![endif]-->
        <div class="sct">
          <div class="sct_left">
            <div class="sct_right">
              <div class="sct_left">
                <div class="sct_right">
                  <?php echo $this->Form->create('ProductGallery', array(
                    'url' => Router::url(array(
                      'controller' => 'product_galleries',
                      'action' => 'delete',
                      'product_id' => $product_id,
                      'id' => $this->data['ProductGallery']['id']
                    ))
                  ));?>
                    <p>You are about to delete this gallery.</p>
                      <!--[if !IE]>start forms<![endif]-->
                      <?php echo $this->Form->input('id'); ?>
                          <p>
                            Preview:<br />
                            <?php echo $this->Html->image($this->data['ProductGallery']['thumbnail_path']); ?>
                            <br />
                            Caption: <?php echo $this->data['ProductGallery']['caption']; ?>
                          </p>
                          <br />
                          <?php echo $this->Form->submit('DELETE', array('div' => false)); ?>
                          &nbsp;
                          <?php
                          echo $this->Html->link('Cancel', array(
                            'controller' => 'product_galleries',
                            'action' => 'index',
                            'product_id' => $product_id
                          ));
                          ?>
                    <!--[if !IE]>end forms<![endif]-->
                  <?php echo $this->Form->end();?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--[if !IE]>end section content top<![endif]-->

        <!--[if !IE]>start section content bottom<![endif]-->
        <span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>
        <!--[if !IE]>end section content bottom<![endif]-->
      </div>
      <!--[if !IE]>end section content<![endif]-->

    </div>
    <!--[if !IE]>end section<![endif]-->
  </div>
</div>
