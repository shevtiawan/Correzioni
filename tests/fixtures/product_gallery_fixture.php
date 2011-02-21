<?php
/* ProductGallery Fixture generated on: 2010-12-13 22:12:14 : 1292255954 */
class ProductGalleryFixture extends CakeTestFixture {
	var $name = 'ProductGallery';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'thumbnail_path' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'normal_path' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'big_path' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'caption' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexed_at' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'is_featured' => array('type' => 'boolean', 'null' => true, 'default' => NULL),
		'created_at' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'updated_at' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'product_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'thumbnail_path' => 'Lorem ipsum dolor sit amet',
			'normal_path' => 'Lorem ipsum dolor sit amet',
			'big_path' => 'Lorem ipsum dolor sit amet',
			'caption' => 'Lorem ipsum dolor sit amet',
			'indexed_at' => 1,
			'is_featured' => 1,
			'created_at' => '2010-12-13 22:59:14',
			'updated_at' => '2010-12-13 22:59:14',
			'product_id' => 1
		),
	);
}
?>