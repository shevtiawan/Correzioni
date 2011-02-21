<?php
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.console.libs.templates.skel.views.layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php echo $this->Html->charset(); ?>
    <title>
        <?php __('Correzioni Administration Panel - '); ?>
        <?php echo $title_for_layout; ?>
    </title>
    <?php
        echo $this->Html->meta('icon');
        echo $this->Html->css(array('cake.generic', 'admin'));
        echo $scripts_for_layout;
        echo $this->Javascript->link(array('jquery.min'));
    ?>
</head>
<body>
    <div id="container">
        <div id="header">
            <h1><?php echo $this->Html->link(__('Correzioni Administration Panel', true), '/'); ?></h1>
            <ul id="nav">
                <li>
                    <?php
                    echo $this->Html->link("Category", array(
                        'controller' => 'categories', 'action' => 'index', 'admin' => true)
                    ); ?>
                </li>
                <li>
                    <?php
                    echo $this->Html->link("Product", array(
                        'controller' => 'products', 'action' => 'index', 'admin' => true)
                    ); ?>
                </li>
                <li>
                    <?php
                    echo $this->Html->link("Rating", array(
                        'controller' => 'ratings', 'action' => 'index', 'admin' => true)
                    ); ?>
                </li>
                <li>
                    <?php
                    echo $this->Html->link("Service", array(
                        'controller' => 'services', 'action' => 'index', 'admin' => true)
                    ); ?>
                </li>
                <li>
                    <?php
                    echo $this->Html->link("Admin", '#'); ?>
                </li>
                <li>
                    <?php
                    echo $this->Html->link("Role", '#'); ?>
                </li>
                <li>
                    <?php
                    echo $this->Html->link("Template", '#'); ?>
                </li>
            </ul>
        </div>
        <div id="content">
            <?php echo $this->Session->flash(); ?>
            <?php echo $content_for_layout; ?>
        </div>
        <div id="footer">
            <?php echo $this->Html->link(
                $this->Html->image('cake.power.gif',
                                   array('alt'=> __('CakePHP: the rapid development php framework', true),
                                         'border' => '0')),
                'http://www.cakephp.org/',
                array('target' => '_blank', 'escape' => false));
            ?>
        </div>
    </div>
</body>
</html>
