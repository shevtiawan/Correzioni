<?php
class ProductInfo extends AppModel {
	public $name = 'ProductInfo';

	public $belongsTo = array('Product');

	public function __construct($id = false, $table = null, $ds = null) {
	    $imageThumbsizes = ClassRegistry::init('Setting')->imageOptions();

        $this->actsAs = array(
            'Upload.Upload' => array(
                'logo' => array(
                    'fields' => array('dir' => 'logo_dir'),
                    'maxSize' => 2097152,
                    'path' => 'webroot{DS}img{DS}infos{DS}',
                    'thumbnailMethod' => 'php',
                    'thumbsizes' => array_merge($this->thumbsizes, $imageThumbsizes)
                )
            )
        );

        parent::__construct($id, $table, $ds);

        $DS = DS;
        $this->virtualFields = array(
            'thumbnail_path' => "CONCAT('infos{$DS}', ProductInfo.logo_dir, '{$DS}thumbnail_', ProductInfo.logo)",
            'medium_path' => "CONCAT('infos{$DS}', ProductInfo.logo_dir, '{$DS}medium_', ProductInfo.logo)",
            'large_path' => "CONCAT('infos{$DS}', ProductInfo.logo_dir, '{$DS}large_', ProductInfo.logo)",
	    );
	}
}
