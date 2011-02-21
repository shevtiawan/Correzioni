<div id="page">
  <div class="inner">
    <div class="section">
      <!--[if !IE]>start title wrapper<![endif]-->
      <div class="title_wrapper">
        <h2><?php echo $product['Product']['title'] ?> Service</h2>
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
                  <?php if (!empty($this->data['ProductService']['service_id'])): ?>
                      <?php
                      echo $this->Form->create('ProductService', array(
                        'url' => array(
                            'controller' => 'product_services',
                            'action' => 'add',
                            'admin' => true,
                            'product_id' => $product_id
                        )
                      )); ?>
                        <!--[if !IE]>start fieldset<![endif]-->
                        <fieldset>
                        <!--[if !IE]>start forms<![endif]-->
                        <?php echo $this->element('product_services/form'); ?>
                        </fieldset>
                        <!--[if !IE]>end fieldset<![endif]-->
                      </form>
                      <!--[if !IE]>end forms<![endif]-->
                  <?php else: ?>
                    <div>There were 2 possibilities if you see this message:
                        <ul>
                            <li>There is no available service yet</li>
                            <li>All available services has been added to your product</li>
                        </ul>
                    </div>
                  <?php endif; ?>
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
