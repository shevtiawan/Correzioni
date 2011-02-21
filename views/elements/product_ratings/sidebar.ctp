<!--[if !IE]>start section<![endif]-->
<div class="section">
  <!--[if !IE]>start title wrapper<![endif]-->
  <div class="title_wrapper">
    <h2>Add Ratings</h2>
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
            <div class="sct_right" style="padding:6px;">
              <ul class="sidebar_menu">
                <li>
                    <?php
                    echo $this->Html->link(
                        'Add available ratings',
                        array(
                            'controller' => 'product_ratings',
                            'action' => 'add',
                            'admin' => true,
                            'product_id' => $product_id
                        ),
                        array('class' => 'sm-list')
                    );
                    ?>
                </li>
              </ul>
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
