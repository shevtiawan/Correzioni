<?php
/* Setting Test cases generated on: 2010-12-23 06:12:43 : 1293062083*/
App::import('Model', 'Setting');

class SettingTestCase extends CakeTestCase {
	var $fixtures = array('app.setting');

	function startTest() {
		$this->Setting =& ClassRegistry::init('Setting');
	}

	function endTest() {
		unset($this->Setting);
		ClassRegistry::flush();
	}

}
?>