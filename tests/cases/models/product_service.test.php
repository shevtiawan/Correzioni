<?php
/* ProductService Test cases generated on: 2010-12-29 13:12:10 : 1293604870*/
App::import('Model', 'ProductService');

class ProductServiceTestCase extends CakeTestCase {
	var $fixtures = array('app.product_service', 'app.product', 'app.product_info', 'app.product_gallery', 'app.category', 'app.products_category', 'app.service');

	function startTest() {
		$this->ProductService =& ClassRegistry::init('ProductService');
	}

	function endTest() {
		unset($this->ProductService);
		ClassRegistry::flush();
	}

}
?>