<?php
class User extends AppModel {
	var $name = 'User';

	var $belongsTo = array('Group');

	var $hasMany = array(
        'Vote' => array(
            'className' => 'Vote',
            'foreignKey' => 'user_id',
            'dependent' => true
        )
    );

	/**
	 * Override constructor to have i18n in model validation errors
     */
	function __construct($id = false, $table = null, $ds = null) {
        parent::__construct($id, $table, $ds);

        $this->validate = array(
            'username' => array(
                'custom' => array(
                    'rule' => '/^[a-z0-9_]{3,}$/i',
                    'message' => __('Only letters, numbers, and underscores (min 3 characters)', true)
                ),
                'unique' => array(
                    'rule' => 'isUnique',
                    'message' => __('This username has been taken, please select another one', true)
                )
            ),
            'password' => array(
                'minLength' => array(
                    'rule' => array('minLength', 6),
                    'message' => __('Password must have min. 6 characters', true)
                ),
                'match' => array(
                    'rule' => array('matchPassword'),
                    'message' => __('Passwords don\'t match each other', true)
                ),
            ),
            'email' => array(
                'empty' => array(
                    'rule' => 'email',
                    'message' => __('Invalid email address', true)
                ),
                'unique' => array(
                    'rule' => 'isUnique',
                    'message' => __('This email address has been taken, please select another one', true)
                )
            ),
        );
	}

	/**
	 * Safely remove sensitive data such as password
	 *
	 * If you need the password, you must turn of this callback in your find query
	 *
	 * @param string|integer $id
	 * @return array|boolean False if password field is empty
	 */
	function afterFind($results) {
        foreach ($results as $key => $result) {
            if (isset($result[$this->alias]['password'])) {
                unset($results[$key][$this->alias]['password']);
            }
        }
        return $results;
	}

	/**
	 * Get user's password
	 *
	 * Turn off model callbacks since default find query will unset password field
	 *
	 * @param string|integer $id
	 * @return array|boolean False if password field is empty
	 */
	private function __getPassword($id) {
	    $user = $this->find('first', array(
	        'conditions' => array($this->alias . '.' . $this->primaryKey => $id),
	        'fields' => array('password'),
	        'callbacks' => false
	    ));
        return !empty($user[$this->alias]['password']) ? $user[$this->alias]['password'] : false;
	}

	/**
	 * Match password and its confirmation
	 *
	 * @param array $check
	 * @return boolean
	 */
	function matchPassword($check) {
	    if (isset($this->data[$this->alias]['confirm_password'])) {
            return $this->data[$this->alias]['confirm_password'] == $check['password'];
        }
        return false;
	}

	/**
	 * Generate a hashed password
	 *
	 * @param string $password
	 * @return string Hashed password
	 */
	private function __hash($password) {
	    App::import('Core', 'Security');
        return Security::hash($password, null, true);
	}

	function register(array $data) {
	    if (!isset($data[$this->alias])) return false;

        $data[$this->alias]['password'] = $data[$this->alias]['new_password'];
        if ($data[$this->alias]['password'] == $data[$this->alias]['confirm_password']
            && strlen($data[$this->alias]['password']) > 5)
        {
            $data[$this->alias]['password'] = $this->__hash($data[$this->alias]['password']);
            $data[$this->alias]['confirm_password'] = $data[$this->alias]['password'];
        }
        return $this->save($data);
    }

	/**
	 * Change current password
	 *
	 * Before proceeding to save action, all passwords fields must pass the validation
	 *
	 * @return boolean
	 */
	function updateAccount(array $data) {
	    // @TODO : revisit this bloody method!!
	    if (!$data || !isset($data[$this->alias])) return false;

	    $data = $data[$this->alias];
	    // check if any password field has a value
	    if (
	        !empty($data['new_password']) ||
	        !empty($data['confirm_password'])
        ) {
            // match new password and its confirmation
            if ($data['confirm_password'] != $data['new_password'])
            {
                $this->invalidate(
                    'new_password',
                    __('Passwords dont match each other', true)
                );
                $this->invalidate(
                    'confirm_password',
                    __('Passwords dont match each other', true)
                );
                return false;
            }
            // replace old password
            $data['password'] = $this->__hash($data['new_password']);
            $data['confirm_password'] = $data['password'];
	    }
	    // only save non-empty fields
	    return $this->save(Set::filter($data));
    }

    function forgotPassword($email) {
        App::import('Core', 'Validation');
        if (!Validation::email($email)) {
            $this->invalidate('email', __('Invalid email address', true));
            return false;
        }
        $user_id = $this->field('id', array('email' => $email));
        // non-existing user
        if (!$user_id) {
            $this->invalidate('email', __('Email address not found', true));
            return false;
        }
        $confirmation_key = substr(Security::hash($email), 0, 12);
        $this->id = $user_id;
        if ($this->saveField('confirmation_key', $confirmation_key)) return $confirmation_key;
    }

    function resetPassword($id, $password) {
        $this->data[$this->alias]['password'] = $password;
        $this->data[$this->alias]['confirmation_key'] = null;
        $this->id = $id;
        return $this->save($this->data, false, array('password', 'confirmation_key'));
    }
}
