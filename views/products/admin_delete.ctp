<?php
if ($this->params['prefix'] != "admin"): ?>
    <?php
    echo $this->Html->css(array('admin'));
    echo $this->Javascript->link(array('behaviour','css'));
    ?>
<style>
    #page {float: none; margin-left:0;}
    #page .inner{margin-left:0;}
</style>
<?php endif; ?>

<div id="page">
    <div class="inner">
        <div class="section">
            <!--[if !IE]>start title wrapper<![endif]-->
            <div class="title_wrapper">
                <h2>Create <?php echo ($this->params['prefix'] == "admin") ? "Product" : "Tab"; ?></h2>
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
                                    <?php echo $this->Form->create('Product');?>
                                        <p>You are about to delete this product.</p>

                                            <!--[if !IE]>start forms<![endif]-->
                                            <?php echo $this->Form->input('id'); ?>
                                            <?php echo $this->Form->input('parent_id', array('type' => 'hidden')); ?>
                                            <p>Title: <?php echo $this->data['Product']['title']; ?></p>
                                            <br />
                                            <?php echo $this->Form->submit('DELETE', array('div' => false)); ?>
                                            &nbsp;
                                            <?php
                                            if (!empty($this->data['Product']['parent_id'])) {
                                                echo $this->Html->link('Cancel', array(
                                                    'controller' => 'products',
                                                    'action' => 'tabs',
                                                    'parent_id' => $this->data['Product']['parent_id']
                                                ));
                                            } else {
                                                echo $this->Html->link('Cancel', array(
                                                    'controller' => 'products',
                                                    'action' => 'index'
                                                ));
                                            }
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
