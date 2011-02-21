<?php
/* ProductService Fixture generated on: 2010-12-29 13:12:09 : 1293604869 */
class ProductServiceFixture extends CakeTestFixture {
	var $name = 'ProductService';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'product_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'service_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexed_at' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'product_id' => 1,
			'service_id' => 1,
			'created' => '2010-12-29 13:41:09',
			'modified' => '2010-12-29 13:41:09',
			'indexed_at' => 1
		),
	);
}
?>