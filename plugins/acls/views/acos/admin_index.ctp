<?php 
  echo $this->Html->css('/acls/css/tables');
  echo $this->Html->script(array('/acls/js/jquery-1.4.2.min', '/acls/js/jquery-acl'));
?>
<!--[if !IE]>start page<![endif]-->
<div id="page">
  <div class="inner">
    <div class="section table_section">
      <!--[if !IE]>start title wrapper<![endif]-->
      <div class="title_wrapper">
        <?php
            echo '<h2>Access Control &raquo; ';
            if (!empty($path)) {
                foreach($path as $id => $alias) {
                    $this->Html->addCrumb($alias, array('action' => 'index', $id),array('style' => "color:#FFFFFF;"));
                }
            }
            echo $this->Html->getCrumbs(' &#8250; ');
            echo  '</h2>';
            echo $form->create('Aco', array('action' => 'delete', 'id' => 'aco-form'));
        ?>
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
                  <div  id="service_list">
                    <!--[if !IE]>start table_wrapper<![endif]-->
                    <div class="table_wrapper">
                      <div class="table_wrapper_inner">
                        <table cellpadding="0" cellspacing="0" width="100%">
                          <tbody>
                            <tr>
                              <th width="25"><?php echo $form->checkbox(null, array('id' => 'select-all')) ?></th>
                              <th width="25"><?php echo $html->link($this->Html->image('/acls/img/add.png', array('alt' => 'Add ACO','style' => "border:0px;")), array('action' => 'add', $aco_parent_id), array('escape' => false, 'title' => 'Add ACO')) ?></th>
                              <th width="75"></th>
                              <th></th>
                              <th>Alias</th>
                              <th>Model</th>
                              <th>ForeignKey</th>
                            </tr>

                          <?php
                            $i = 0;
                            foreach ($acos  as $aco):
                              $class = ' class="first"';
                              if ($i++ % 2 == 0) {
                                $class = ' class="second"';
                              }

                              echo '<tr class="' .$class. '">';
                              echo '  <td>' . $form->checkbox('Aco.delete.' . $aco['Aco']['id']) . '</td>';
                              echo '  <td>' . $html->link($this->Html->image('/acls/img/edit.png', array('alt' => 'Edit ACO','style' => "border:0px;")), array('action' => 'edit', $aco['Aco']['id']), array('escape' => false, 'title' => 'Edit ACO')) . '</td>';
                              echo '  <td>' . $html->link($this->Html->image('/acls/img/permissions.png', array('alt' => 'View Permissions','style' => "border:0px;")), array('controller' => 'permissions', 'action' => 'index', $aco['Aco']['id']), array('escape' => false, 'title' => 'View Permissions')) . ' <small>(' . $aco['Aco']['num_permissions'] . ')</small></td>';
                              echo '  <td>' . (($aco['Aco']['num_children'] > 0) ? $html->link('Children', array('action' => 'index', $aco['Aco']['id'])) : 'Children') . ' <small>(' . $aco['Aco']['num_children'] . ')</small></td>';
                              echo '  <td>' . $aco['Aco']['alias'] . '</td>';
                              echo '  <td>' . $aco['Aco']['model'] . '</td>';
                              echo '  <td>' . $aco['Aco']['foreign_key'] . '</td>';
                              echo '</tr>';
                            endforeach;
                          echo $form->hidden('parent_id', array('value' => $aco_parent_id));
                          ?>
                        </tbody></table>                          
                      </div>
                    </div>
                    <div class="input">
                      <label>&nbsp;</label>
                      <div class="buttons" style="padding:0;">
                        <span class="button red_btn"><span><span>DELETE</span></span><input name="" type="submit" /></span>
                      </div>
                    </div>
                    <?php echo $form->end(); ?>
                    <p>&nbsp;</p>
                    <!--[if !IE]>end table_wrapper<![endif]-->
                  </div>
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

<script type="text/javascript">
    $(document).ready(function() {
        $('#rebuildButton').click(function() {
            $('#aco-form').attr('action', '/acls/acos/rebuild').submit();
        });
    });
</script>
