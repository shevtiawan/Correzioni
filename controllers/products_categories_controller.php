<?php
class ProductsCategoriesController extends AppController {

	var $name = 'ProductsCategories';

	function index() {
		$this->ProductsCategory->recursive = 0;
		$this->set('productsCategories', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid products category', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('productsCategory', $this->ProductsCategory->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->ProductsCategory->create();
			if ($this->ProductsCategory->save($this->data)) {
				$this->Session->setFlash(__('The products category has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The products category could not be saved. Please, try again.', true));
			}
		}
		$products = $this->ProductsCategory->Product->find('list');
		$categories = $this->ProductsCategory->Category->find('list');
		$this->set(compact('products', 'categories'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid products category', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->ProductsCategory->save($this->data)) {
				$this->Session->setFlash(__('The products category has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The products category could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ProductsCategory->read(null, $id);
		}
		$products = $this->ProductsCategory->Product->find('list');
		$categories = $this->ProductsCategory->Category->find('list');
		$this->set(compact('products', 'categories'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for products category', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ProductsCategory->delete($id)) {
			$this->Session->setFlash(__('Products category deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Products category was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>