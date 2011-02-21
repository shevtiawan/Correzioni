<div id="page">
  <div class="inner">
    <div class="section">
      <!--[if !IE]>start title wrapper<![endif]-->
      <div class="title_wrapper">
        <h2>User Form</h2>
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
                  <?php echo $this->Form->create('User');?>
                    <p>You are about to delete this user.</p>
                      <!--[if !IE]>start forms<![endif]-->
                      <?php echo $this->Form->input('id'); ?>
                          <p>Username: <?php echo $this->data['User']['username']; ?></p>
                          <br />
                          <?php echo $this->Form->submit('DELETE', array('div' => false)); ?>
                          &nbsp;
                          <?php
                            echo $this->Html->link('Cancel', array(
                              'controller' => 'users',
                              'action' => 'index'
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
