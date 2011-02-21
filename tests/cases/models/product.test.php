<?php
/* Product Test cases generated on: 2010-12-10 05:12:18 : 1291935558*/
App::import('Model', 'Product');

class ProductTestCase extends CakeTestCase {
	var $fixtures = array('app.product', 'app.product_info', 'app.category', 'app.products_category');

	function startTest() {
		$this->Product =& ClassRegistry::init('Product');
	}

	function endTest() {
		unset($this->Product);
		ClassRegistry::flush();
	}

}
?>