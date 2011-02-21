<?php
/* Service Test cases generated on: 2010-12-23 09:12:12 : 1293070032*/
App::import('Model', 'Service');

class ServiceTestCase extends CakeTestCase {
	var $fixtures = array('app.service', 'app.product', 'app.product_info', 'app.category', 'app.products_category', 'app.products_service');

	function startTest() {
		$this->Service =& ClassRegistry::init('Service');
	}

	function endTest() {
		unset($this->Service);
		ClassRegistry::flush();
	}

}
?>