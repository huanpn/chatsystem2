<div class="users form">
    <h2>Welcome <?php echo $userLoginInfo['username']; ?></h2>
</div>
<?php foreach ($rooms as $room): ?>
    <?php
    echo $this->Html->link($room['Room']['roomname'], array('controller' => 'room',
        'action' => 'chatroom', $room['Room']['room_id']));
    ?>
    <!--<a href="www.google.com.vn" style="color: red">Google</a>-->
    <br />
<?php endforeach; ?>
<br /><br />
<?php echo $this->Html->link('Log out', array('controller' => 'users', 'action' => 'logout')) ?>
<br />
<?php echo $this->Html->link('Create a new room', array('controller' => 'room', 'action' => 'create')) ?>
    