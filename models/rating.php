<?php
class Rating extends AppModel {

    public $name = 'Rating';

    public $belongsTo = array(
        'ParentRating' => array(
            'className' => 'Rating',
            'foreignKey' => 'parent_id'
        )
    );

    public $hasMany = array(
        'ChildRating' => array(
            'className' => 'Rating',
            'foreignKey' => 'parent_id',
            'dependent' => false,
        ),
        'ProductRating' => array(
            'className' => 'ProductRating',
            'foreignKey' => 'rating_id',
            'dependent' => true,
        )
    );

    public function __construct($id = false, $table = null, $ds = null) {

        $this->actsAs = array(
            'Tree',
            'Upload.Upload' => array(
                'icon_path' => array(
                    'fields' => array('dir' => 'icon_dir'),
                    'maxSize' => 2097152,
                    'path' => 'webroot{DS}img{DS}ratings{DS}',
                    'thumbnailMethod' => 'php'
                )
            )
        );

        parent::__construct($id, $table, $ds);

        $this->validate = array(
            'title' => array(
                'rule' => 'notEmpty',
                'message' => __('Title cannot be left blank', true)
            ),
            'icon_path' => array(
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
            'num_children' => 'CAST((Rating.rght - Rating.lft -1) / 2 AS UNSIGNED)',
            'image_path' => "CONCAT('ratings{$DS}', Rating.icon_dir, '{$DS}', Rating.icon_path)"
        );
    }

    public function beforeSave() {
        if (empty($this->data['Rating']['parent_id'])) {
            unset($this->data['Rating']['parent_id']);
        }
        return true;
    }
}
