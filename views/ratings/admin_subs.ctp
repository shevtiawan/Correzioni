<!--[if !IE]>start page<![endif]-->
<div id="page">
  <div class="inner">
    <div class="section table_section">
      <!--[if !IE]>start title wrapper<![endif]-->
      <div class="title_wrapper">
        <h2>Rating List</h2>
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
                            <th class="photo"><span>Icon</span></th>
                            <th><a href="#">Subs#</a></th>
                            <th><a href="#">Title</a></th>
                            <th><a href="#">Description</a></th>
                            <th>Actions</th>
                          </tr>

                          <?php
                            $i = 0;
                            foreach ($ratings as $rating):
                              $class = ' class="first"';
                              if ($i++ % 2 == 0) {
                                $class = ' class="second"';
                              }
                          ?>

                          <tr <?php echo $class;?>>
                            <td class="photo" style="text-align:center;">
                              <?php
                                 if (!empty($rating['Rating']['icon_path'])){
                                  echo $this->Html->image($rating['Rating']['thumbnail_path']);
                                }
                              ?>
                            </td>
                            <td style="width: 16px;">
                              <?php echo $this->Html->image('action1.gif') ?>
                              <?php
                                if($rating['Rating']['num_children'] > 0){
                                   $subs_count = $this->Html->link($rating['Rating']['num_children'],
                                            array('controller' => 'ratings',
                                                  'action' => 'subs',
                                                  'parent_id' => $rating['Rating']['id']));
                                 } else {
                                   $subs_count = $rating['Rating']['num_children'];
                                 }
                              ?>
                              (<b><?php echo $subs_count; ?></b>)
                            </td>
                            <td style="width: 200px;"><?php echo $rating['Rating']['title']; ?></td>
                            <td style="width: 500px;"><?php echo $rating['Rating']['description']; ?></td>
                            <td style="width: 120px;">
                              <div class="actions_menu">
                                <ul>
                                  <li><?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $rating['Rating']['id']), array('class'=>'edit')); ?></li>
                                  <li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $rating['Rating']['id']), array('class'=>'delete')); ?></li>
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
