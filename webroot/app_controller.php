<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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
 * @subpackage    cake.app
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       cake
 * @subpackage    cake.app
 */
class AppController extends Controller {
    public $helpers = array(
        'Javascript',
        'Session',
        'Html',
        'Form',
        'Cropimage',
        'StarRating'
    );
    public $components = array(
        'JqImgcrop',
        'Session',
        'Auth',
        'Acl',
        'DebugKit.Toolbar',
        'RequestHandler'
    );

    public function beforeFilter() {
        $this->Auth->loginAction = array('controller' => 'users', 'action' => 'login', 'admin' => false);
        $this->Auth->loginRedirect = array('controller' => 'categories', 'action' => 'index', 'admin' => true);
        $this->Auth->logoutRedirect = array('controller' => 'pages', 'action' => 'home', 'admin' => false);
        $this->Auth->allow('index', 'view');
        if (!eregi('admin', $this->params['action'])) $this->Auth->allow('*');

        if (!isset($this->params['prefix'])) {
            if ($this->Auth->user()) {
                $votedList = ClassRegistry::init('Vote')->votedList($this->Auth->user('id'));
                $this->set(compact('votedList'));
            }
        } else {
            if ($this->params['prefix'] == 'admin') {
                $this->set(array(
                    'setting_id' => ClassRegistry::init('Setting')->field('id')
                ));
            }
        }
    }

    public function beforeRender() {
        if (!isset($this->params['prefix'])) {
            $this->set('nav', ClassRegistry::init('Category')->getMainCategories());
        } else {
            if ($this->params['prefix'] == 'admin') {
                $controllerName = $this->params['controller'];
                $controllerName = eregi('^product', $controllerName) ? "products" : $controllerName;
                $this->set(compact('controllerName'));
            }
        }
        $this->set('user', $this->Auth->user());
    }
}
