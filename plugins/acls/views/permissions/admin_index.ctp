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
           echo '<h2>Permissions &raquo; ';
                if (!empty($path)) {
                    $last = array_pop($path);
                    foreach($path as $id => $alias) {
                        $this->Html->addCrumb($alias, array('controller' => 'acos', 'action' => 'index', $id),array('style'=>"color:#ffffff;"));
                    }
                }
                echo $this->Html->getCrumbs(' &#8250; ') . ' &#8250; ' . $last;
                echo  '</h2>';
            echo $form->create('Permission', array('action' => 'delete', 'id' => 'permission-form'));
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
                              <th width="25"><?php echo $html->link($this->Html->image('/acls/img/add.png', array('alt' => 'Add Permission','style' => "border:0px;")), array('action' => 'add', $aco_id), array('escape' => false, 'title' => 'Add Permission')) ?></th>
                              <th>Access Request Object</th>
                              <th class="permission-column">Create</th>
                              <th class="permission-column">Read</th>
                              <th class="permission-column">Update</th>
                              <th class="permission-column">Delete</th>
                            </tr>

                          <?php
                            $i = 0;
                            foreach ($permissions  as $permission):
                              $class = ' class="first"';
                              if ($i++ % 2 == 0) {
                                $class = ' class="second"';
                              }

                              echo '<tr class="' .$class. '">';
                              echo '  <td>' . $form->checkbox('Permission.delete.' . $permission['Permission']['id']) . '</td>';
                              echo '  <td>' . $html->link($this->Html->image('/acls/img/edit.png', array('alt' => 'Edit Permission', 'style'=>'border:0px')), array('action' => 'edit', $aco_id, $permission['Permission']['id']), array('escape' => false, 'title' => 'Edit Permission')) . '</td>';
                              echo '  <td>' . (($permission['Aro']['model'] == 'Group') ? 'Group: ' . $groups[$permission['Aro']['foreign_key']] : 'Users: ' . $users[$permission['Aro']['foreign_key']]) . '<br /><small>' . $permission['Permission']['path'] . '</small></td>';
                              echo '  <td class="permission-column ' . $perms[$permission['Permission']['_create']] . '">' . $perms[$permission['Permission']['_create']] . '</td>';
                              echo '  <td class="permission-column ' . $perms[$permission['Permission']['_read']] . '">' . $perms[$permission['Permission']['_read']] . '</td>';
                              echo '  <td class="permission-column ' . $perms[$permission['Permission']['_update']] . '">' . $perms[$permission['Permission']['_update']] . '</td>';
                              echo '  <td class="permission-column ' . $perms[$permission['Permission']['_delete']] . '">' . $perms[$permission['Permission']['_delete']] . '</td>';
                              echo '</tr>';
                            endforeach;
                          echo $form->hidden('aco_id', array('value' => $aco_id));
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