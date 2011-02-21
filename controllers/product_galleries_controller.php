<?php
class ProductGalleriesController extends AppController {

	var $name = 'ProductGalleries';

    var $layout = 'admin';

    function beforeRender() {
        parent::beforeRender();
        $isDetail = $isOffice = $isTabs = $isRatings = $isServices = "";
        $isGallery = "active";
        $this->set(compact(
            'isDetail', 'isOffice', 'isGallery', 'isTabs', 'isRatings', 'isServices'
        ));
    }

	function admin_index($product_id = null) {
        $this->paginate = array(
            'order' => 'ProductGallery.indexed_at DESC',
            'conditions' => array('ProductGallery.product_id' => $product_id)
        );
        $product = $this->ProductGallery->Product->findById($product_id);
        $productGalleries = $this->paginate();
        $paths = $this->ProductGallery->Product->getPath($product_id, array('id', 'parent_id', 'title'), -1);
        $this->set(compact(
            'product', 'productGalleries', 'product_id', 'paths'
        ));
	}

	function admin_add($product_id = null) {
	    if (!$product_id) {
	        $this->Session->setFlash(__('Invalid product', true));
			$this->redirect(array(
			    'controller' => 'products',
			    'action' => 'index'
			));
	    }
		if (!empty($this->data)) {
			$this->ProductGallery->create();
			if ($this->ProductGallery->save($this->data)) {
				$this->Session->setFlash(__('The product gallery has been saved', true));
				$this->redirect(array(
				    'action' => 'index',
				    'product_id' => $this->data['ProductGallery']['product_id']
				));
			} else {
				$this->Session->setFlash(__('The product gallery could not be saved', true));
			}
		}

		$product = $this->ProductGallery->Product->read(array('id', 'title'), $product_id);
		if (!$product) {
	        $this->Session->setFlash(__('Invalid product', true));
			$this->redirect(array(
			    'controller' => 'products',
			    'action' => 'index'
			));
	    }
	    $paths = $this->ProductGallery->Product->getPath($product_id, array('id', 'parent_id', 'title'), -1);
		$this->set(compact('product_id', 'product','paths'));
	}

	function admin_edit($product_id = null, $id = null) {
		if (!$product_id || !$id) {
			$this->Session->setFlash(__('Invalid product gallery', true));
			$this->redirect(array('controller' => 'products', 'action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->ProductGallery->save($this->data)) {
				$this->Session->setFlash(__('The product gallery has been saved', true));
				$this->redirect(array(
				    'action' => 'index',
				    'product_id' => $this->data['ProductGallery']['product_id']
				));
			} else {
				$this->Session->setFlash(__('The product gallery could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ProductGallery->read(null, $id);
		}

		$product = $this->ProductGallery->Product->read(array('id', 'title'), $product_id);
		if (!$product || empty($this->data['ProductGallery'])) {
	        $this->Session->setFlash(__('Invalid product', true));
			$this->redirect(array(
			    'controller' => 'products',
			    'action' => 'index'
			));
	    }
	    $paths = $this->ProductGallery->Product->getPath($product_id, array('id', 'parent_id', 'title'), -1);
		$this->set(compact('product_id', 'product','paths'));
	}

	function admin_delete($product_id = null, $id = null) {
		if (!$product_id || !$id) {
			$this->Session->setFlash(__('Invalid id for product gallery', true));
			$this->redirect(array(
			    'controller' => 'products',
			    'action' => 'index'
            ));
		}
		if (!empty($this->data)) {
		    if ($this->ProductGallery->delete($id)) {
			    $this->Session->setFlash(__('Product gallery deleted', true));
			    $this->redirect(array(
				    'action' => 'index',
				    'product_id' => $product_id
				));
		    } else {
		        $this->Session->setFlash(__('The product gallery could not be deleted. Please, try again.', true));
		    }
        }
        if (empty($this->data)) {
			$this->data = $this->ProductGallery->read(null, $id);
		}

		$product = $this->ProductGallery->Product->read(array('id', 'title'), $product_id);
		if (!$product || empty($this->data['ProductGallery'])) {
	        $this->Session->setFlash(__('Invalid product', true));
			$this->redirect(array(
			    'controller' => 'products',
			    'action' => 'index'
			));
	    }
	    $paths = $this->ProductGallery->Product->getPath($product_id, array('id', 'parent_id', 'title'), -1);
		$this->set(compact('product_id', 'product','paths'));
	}

	function admin_move_up($product_id = null, $id = null) {
        if (!$product_id || !$id) {
	        $this->Session->setFlash(sprintf(__('Invalid category', true)));
            $this->redirect(array(
                'controller' => 'products',
                'action' => 'index'
            ));
        }

        if ($this->ProductGallery->move_up($id)) {
	        $this->Session->setFlash(sprintf(__('The %s has been saved', true), 'product gallery'));
        } else {
			$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'product gallery'));
		}
		$this->redirect(array(
            'action' => 'index',
            'product_id' => $product_id
        ));
	}

	function admin_move_down($product_id = null, $id = null) {
        if (!$product_id || !$id) {
	        $this->Session->setFlash(sprintf(__('Invalid category', true)));
            $this->redirect(array(
                'controller' => 'products',
                'action' => 'index'
            ));
        }

        if ($this->ProductGallery->move_down($id)) {
	        $this->Session->setFlash(sprintf(__('The %s has been saved', true), 'product gallery'));
        } else {
			$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'product gallery'));
		}
		$this->redirect(array(
            'action' => 'index',
            'product_id' => $product_id
        ));
	}
}
