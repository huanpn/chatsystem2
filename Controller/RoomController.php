<?php

App::uses('AppController', 'Controller');

class RoomController extends AppController {

    public $uses = array('Room','Message');

    public function index() {
        $rooms = $this->Room->getAllRooms();
        $this->set('rooms', $rooms);

        $userLoginInfo = $this->Auth->user();
        $this->set('userLoginInfo', $userLoginInfo);
    }

    public function chatroom($room_id) {
        $messages = $this->Message->getMessages($room_id);
        $this->set('messages', $messages);

        $roomInfo = $this->Room->getRoomInfoByRoomId($room_id);
        $this->set('roomInfo', $roomInfo);

        $userLoginInfo = $this->Auth->user();
        $this->set('userLoginInfo', $userLoginInfo);
    }

    public function create() {
        if ($this->request->is('post')) {
            $userLoginInfo = $this->Auth->user();
            $saveData['Room']['roomname'] = $this->request->data['Room']['Room Name'];
            $saveData['Room']['user_id'] = $userLoginInfo['user_id'];
            if ($this->Room->save($saveData)) {
                $this->Session->setFlash('Add new room succssfully!');
                $this->redirect(array('controller' => 'room', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Add new room failed!!!');
            }
        }
    }

}

?>
