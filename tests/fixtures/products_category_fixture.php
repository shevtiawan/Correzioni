<?php
/* ProductsCategory Fixture generated on: 2010-12-09 13:12:22 : 1291876822 */
class ProductsCategoryFixture extends CakeTestFixture {
	var $name = 'ProductsCategory';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'product_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'category_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'created_at' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'updated_at' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'product_id' => 1,
			'category_id' => 1,
			'created_at' => '2010-12-09 13:40:22',
			'updated_at' => '2010-12-09 13:40:22'
		),
	);
}
?>