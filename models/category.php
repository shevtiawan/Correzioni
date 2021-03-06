<?php
class Category extends AppModel {

    public $name = 'Category';

#    public $belongsTo = array(
#  	    'CategoryParent' => array(
#  		    'className' => 'Category',
#  		    'foreignKey' => 'parent_id'
#  	    )
#    );

    public $hasAndBelongsToMany = array(
        'Product' => array(
            'className' => 'Product',
            'joinTable' => 'products_categories',
            'foreignKey' => 'category_id',
            'associationForeignKey' => 'product_id',
            'unique' => true
        )
    );

    public function __construct($id = false, $table = null, $ds = null) {

        $this->actsAs = array(
            'NamedScope.NamedScope' => array(
                'mainmenu' => array(
                    'conditions' => array('parent_id' => null, 'is_published' => true),
                    'fields' => array('title', 'slug', 'color', 'id'),
                    'order' => 'Category.indexed_at'
                )
            ),

            'Sequence.Sequence' => array(
                'order_field' => 'indexed_at',
                'group_fields' => 'parent_id',
                'start_at' => 1
            ),

            'Sluggable' => array(
                'separator' => '-',
                'update' => true
            ),

            'Tree',

            'Upload.Upload' => array(
                'icon_path' => array(
                    'fields' => array('dir' => 'icon_dir'),
                    'maxSize' => 2097152,
                    'path' => 'webroot{DS}img{DS}categories{DS}',
                    'thumbnailMethod' => 'php',
                    'thumbsizes' => $this->thumbsizes
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
            'num_children' => 'CAST((Category.rght - Category.lft -1) / 2 AS UNSIGNED)',
            'image_path' => "CONCAT('categories{$DS}', Category.icon_dir, '{$DS}', Category.icon_path)"
        );
    }

    public function beforeSave(){
        if (empty($this->data[$this->alias]['parent_id'])) {
            unset($this->data[$this->alias]['parent_id']);
            // adding
            if (empty($this->data[$this->alias][$this->primaryKey])) {
                $last = $this->find('first', array(
                    'fields' => array('MAX(indexed_at) AS max_index')
                ));
                if (!empty($last[0]['max_index'])) {
                    $this->data[$this->alias]['indexed_at'] = $last[0]['max_index'] + 1;
                }
            }
        }
        return true;
    }

    public function move_up($id) {
        // temporarily disable Upload
	    $this->Behaviors->detach('Upload');
        $fields = array('id', 'parent_id', 'indexed_at');
        $current_row = $this->read($fields, $id);

        if ($current_row) {
            $higher_index = $current_row[$this->alias]['indexed_at'] + 1;
            $conditions = array('indexed_at' => $higher_index);
            if (!empty($current_row[$this->alias]['parent_id'])) {
                $conditions['parent_id'] = $current_row[$this->alias]['parent_id'];
            }

            $next_row = $this->find('first', compact('conditions', 'fields'));
            if ($next_row) {
                // swap the indexed_at
                $next_row[$this->alias]['indexed_at'] = $current_row[$this->alias]['indexed_at'];
                $current_row[$this->alias]['indexed_at'] = $higher_index;

                // update current_row
                $this->id = $current_row[$this->alias]['id'];
                if ($this->saveField('indexed_at', $current_row[$this->alias]['indexed_at'])) {
                    // update next_row
                    $this->id = $next_row[$this->alias]['id'];
                    return $this->saveField('indexed_at', $next_row[$this->alias]['indexed_at']);
                }
            }
        }
        return false;
    }

    public function move_down($id) {
        // temporarily disable Upload
	    $this->Behaviors->detach('Upload');
        $fields = array('id', 'parent_id', 'indexed_at');
        $current_row = $this->read($fields, $id);

        if ($current_row) {
            $lower_index = $current_row[$this->alias]['indexed_at'] - 1;
            $conditions = array('indexed_at' => $lower_index);
            if (!empty($current_row[$this->alias]['parent_id'])) {
                $conditions['parent_id'] = $current_row[$this->alias]['parent_id'];
            }

            $prev_row = $this->find('first', compact('conditions', 'fields'));
            if ($prev_row) {
                // swap the indexed_at
                $prev_row[$this->alias]['indexed_at'] = $current_row[$this->alias]['indexed_at'];
                $current_row[$this->alias]['indexed_at'] = $lower_index;

                // update current_row
                $this->id = $current_row[$this->alias]['id'];
                if ($this->saveField('indexed_at', $current_row[$this->alias]['indexed_at'])) {
                    // update next_row
                    $this->id = $prev_row[$this->alias]['id'];
                    return $this->saveField('indexed_at', $prev_row[$this->alias]['indexed_at']);
                }
            }
        }
        return false;
    }
}
