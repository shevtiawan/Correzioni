<!--[if !IE]>start page<![endif]-->
<div id="page">
  <div class="inner">
    <div class="section table_section">
      <!--[if !IE]>start title wrapper<![endif]-->
      <div class="title_wrapper">
        <h2>Product List</h2>
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
                            <th>Title</th>
                            <!--<th>Description</th>-->
                            <th>Tags</th>
                            <th>Moves</th>
                            <th>Actions</th>
                          </tr>

                          <?php
                            $i = 0;
                            foreach ($products as $product):
                              $class = ' class="first"';
                              if ($i++ % 2 == 0) {
                                $class = ' class="second"';
                              }
                          ?>

                          <tr <?php echo $class;?>>
                            <td style="width: 150px;">
                                <?php
                                echo $this->Html->link($product['Product']['title'], array(
                                    'controller' => 'products',
                                    'action' => 'tabs',
                                    'admin' => true,
                                    'parent_id' => $product['Product']['id']
                                ), array('title' => "See list of products under {$product['Product']['title']}"));
                                ?>
                            </td>
                            <!--><td style="width: 500px;"><?php //echo substr($product['Product']['description'],0,300); ?></td>-->
                            <td style="width: 100px;">
                                <?php echo implode(', ', Set::extract('{n}.title', $product['Category'])); ?>
                            </td>
                            <td style="width: 34px;" style="text-align: center;">
                              <?php if(count($products) > 1){ ?>
                              <div class="move_menu">
                                <ul>
                                  <?php
                                          if($i > 1){
                                             echo "<li>".$this->Html->link(__('Up', true), array('action' => 'move_up', $product['Product']['id']), array('class'=>'move3'))."</li>";
                                           }
                                           if($i > 0 && $i < count($products)){
                                             echo "<li>".$this->Html->link(__('Down', true), array('action' => 'move_down', $product['Product']['id']), array('class'=>'move4'))."</li>";
                                           }
                                   ?>
                                </ul>
                              </div>
                              <?php } ?>
                            </td>
                            <td style="width: 120px;">
                              <div class="actions_menu">
                                <ul>
                                  <li><?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $product['Product']['id']), array('class'=>'edit')); ?></li>
                                  <li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $product['Product']['id']), array('class'=>'delete')); ?></li>
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
