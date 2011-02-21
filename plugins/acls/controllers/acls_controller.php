<?php
/**
 * ACL Management Plugin
 *
 * @copyright     Copyright 2010, Joseph B Crawford II
 * @link          http://www.jbcrawford.net
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
class AclsController extends AclsAppController {
    var $name = 'Acls';
    var $uses = array();
    var $layout = 'admin';
    
	function beforeFilter() {
		parent::beforeFilter();
		
		$this->Auth->allow('*');
	}
	
    function admin_index() {
        $this->redirect(array('controller' => 'acos'));
    }
}
?>
