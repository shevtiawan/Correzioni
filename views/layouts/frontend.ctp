<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <?php echo $this->Html->charset(); ?>
    <title>
    	<?php __('Correzioni - '); ?>
    	<?php echo $title_for_layout; ?>
    </title>
    <?php
    	echo $this->Html->meta('icon');
    	echo $this->Html->css(array('spaguideasia', 'jquery.ui.stars'));
        echo $this->Html->script(array(
            'jquery-1.4.4.min', 'jquery-ui-1.8.7.custom.min',
            'jquery.accordion', 'jquery.ui.stars', 'correzioni',
        ));
        echo $scripts_for_layout;
    ?>
</head>
<body>
    <div id="wrapper">
        <div id="header">
            <div id="header_block">
                <div id="search_box">
                    <!--><form id="search_form" method="post" action="#">-->
                    <?php
                    echo $this->Form->create('Product', array(
                        'url' => array('controller' => 'search_items', 'action' => 'index')
                    ));
                    ?>
                        <input type="text" id="s" name="data[Product][title]" size="20" value="search" class="swap_value" onblur="javascript:if(this.value=='') {this.value='search';}" onfocus="javascript:if(this.value=='search') {this.value='';}" />
                        <input type="image" src="./images/blank.gif" width="20" height="24" id="go" alt="" title="Search" />
                    <?php echo $this->Form->end(); ?>
                    <!--></form>-->
                </div>
                <div id="social">
                    <div id="social_fb">
                        <a href="http://www.facebook.com/sharer.php?u=URL" title="Facebook" target="_blank">
                            <img src="images/blank.gif" width="27" height="27" border="0"/>
                        </a>
                    </div>
                    <div id="social_bing">
                        <a href="#" title="Bing" target="_blank">
                            <img src="images/blank.gif" width="27" height="27" border="0"/>
                        </a>
                    </div>
                    <div id="social_x">
                        <a href="#" title="?" target="_blank">
                            <img src="images/blank.gif" width="27" height="27" border="0"/>
                        </a>
                    </div>
                    <div id="social_fr">
                        <a href="#" title="Friendster" target="_blank">
                            <img src="images/blank.gif" width="27" height="27" border="0"/>
                        </a>
                    </div>
                    <div id="social_del">
                        <a href="#" title="Delicious" target="_blank">
                            <img src="images/blank.gif" width="27" height="27" border="0"/>
                        </a>
                    </div>
                    <div id="social_rss">
                        <?php echo $this->Html->link(
                            $this->Html->image(
                                '/images/blank.gif',
                                array('width' => 27, 'height' => 27, 'border' => 0)
                            ),
                            array(
                                'controller' => 'products',
                                'action' => 'feed',
                                'url' => array('ext' => 'rss')
                            ),
                            array('title' => 'RSS feed', 'escape' => false)
                        );
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div id="menu">
            <?php echo $this->element('navigation'); ?>
        </div>
        <div id="content">
            <div id="mainContent">
                <?php echo $content_for_layout; ?>
            </div>
            <div id="bannerAdv">
                <?php
                echo $this->Html->link(
                    $this->Html->image('banner.jpg'),
                    'http://www.lembahspa.com',
                    array('escape' => false)
                );
                ?>
            </div>
        </div>
        <div id="footer">Copyright 2010 Spa Guide Asia</div>
    </div>
</body>
</html>
