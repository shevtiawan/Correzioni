<?php
class PagesController extends AppController {

	var $name = 'Pages';

    var $layout = 'frontend';

    var $uses = array();

	function beforeFilter() {
	    parent::beforeFilter();
	    $this->Auth->allow('*');
	}

    function home() {
        //$brief = $this->Setting->getBrief();
        //$this->set('title_for_layout', $brief['Setting']['company_name']);
        $this->helpers[] = 'Info';

        $this->loadModel('Product');
        $this->set('latest', $this->Product->latest());
    }

    function ajax_recent() {
        $this->helpers[] = 'Info';
        $this->layout = 'ajax';

        $this->loadModel('Product');
        $this->set('latest', $this->Product->latest());
    }

    function ajax_picture() {
        $this->layout = 'ajax';
    }
}
