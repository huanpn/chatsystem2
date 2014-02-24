<?php

App::uses('AppController', 'Controller');

class MessageController extends AppController {

    public $uses = array('Message', 'Room');

    public function add() {
        if ($this->request->is('post')) {
            $userLoginInfo = $this->Auth->user();
            $saveData['Message']['user_id'] = $userLoginInfo['user_id'];
            $saveData['Message']['room_id'] = $this->data['room_id'];
            $saveData['Message']['content'] = $this->data['Message']['content'];
            $saveData['Message']['status'] = $this->data['status'];
            if ($this->Message->save($saveData)) {
                return $this->redirect(array('controller' => 'room', 'action' => 'chatroom', $this->data['room_id']));
            }
        }
    }

    public function delete($message_id) {
        $this->Message->deleteMessage($message_id);
        $messageInfo = $this->Message->getMessageById($message_id);
        return $this->redirect(array('controller' => 'room', 'action' => 'chatroom', $messageInfo['Message']['room_id']));
    }

    public function edit($message_id) {
//        var_dump($this->data);die;
        $this->Message->editMessage($this->data,$message_id);
        $messageInfo = $this->Message->getMessageById($message_id);
        return $this->redirect(array('controller' => 'room', 'action' => 'chatroom', $messageInfo['Message']['room_id']));
    }

    public function show(){
        $messages = $this->getMessages($room_id);
        $this->set('messages', $messages);

        $roomInfo = $this->Room->getRoomInfoByRoomId($room_id);
        $this->set('roomInfo', $roomInfo);

        $userLoginInfo = $this->Auth->user();
        $this->set('userLoginInfo', $userLoginInfo);
    }
    
}

?>
