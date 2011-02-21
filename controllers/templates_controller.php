<?php

class TemplatesController extends AppController {

    public $name = 'Templates';

    public $layout = 'admin';

    public function admin_index()
    {
        $this->set('templates', $this->paginate());
    }

    public function admin_add() {
        if (!empty($this->data)) {
            if (isset($this->data['Template']['package']['name'])) {
                $this->data['Template']['name'] = basename($this->data['Template']['package']['name'], '.zip');
            }

            if ($this->Template->save($this->data)) {
                $this->Session->setFlash(__('Template has been uploaded', true));
                $this->redirect(array('action' => 'index'));
            } else {
                if (!empty($this->Template->validationErrors['name'])) {
                    $this->Template->invalidate('package', $this->Template->validationErrors['name']);
                }
                $this->Session->setFlash(__('Template was not uploaded, please try again', true));
            }
        }
    }

    function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'template'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Template->save($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'template'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'template'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Template->read(null, $id);
		}
	}

    function admin_delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for template', true));
            $this->redirect(array('action'=>'index'));
        }
        if (!empty($this->data)) {
            if ($this->Template->delete($id)) {
                $this->Session->setFlash(__('Template deleted', true));
                $this->redirect(array('action'=>'index'));
            }
            $this->Session->setFlash(__('Template was not deleted', true));
            $this->redirect(array('action' => 'index'));
        } else {
            $this->data = $this->Template->read(array('id', 'name'), $id);
        }
        if (empty($this->data['Template'])) {
            $this->Session->setFlash(__('Invalid id for template', true));
            $this->redirect(array('action'=>'index'));
        }
    }
}
