<?php

App::uses('AppController', 'Controller');

class UsersController extends AppController {

    public $uses = array('User');

    public function login() {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                return $this->redirect($this->Auth->redirect());
            }
            $this->Session->setFlash(__('Invalid username or password, try again'));
        }
    }

    public function logout() {
        $this->redirect($this->Auth->logout());
    }

    public function register() {
//        if ($this->request->is('post')) {
//            $this->User->create();
//            if ($this->User->save($this->data)) {
//                $this->Session->setFlash(__('New user created'));
//                $this->redirect(array('action' => 'login'));
//            }
//        }
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                return $this->redirect(array('action' => 'login'));
            }
            $this->Session->setFlash(
                    __('The user could not be saved. Please, try again.')
            );
        }
    }

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login', 'logout', 'register');
    }

}

?>
