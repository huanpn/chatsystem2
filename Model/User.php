<?php

App::uses('AppModel', 'Model');

class User extends AppModel {

    public $primaryKey = 'user_id';
    public $validate = array(
        'username' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Username cannot be empty.',
            ),
            'isUnique' => array(
                'rule' => array('isUnique'),
                'message' => 'Username has been taken by another user.',
            ),
        ),
        'password' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Password cannot be empty',
            ),
        ),
    );

    public function beforeSave($options = array()) {
        parent::beforeSave($options);
        if (isset($this->data['User']['password'])) {
            $this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
        }
    }

}

?>
