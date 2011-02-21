<?php
class SettingsController extends AppController {

	var $name = 'Settings';

    var $layout = 'admin';

	// add and edit combined
	function admin_configure() {
        if (!empty($this->data)) {
            $this->Setting->create();
            if ($this->Setting->save($this->data)) {
                $this->Session->setFlash(__('Setting has been saved', true));
	            $this->redirect(array(
	                'controller' => 'settings',
	                'action' => 'configure'
	            ));
            }
        } else {
            $this->data = $this->Setting->find('first');
        }
	}
}
