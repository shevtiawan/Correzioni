<?php
class ServicesController extends AppController {
	var $name = 'Services';

    var $layout = 'admin';

	function admin_index() {
		$this->set('services', $this->paginate());
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Service->create();
			if ($this->Service->save($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'service'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'service'));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'service'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Service->save($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'service'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'service'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Service->read(null, $id);
		}
	}

	function admin_delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for service', true));
            $this->redirect(array('action'=>'index'));
        }
        if (!empty($this->data)) {
            if ($this->Service->delete($id)) {
                $this->Session->setFlash(__('Service deleted', true));
                $this->redirect(array('action'=>'index'));
            }
            $this->Session->setFlash(__('Service was not deleted', true));
            $this->redirect(array('action' => 'index'));
        } else {
            $this->data = $this->Service->read(array('id', 'title'), $id);
        }
        if (empty($this->data['Service'])) {
            $this->Session->setFlash(__('Invalid id for service', true));
            $this->redirect(array('action'=>'index'));
        }
    }
}
