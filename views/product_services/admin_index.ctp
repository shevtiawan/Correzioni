<!--[if !IE]>start page<![endif]-->
<div id="page">
  <div class="inner">
    <div class="section table_section">
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
                  <div  id="product_list">
                    <!--[if !IE]>start table_wrapper<![endif]-->
                    <div class="table_wrapper">
                      <div class="table_wrapper_inner">
                        <table cellpadding="0" cellspacing="0" width="100%">
                          <tbody><tr>
                            <th style="width:100px;">Icon</th>
                            <th style="width:200px;">Service</th>
                            <th style="width:100px;">Move</th>
                            <th style="width:120px;">Actions</th>
                          </tr>

                          <?php
                            $i = 0;
                            foreach ($productServices as $productService):
                              $class = ' class="first"';
                              if ($i++ % 2 == 0)  $class = ' class="second"';
                          ?>

                          <tr <?php echo $class;?>>
                            <td class="photo" style="text-align:center;width:100px;">
                              <?php echo $this->Html->image($productService['Service']['image_path'], array('width' => 33, 'height' => 33)); ?>
                            </td>
                            <td style="width:200px;">
                                <?php echo $productService['Service']['title']; ?>
                            </td>
                            <td style="width:100px;">
                              <?php if (count($productServices) > 1): ?>
                                <div class="move_menu">
                                  <ul>
                                    <?php if ($i > 1): ?>
                                      <li>
                                        <?php
                                        echo $this->Html->link(
                                          __('Up', true),
                                          array(
                                            'controller' => 'product_services',
                                            'action' => 'move_up',
                                            'admin' => true,
                                            'product_id' => $product_id,
                                            'id' => $productService['ProductService']['id']
                                          ),
                                          array('class'=>'move3')
                                        ); ?>
                                      </li>
                                    <?php endif; ?>
                                    <?php if ($i > 0 && $i < count($productServices)): ?>
                                      <li>
                                        <?php
                                        echo $this->Html->link(
                                          __('Down', true),
                                          array(
                                            'controller' => 'product_services',
                                            'action' => 'move_down',
                                            'admin' => true,
                                            'product_id' => $product_id,
                                            'id' => $productService['ProductService']['id']
                                          ),
                                          array('class'=>'move4')
                                        ); ?>
                                      </li>
                                    <?php endif; ?>
                                  </ul>
                                </div>
                              <?php endif; ?>
                            </td>
                            <td style="width: 120px;">
                              <div class="actions_menu">
                                <ul>
                                  <li><?php //echo $this->Html->link(__('Edit', true), array('action' => 'edit', 'product_id' => $product_id, 'admin' => true, 'id' => $productService['ProductService']['id']), array('class'=>'edit')); ?></li>
                                  <li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', 'admin' => true, 'product_id' => $product_id, 'id' => $productService['ProductService']['id']), array('class'=>'delete')); ?></li>
                                </ul>
                              </div>
                            </td>
                          </tr>
                          <?php endforeach; ?>
                        </tbody></table>
                      </div>
                    </div>
                    <!--[if !IE]>end table_wrapper<![endif]-->
                  </div>
                  <!--[if !IE]>start pagination<![endif]-->
                  <div class="pagination">
                    <span class="page_no">
                      <?php
                        echo $this->Paginator->counter(array(
                        'format' => __('Page %page% of %pages%', true)
                        ));
                      ?>
                    </span>
                      <ul class="pag_list">
                        <li><?php echo $this->Paginator->prev( __('PREVIOUS', true), array(), null, array('class'=>'disabled'));?></li>
                        <li><?php echo $this->Paginator->numbers();?></li>
                        <li><?php echo $this->Paginator->next(__('NEXT', true) , array(), null, array('class' => 'disabled'));?></li>
                      </ul>
                  </div>
                  <!--[if !IE]>end pagination<![endif]-->
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
