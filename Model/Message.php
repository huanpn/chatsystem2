<?php

App::uses('AppModel', 'Model');

class Message extends AppModel {

    public $primaryKey = 'message_id';

    public function getMessages($room_id) {

        $option = array(
            'joins' => array(
                array('table' => 'users',
                    'alias' => 'User',
                    'type' => 'INNER',
                    'conditions' => 'User.user_id = Message.user_id',
                ),
            ),
            'fields' => array('User.username,User.user_id,Message.*'),
            'conditions' => array('Message.room_id=' . $room_id . ' AND Message.status!=1'),
            'order' => array('Message.message_id' => 'desc'),
        );

        return $this->find('all', $option);
    }

    public function getMessageById($message_id) {
        $option = array(
            'conditions' => array('Message.message_id=' . $message_id)
        );
        return $this->find('first', $option);
    }

    public function deleteMessage($message_id) {
        $this->data['Message']['message_id'] = $message_id;
        $this->data['Message']['status'] = 1;
        return $this->save($this->data);
    }

    public function editMessage($savedata, $message_id){
//        var_dump($editInfo);die;
        $this->data['Message']['message_id'] = $message_id;
        $this->data['Message']['status'] = 2;
        $this->data['Message']['content'] = $savedata['Message']['content'];
//        var_dump($this->data);die;
        return $this->save($this->data);
    }
}

?>
