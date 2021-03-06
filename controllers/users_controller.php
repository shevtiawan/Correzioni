<?php
class UsersController extends AppController {

	var $name = 'Users';
    var $layout = 'admin';
    var $components = array('Email');

	function beforeFilter() {
	    parent::beforeFilter();
	    $this->Auth->allow('login', 'logout', 'admin_dashboard');
	}

	function admin_dashboard() {
	    if (!$this->Auth->user()) {
	        $this->redirect($this->Auth->loginAction);
        }
        $this->redirect($this->Auth->loginRedirect);
	}

	function admin_index() {
		//$this->User->recursive = 0;
		$this->paginate = array(
		    'contain' => array('Group')
		);
		$this->set('users', $this->paginate());
	}

#	function admin_view($id = null) {
#		if (!$id) {
#			$this->Session->setFlash(__('Invalid user', true));
#			$this->redirect(array('action' => 'index'));
#		}
#		$this->set('user', $this->User->read(null, $id));
#	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->User->create();
            if ($this->User->register($this->data)) {
			    $this->Session->setFlash(__('The user has been saved', true));
			    $this->redirect(array('action' => 'index'));
		    } else {
		        $this->data['User']['new_password'] = null;
		        $this->data['User']['confirm_password'] = null;
                if (!empty($this->User->validationErrors['password'])) {
                    $this->User->invalidate('new_password', $this->User->validationErrors['password']);
                }
			    $this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
		    }
		}
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
	}

	function admin_edit($id = null) {
	    if (!$id) {
	        $this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
        }
		if (!empty($this->data)) {
			if ($this->User->updateAccount($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
			    $this->data['User']['new_password'] = null;
			    $this->data['User']['confirm_password'] = null;
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
		    $user = $this->User->read(null, $id);
		    if (!$user) {
		        $this->Session->setFlash(__('Invalid user', true));
			    $this->redirect(array('action' => 'index'));
	        }
			$this->data = $user;
		}
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
	}

	function admin_delete($id = null) {
		if (!$id) {
            $this->Session->setFlash(__('Invalid id for user', true));
            $this->redirect(array('action'=>'index'));
        }
        if (!empty($this->data)) {
            if ($this->User->delete($id)) {
                $this->Session->setFlash(__('User deleted', true));
                $this->redirect(array('action'=>'index'));
            }
            $this->Session->setFlash(__('User was not deleted', true));
            $this->redirect(array('action' => 'index'));
        } else {
            $this->data = $this->User->read(array('id', 'username'), $id);
        }
        if (empty($this->data['User'])) {
            $this->Session->setFlash(__('Invalid id for user', true));
            $this->redirect(array('action'=>'index'));
        }
	}

	function login() {
        $this->layout = 'admin-login';
    }

	function logout() {
        $this->layout = 'admin-login';
	    $this->redirect($this->Auth->logout());
	}

	function forgot_password() {
	    $this->layout = 'admin-login';
	    if (!empty($this->data)) {
	        $confirmation_key = $this->User->forgotPassword($this->data['User']['email']);
	        if ($confirmation_key) {
                //mailer
                $this->set(array(
                    'link' => FULL_BASE_URL . Router::url(array(
                        'controller' => 'users',
                        'action' => 'reset_password',
                        $confirmation_key
                    ))
                ));

                $this->Email->from = "Admin<admin@correzioni.com>";
                $this->Email->to = $this->data['User']['email'];
                $this->Email->subject = 'Reset Your Password';
                $this->Email->template = 'forgot';
                //$this->Email->delivery = 'debug';
                $this->Email->smtpOptions = $this->_smtpOptions();
                $this->Email->delivery = 'smtp';
                $this->Email->send();
                $this->log($this->Email->textMessage, 'debug');

                $this->Session->setFlash(__('Please check your mailbox for next step', true));
                $this->redirect(array('controller' => 'pages', 'action' => 'home', 'admin' => false));
            }
        }
	}

	function reset_password($code = null) {
	    if (!$code) {
			$this->Session->setFlash(__('Invalid confirmation key', true));
            $this->redirect(array('controller' => 'pages', 'action' => 'home', 'admin' => false));
        }

	    if (!empty($this->data)) {
	        // hash the confirmation
			$this->data['User']['confirm_password'] = $this->Auth->password($this->data['User']['confirm_password']);
	        $changed = $this->User->resetPassword($this->data['User']['id'], $this->data['User']['password']);
	        if ($changed) {
                if ($this->Auth->login($this->data)) {
                    $this->Session->setFlash(__('Your password has been changed', true));
                    $this->redirect($this->Auth->redirectLogin);
                }
            }
        }
        $user = $this->User->find('first', array(
            'conditions' => array('confirmation_key' => $code),
            'fields' => array('id', 'username')
        ));
        if (!$user) {
			$this->Session->setFlash(__('Invalid confirmation key', true));
            $this->redirect(array('controller' => 'pages', 'action' => 'home', 'admin' => false));
        }

        if (empty($this->data)) {
            $this->data = $user;
        }
        else {
            $this->data['User']['password'] = null;
            $this->data['User']['confirm_password'] = null;
        }
        $this->layout = 'admin-login';
        $this->set(compact('code'));
	}

	protected function _smtpOptions() {
        $this->loadModel('Setting');
        $smtpOptions = array_merge(array(
            'port' => '25',
            'timeout' => '30',
            'host' => 'your.smtp.server',
            'username' => 'your_smtp_username',
            'password' => 'your_smtp_password',
            'client' => 'smtp_helo_hostname'
        ), $this->Setting->smtpOptions());
        unset($this->Setting);
        return $smtpOptions;
	}
}
