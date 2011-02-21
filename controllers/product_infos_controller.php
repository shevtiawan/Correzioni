<?php
class ProductInfosController extends AppController {

	var $name = 'ProductInfos';

    var $layout = 'admin';

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid product info', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('productInfo', $this->ProductInfo->read(null, $id));
	}

	// add and edit combined
	function admin_office($product_id = null) {
	    if (!$product_id) {
	        $this->Session->setFlash(__('Invalid product', true));
	        $this->redirect(array(
	            'controller' => 'products',
	            'action' => 'index'
	        ));
        }

        if (!empty($this->data)) {
            $this->ProductInfo->create();
            if ($this->ProductInfo->save($this->data)) {
                $this->Session->setFlash(__('Product info has been saved', true));
	            $this->redirect(array(
	                'controller' => 'product_infos',
	                'action' => 'office',
	                'product_id' => $product_id
	            ));
            }
        } else {
            $this->data = $this->ProductInfo->find('first', array(
                'conditions' => compact('product_id')
            ));
        }

	    $product = $this->ProductInfo->Product->read(array('id', 'title'), $product_id);
	    if (!$product) {
	        $this->Session->setFlash(__('Invalid product', true));
	        $this->redirect(array(
	            'controller' => 'products',
	            'action' => 'index'
	        ));
        }
        $paths = $this->ProductInfo->Product->getPath($product_id, array('id', 'parent_id', 'title'), -1);
		$isOffice = "active";
        $isDetail = $isGallery = $isTabs = $isRatings = $isServices = "";
        $this->set(compact(
            'isDetail', 'isOffice', 'isGallery', 'isTabs', 'isRatings', 'isServices',
            'product', 'product_id',
            'paths'
        ));
	}
}
