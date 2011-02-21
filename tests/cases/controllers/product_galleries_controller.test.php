<?php
/* ProductGalleries Test cases generated on: 2010-12-13 22:12:53 : 1292255993*/
App::import('Controller', 'ProductGalleries');

class TestProductGalleriesController extends ProductGalleriesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ProductGalleriesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.product_gallery', 'app.product', 'app.product_info', 'app.category', 'app.products_category');

	function startTest() {
		$this->ProductGalleries =& new TestProductGalleriesController();
		$this->ProductGalleries->constructClasses();
	}

	function endTest() {
		unset($this->ProductGalleries);
		ClassRegistry::flush();
	}

	function testIndex() {

	}

	function testView() {

	}

	function testAdd() {

	}

	function testEdit() {

	}

	function testDelete() {

	}

}
?>