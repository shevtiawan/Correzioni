<?php
class Service extends AppModel {

	public $name = 'Service';

    public $hasMany = array(
        'ProductService' => array(
            'className' => 'ProductService',
            'foreignKey' => 'service_id',
            'dependent' => true
        )
    );

	/**
	 * Override constructor to have i18n in model validation errors
     */
	public function __construct($id = false, $table = null, $ds = null) {
	    $this->actsAs = array(
	        'Upload.Upload' => array(
                'icon' => array(
                    'fields' => array('dir' => 'icon_dir'),
                    'maxSize' => 2097152,
                    'path' => 'webroot{DS}img{DS}services{DS}',
                    'thumbnailMethod' => 'php',
                )
            )
	    );

        parent::__construct($id, $table, $ds);

        $this->validate = array(
            'title' => array(
                'rule' => 'notEmpty',
                'message' => __('Title cannot be left blank', true)
            ),
            'icon' => array(
		        'phpSize' => array(
		            'rule' => 'isUnderPhpSizeLimit',
		            'message' => __('File exceeds upload filesize limit', true)
		        ),
		        'maxSize' => array(
		            'rule' => 'isBelowMaxSize',
		            'message' => __('File is larger than the maximum filesize', true)
		        )
	        )
        );

        $DS = DS;
        $this->virtualFields = array(
            'image_path' => "CONCAT('services{$DS}', Service.icon_dir, '{$DS}', Service.icon)"
        );
    }
}
