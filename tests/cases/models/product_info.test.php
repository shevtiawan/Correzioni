<?php
/* ProductInfo Test cases generated on: 2010-12-10 05:12:35 : 1291935575*/
App::import('Model', 'ProductInfo');

class ProductInfoTestCase extends CakeTestCase {
	var $fixtures = array('app.product_info', 'app.product', 'app.category', 'app.products_category');

	function startTest() {
		$this->ProductInfo =& ClassRegistry::init('ProductInfo');
	}

	function endTest() {
		unset($this->ProductInfo);
		ClassRegistry::flush();
	}

}
?>