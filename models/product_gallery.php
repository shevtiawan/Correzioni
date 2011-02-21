<?php
class ProductGallery extends AppModel {

	public $name = 'ProductGallery';

	public $belongsTo = array('Product');

	public function __construct($id = false, $table = null, $ds = null) {
	    $this->thumbsizes = array_merge(
            ClassRegistry::init('Setting')->imageOptions(),
            $this->thumbsizes
        );

        $this->actsAs = array(
            'Sequence.Sequence' => array(
                'order_field' => 'indexed_at',
                'group_fields' => 'product_id',
                'start_at' => 1
            ),
            'Upload.Upload' => array(
                'image' => array(
                    'fields' => array('dir' => 'image_dir'),
                    'maxSize' => 2097152,
                    'path' => 'webroot{DS}img{DS}galleries{DS}',
                    'thumbnailMethod' => 'php',
                    'thumbsizes' => $this->thumbsizes
                )
            )
        );
        parent::__construct($id, $table, $ds);

        $this->validate = array(
            'image' => array(
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
            'thumbnail_path' => "CONCAT('galleries{$DS}', ProductGallery.image_dir, '{$DS}thumbnail_', ProductGallery.image)",
            'medium_path' => "CONCAT('galleries{$DS}', ProductGallery.image_dir, '{$DS}medium_', ProductGallery.image)",
            'large_path' => "CONCAT('galleries{$DS}', ProductGallery.image_dir, '{$DS}large_', ProductGallery.image)",
        );
	}

	public function mainImage($product_id) {
        return $this->find('first', array(
            'conditions' => array(
                'OR' => array(
                    'is_featured' => true,
                    'indexed_at' => 1
                ),
                'product_id' => $product_id
            )
        ));
	}

	public function move_up($id) {
	    // temporarily disable Upload
	    $this->Behaviors->detach('Upload');
        $fields = array('id', 'product_id', 'indexed_at');
        $current_row = $this->read($fields, $id);

        if ($current_row) {
            $higher_index = $current_row[$this->alias]['indexed_at'] + 1;
            $conditions = array('indexed_at' => $higher_index);
            if (!empty($current_row[$this->alias]['product_id'])) {
                $conditions['product_id'] = $current_row[$this->alias]['product_id'];
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
        $fields = array('id', 'product_id', 'indexed_at');
        $current_row = $this->read($fields, $id);

        if ($current_row) {
            $lower_index = $current_row[$this->alias]['indexed_at'] - 1;
            $conditions = array('indexed_at' => $lower_index);
            if (!empty($current_row[$this->alias]['product_id'])) {
                $conditions['product_id'] = $current_row[$this->alias]['product_id'];
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
