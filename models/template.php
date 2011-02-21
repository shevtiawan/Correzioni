<?php

App::import('Core', array('File', 'Folder'));

class Template extends AppModel {

    public $name = 'Template';

    private $__theme = null;

    public $actsAs = array(
        'Upload.Upload' => array(
            'package' => array(
                'fields' => array('dir' => 'package_dir'),
                'maxSize' => 2097152,
                'mimetypes' => array(
                    'application/zip',
                    'application/x-zip-compressed',
                    'multipart/x-zip',
                    'application/s-compressed'
                ),
                'path' => 'webroot{DS}upload{DS}templates{DS}',
                'pathMethod' => 'flat'
            )
        )
    );

    function __construct($id = false, $table = null, $ds = null) {
        parent::__construct($id, $table, $ds);
        $this->validate = array(
            'name' => array(
		        'isUnique' => array(
		            'rule' => 'isUnique',
		            'message' => __('This theme has been taken', true)
		        )
            ),
            'package' => array(
		        'phpSize' => array(
		            'rule' => 'isUnderPhpSizeLimit',
		            'message' => __('File exceeds upload filesize limit', true)
		        ),
		        'maxSize' => array(
		            'rule' => 'isBelowMaxSize',
		            'message' => __('File is larger than the maximum filesize', true)
		        ),
		        'validMimeType' => array(
		            'rule' => 'isValidMimeType',
		            'message' => __('Only zip files are allowed', true)
		        )
            )
        );
    }

    public function afterSave($created) {
        if ($created) {
            $zipFile = $this->zippedThemePath($this->data[$this->alias]['package']);
            $this->extractZip($zipFile);
        }
        // disabled other themes
        if (!empty($this->data[$this->alias]['is_activated'])) {
            // @TODO: use single query
            $otherThemeIds = Set::extract(
                '/Template/id',
                $this->find('all', array(
                    'conditions' => array('id <>' => $this->id)
                ))
            );
            if ($otherThemeIds) {
                $this->updateAll(
                    array('Template.is_activated' => 0),
                    array('Template.id' => $otherThemeIds)
                );
            }
        }
    }

    public function beforeDelete($cascade = true) {
        $this->__theme = $this->field('name', array('id' => $this->id));
        return true;
    }

    public function afterDelete() {
        // remove theme folder
        $themeFolder = VIEWS . 'themed' . DS . $this->__theme;
        $Folder = new Folder();
        $Folder->delete($themeFolder);
    }

    /**
     * Get name of active theme
     *
     * @param none
     * @return string Theme name
     */
    public function getActiveTheme() {
        return $this->field('name', array('is_activated' => true));
    }

    /**
     * Get fullpath to zip file contains theme files/folders
     *
     * @param string $zipFile Zip filename
     * @return string Fullpath to zip file
     */
    public function zippedThemePath($zipFile = null) {
        if (!$this->Behaviors->attached('Upload')) return false;
        return APP . $this->Behaviors->Upload->settings['Template']['package']['path'] . $zipFile;
    }

    /**
     * Extract a zipped theme into a directory
     *
     * @param string Fullpath to existing zip file
     * @return void
     */
    public function extractZip($zipFile) {
        $extractTo = VIEWS . 'themed' . DS;
        $zip = zip_open($zipFile);

        if (is_resource($zip)) {
            $Folder = new Folder();

            while ($zip_entry = zip_read($zip)) {
                $zipEntryName = zip_entry_name($zip_entry);
                $path = $extractTo . $zipEntryName;

                // if entry has a trailing slash, consider that one as a directory
                if (substr($path, strlen($path) - 1) == DS) {
                    $Folder->create($path, 0777);
                } else {
                    // create file
                    if (zip_entry_open($zip, $zip_entry, 'r')) {
                        $data = zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
                        $File = new File($path);
                        $File->write($data);
                        $File->close();
                        zip_entry_close($zip_entry);
                    }
                }
            }
            zip_close($zip);
        }
    }
}
