<?php
/* Setting Fixture generated on: 2010-12-23 06:12:43 : 1293062083 */
class SettingFixture extends CakeTestFixture {
	var $name = 'Setting';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'image_thumbnail_size' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'image_medium_size' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'image_large_size' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'about_us' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'terms_of_conditions' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'contact_us' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'company_name' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'smtp_username' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'smtp_address' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'smtp_password' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'smtp_port' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'created_at' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'updated_at' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'image_thumbnail_size' => 'Lorem ipsum dolor sit amet',
			'image_medium_size' => 'Lorem ipsum dolor sit amet',
			'image_large_size' => 'Lorem ipsum dolor sit amet',
			'about_us' => 'Lorem ipsum dolor sit amet',
			'terms_of_conditions' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'contact_us' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'company_name' => 'Lorem ipsum dolor sit amet',
			'smtp_username' => 'Lorem ipsum dolor sit amet',
			'smtp_address' => 'Lorem ipsum dolor sit amet',
			'smtp_password' => 'Lorem ipsum dolor sit amet',
			'smtp_port' => 1,
			'created_at' => '2010-12-23 06:54:43',
			'updated_at' => '2010-12-23 06:54:43'
		),
	);
}
?>