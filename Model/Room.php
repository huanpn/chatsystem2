<?php

App::uses('AppModel', 'Model');

class Room extends AppModel {

    public $validate = array(
        'roomname' => array(
            'notEmpty' => array(
                'rule'=> array('notEmpty'),
                'message' => 'Room\'s name cannot be empty',
            ),
            'isUnique' => array(
                'rule'=> array('isUnique'),
                'message' => 'Room\'s name has been taken',
            ),
        ),
    );
    
    public function getAllRooms() {
        return $this->find('all');
    }

    public function getRoomInfoByRoomId($room_id) {
//        var_dump($room_id);die;
        $option = array(
            'joins' => array(
                array(
                    'table' => 'users',
                    'type' => 'INNER',
                    'alias' => 'User',
                    'conditions' => 'User.user_id = Room.user_id',
                ),
            ),
            'fields' => array('User.username','Room.roomname','Room.room_id'),
            'conditions' => 'Room.room_id='.$room_id,
        );

        return $this->find('first', $option);
    }
    
    

}

?>
