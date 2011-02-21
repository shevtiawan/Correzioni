<?php
class Setting extends AppModel {
	var $name = 'Setting';

    /**
	 * Override constructor to have i18n in model validation errors
     */
	function __construct($id = false, $table = null, $ds = null) {
        parent::__construct($id, $table, $ds);

        $this->validate = array(
            'company_name' => array('rule' => 'notEmpty'),
            'smtp_port' => array(
                'rule' => 'numeric',
                'allowEmpty' => true
            ),
            'image_thumbnail_size' => array(
                'rule' => '/^[1-9][0-9]{0,}x[1-9][0-9]{0,}$/',
                'message' => __('Invalid size', true),
                'allowEmpty' => true
            ),
            'image_medium_size' => array(
                'rule' => '/^[1-9][0-9]{0,}x[1-9][0-9]{0,}$/',
                'message' => __('Invalid size', true),
                'allowEmpty' => true
            ),
            'image_large_size' => array(
                'rule' => '/^[1-9][0-9]{0,}x[1-9][0-9]{0,}$/',
                'message' => __('Invalid size', true),
                'allowEmpty' => true
            ),
        );
	}

    function getBrief() {
        return $this->find('first', array(
          'fields' => array('company_name')
        ));
    }

    function smtpOptions() {
        $smtp_setting = $this->find('first', array(
            'fields' => array(
                "`smtp_username` AS `username`",
                "`smtp_password` AS `password`",
                "`smtp_port` AS `port`",
                "`smtp_address` AS `host`",
            )
        ));
        if (!empty($smtp_setting)) return $smtp_setting[$this->alias];
        return array();
    }

    function afterSave($created) {
        Cache::delete('imageOptions');
    }

    function afterDelete() {
        Cache::delete('imageOptions');
    }

    function imageOptions() {
        $imageOptions = Cache::read('imageOptions');
        if ($imageOptions === false) {
            $options = $this->find('first', array(
                'fields' => array(
                    "`image_thumbnail_size` AS `thumbnail`",
                    "`image_medium_size` AS `medium`",
                    "`image_large_size` AS `large`"
                )
            ));
            if ($options) {
                $imageOptions = Set::filter($options[$this->alias]);
                Cache::write('imageOptions', $imageOptions);
            } else {
                $imageOptions = array();
            }
        }
        return $imageOptions;
    }
}
