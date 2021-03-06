<?php
class ProductServicesController extends AppController {

	var $name = 'ProductServices';

	var $layout = 'admin';

	function beforeRender() {
	    parent::beforeRender();
	    $isDetail = $isOffice = $isGallery = $isTabs = $isRatings = "";
        $isServices = "active";
        $this->set(compact(
            'isDetail', 'isOffice', 'isGallery', 'isTabs',
            'isRatings', 'isServices'
        ));
	}

	function admin_index($product_id = null) {
	    $product = $this->ProductService->Product->find('first', array(
	        'conditions' => array('Product.id' => $product_id)
	    ));
	    if (!$product) {
	        $this->Session->setFlash(sprintf(__('Invalid product', true)));
            $this->redirect(array(
                'controller' => 'products', 'action' => 'index', 'admin' => true
            ));
        }
        $this->paginate = array(
            'conditions' => compact('product_id'),
            'contain' => array('Service' => array('fields' => array('title', 'icon', 'image_path'))),
            'order' => 'ProductService.indexed_at DESC'
        );
        $paths = $this->ProductService->Product->getPath($product_id, array('id', 'parent_id', 'title'), -1);
		$this->set('productServices', $this->paginate());
        $this->set(compact('product', 'product_id','paths'));
	}

	function admin_add($product_id = null) {
		if (!$product_id) {
	        $this->Session->setFlash(sprintf(__('Invalid product', true)));
            $this->redirect(array(
                'controller' => 'products', 'action' => 'index', 'admin' => true
            ));
        }

		if (!empty($this->data)) {
		    $saved = false;
		    $service_ids = $this->data['ProductService']['service_id'];
		    // rating not selected?
		    if (!$service_ids) {
		        $this->data['ProductService']['service_id'] = null;
		        $this->ProductService->create();
		        $saved = $this->ProductService->save($this->data);
	        } else {
	            foreach ($service_ids as $this->data['ProductService']['service_id']) {
		            $this->ProductService->create();
		            $saved = $this->ProductService->save($this->data);
                }
	        }
            if ($saved) {
                $this->Session->setFlash(sprintf(__('The %s has been saved', true), 'product service'));
		        $this->redirect(array(
		            'controller' => 'product_services',
		            'action' => 'index',
		            'admin' => true,
		            'product_id' => $product_id
                ));
	        } else {
		        $this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'product service'));
	        }
		}

		$product = $this->ProductService->Product->find('first', array(
		    'conditions' => array('Product.id' => $product_id)
		));
		if (!$product) {
	        $this->Session->setFlash(sprintf(__('Invalid product', true)));
            $this->redirect(array(
                'controller' => 'products', 'action' => 'index', 'admin' => true
            ));
        }
        if (empty($this->data['ProductService']['service_id'])) {
            $this->data['ProductService']['service_id'] = $this->ProductService->availableService($product_id);
        }
        $paths = $this->ProductService->Product->getPath($product_id, array('id', 'parent_id', 'title'), -1);
		$this->set(compact('product', 'product_id','paths'));
	}

	function admin_delete($product_id = null, $id = null) {
		if (!$product_id || !$id) {
			$this->Session->setFlash(__('Invalid product', true));
			$this->redirect(array(
			    'controller' => 'products',
			    'action' => 'index'
            ));
		}
		if (!empty($this->data)) {
		    if ($this->ProductService->delete($id)) {
			    $this->Session->setFlash(__('Product service deleted', true));
			    $this->redirect(array(
				    'action' => 'index',
				    'product_id' => $product_id
				));
		    } else {
		        $this->Session->setFlash(__('The product service could not be deleted. Please, try again.', true));
		    }
        }
        else {
			$this->data = $this->ProductService->find('first', array(
			    'conditions' => array('ProductService.id' => $id),
			    'contain' => array('Service.title')
			));
		}

		$product = $this->ProductService->Product->read(array('id', 'title'), $product_id);
		if (!$product || empty($this->data['ProductService'])) {
	        $this->Session->setFlash(__('Invalid product', true));
			$this->redirect(array(
			    'controller' => 'products',
			    'action' => 'index'
			));
	    }
	    $paths = $this->ProductService->Product->getPath($product_id, array('id', 'parent_id', 'title'), -1);
		$this->set(compact('product_id', 'product','paths'));
	}

	function admin_move_up($product_id = null, $id = null) {
	    if (!$product_id || !$id) {
	        $this->Session->setFlash(sprintf(__('Invalid product', true)));
            $this->redirect(array(
                'controller' => 'products', 'action' => 'index', 'admin' => true
            ));
        }
	    if ($this->ProductService->move_up($id)) {
	        $this->Session->setFlash(sprintf(__('The %s has been saved', true), 'product service'));
        } else {
			$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'product service'));
		}

        $this->redirect(array(
		    'action' => 'index',
		    'product_id' => $product_id
	    ));
	}

	function admin_move_down($product_id = null, $id = null) {
	    if (!$product_id || !$id) {
	        $this->Session->setFlash(sprintf(__('Invalid product', true)));
            $this->redirect(array(
                'controller' => 'products', 'action' => 'index', 'admin' => true
            ));
        }
	    if ($this->ProductService->move_down($id)) {
	        $this->Session->setFlash(sprintf(__('The %s has been saved', true), 'product service'));
        } else {
			$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'product service'));
		}

        $this->redirect(array(
		    'action' => 'index',
		    'product_id' => $product_id
	    ));
	}
}
