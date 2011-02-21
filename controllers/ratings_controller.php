<?php
class RatingsController extends AppController {

    public $name = 'Ratings';

    public $layout = 'admin';

    public function admin_index() {
        $this->paginate = array(
            'order' => array('Rating.lft' => 'ASC'),
            'conditions' => array('Rating.parent_id' => null),
        );
        $this->set('ratings', $this->paginate());
    }

    public function admin_subs($parent_id = null) {
        $this->paginate = array(
            'order' => array('Rating.lft' => 'ASC'),
            'conditions' => array('Rating.parent_id' => $parent_id),
        );
        $this->set(array(
            'ratings' => $this->paginate(),
            'paths' => $this->Rating->getPath($parent_id, array('id', 'parent_id', 'title'), -1)
        ));
        if ($parent_id) $this->set('parent_id', $parent_id);
    }

    public function admin_add($parent_id = null) {
        if (!empty($this->data)) {
            $this->Rating->create();
            if ($this->Rating->save($this->data)) {
                $redirection = array('action' => 'index');
                if (!empty($this->data['Rating']['parent_id'])) {
                    $redirection = array(
                        'action' => 'subs',
                        'parent_id' => $this->data['Rating']['parent_id']
                    );
                }
                $this->Session->setFlash(__('The rating has been saved', true));
                $this->redirect($redirection);
            } else {
                $this->Session->setFlash(__('The rating could not be saved. Please, try again.', true));
            }
        }
        $this->set('parents', $this->Rating->generatetreelist(null, null, null, ' - '));
        if ($parent_id) $this->set('parent_id', $parent_id);
    }

    function admin_edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid rating', true));
            $this->redirect(array('action' => 'index'));
        }

        if (!empty($this->data)) {
            if ($this->Rating->save($this->data)) {
                $redirection = array('action' => 'index');
                if (!empty($this->data['Rating']['parent_id'])) {
                    $redirection = array(
                        'action' => 'subs',
                        'parent_id' => $this->data['Rating']['parent_id']
                    );
                }
                $this->Session->setFlash(__('The rating has been saved', true));
                $this->redirect($redirection);
            } else {
                $this->Session->setFlash(__('The rating could not be saved. Please, try again.', true));
            }
        }

        if (empty($this->data)) {
            $this->data = $this->Rating->find('first', array(
                'conditions' => compact('id')
            ));
            if (!empty($this->data['Rating']['id'])) {
                $this->set("parent_id", $this->data['Rating']['parent_id']);
            }
        }
        $this->set('parents', $this->Rating->generatetreelist(null, null, null, ' - '));
    }

    function admin_delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for rating', true));
            $this->redirect(array('action'=>'index'));
        }
        if (!empty($this->data)) {
            $redirection = array('action' => 'index');
            if (!empty($this->data['Rating']['parent_id'])) {
                $redirection = array(
                    'action' => 'subs',
                    'parent_id' => $this->data['Rating']['parent_id']
                );
            }
            if ($this->Rating->delete($id)) {
                $this->Session->setFlash(__('Rating deleted', true));
                $this->redirect($redirection);
            }
            $this->Session->setFlash(__('Rating was not deleted', true));
            $this->redirect($redirection);
        } else {
            $this->data = $this->Rating->read(array('id', 'title', 'parent_id'), $id);
        }
        if (empty($this->data['Rating'])) {
            $this->Session->setFlash(__('Invalid id for rating', true));
            $this->redirect(array('action'=>'index'));
        }
    }
}
