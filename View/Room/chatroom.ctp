<style>
    .main{
        display: inline-block;
        width: 80%;
        text-align: left;
    }
    .name{
        display: inline-block;
        float: left;
        width: 100px;
        font-weight: bold;
        color: blue;
    }

    .name.myName{
        color: orange;
    }
    .content{
        display: inline-block;
        float: left;
        padding-left: 10px;
    }

    .action{
        display: inline-block;
        width: 15%;
        text-align: right;
    }
</style>
<!--<script src="http://code.jquery.com/jquery-latest.js"></script>-->
<?php echo $this->Html->script('/webroot/js/jquery-2.1.0.js') ?>
<script>
//    var refreshId = setInterval(function()
//    {
//        $('#chatScreen').load();
//    }, 500);
//    $(document).ready(function() {
//        var thread_id = document.getElementById("chatScreen").value;
//        setInterval(function() {
//            $("#chatScreen").load("/View/Room/view/" + thread_id);
//        }, 1000);
//    });
    function showEditForm(id) {
        $('form#' + id).show();
    }
    function hideEditForm(id) {
        $('form#' + id).hide();
    }
//    $("#chatScreen").load("chatroom.ctp #chatScreen"), 1000;
</script>
<!--<pre>
<?php
//var_dump($this->Session->read('Auth.User.id'));die; 
?>
</pre>-->

<?php echo $this->Html->link('Back', array('controller' => 'room', 'action' => 'index')); ?>
<div class="user form">

    <span><b><?php echo $roomInfo['Room']['roomname']; ?></b></span>
    Created by <?php echo $roomInfo['User']['username']; ?>
    <br/><br/>
    <?php
    echo $this->Form->create('Message', array(
        'inputDefaults' => array(
            'label' => false
        ),
        'url' => array(
            'controller' => 'Message',
            'action' => 'add',
        ),
            )
    );
    echo $this->Form->input('content');
    echo $this->Form->submit('Send');
    ?>
    <input type="hidden" name="room_id" value="<?php echo $roomInfo['Room']['room_id'] ?>"/>
    <input type="hidden" name="status" value="0"/>
    <?php
    echo $this->Form->end();
    ?>
    
    
    <!-- Start chatScreen -->
    <div id="chatScreen">
        <?php foreach ($messages as $message): ?>
            <div class="main">
                <?php if ($userLoginInfo['user_id'] == $message['User']['user_id']) { ?>
                    <div class="name myName"><?php echo $message['User']['username'] ?></div>
                <?php } else { ?>
                    <div class="name"><?php echo $message['User']['username'] ?></div>
                <?php } ?>
                <div class="content"><?php echo $message['Message']['content']; ?></div>
            </div>
            <!---->
            <?php if ($userLoginInfo['user_id'] == $message['User']['user_id']) { ?>
                <div class="action">
                    <a href="#" onclick="showEditForm(<?php echo $message['Message']['message_id'] ?>)">Edit</a>
                    <?php echo $this->Html->link('Delete', array('controller' => 'message', 'action' => 'delete', $message['Message']['message_id'])); ?>
                </div>
                <!--Form Edit Message-->
                <?php
                echo $this->Form->create('Message', array(
                    'inputDefaults' => array(
                        'label' => false
                    ),
                    'url' => array(
                        'controller' => 'Message',
                        'action' => 'edit',
                        $message['Message']['message_id']
                    ),
                    'style' => 'display:none',
                    'id' => $message['Message']['message_id']
                ));
                echo $this->Form->input('content', array('default' => $message['Message']['content']));
                echo $this->Form->button('Cancel', array('onclick' => 'hideEditForm(' . $message['Message']['message_id'] . ')', 'id' => 'btnCancel', 'type' => 'button'));
                echo $this->Form->submit('Save');
                echo $this->Form->end();
                ?>
                <!--END Form Edit Message-->
            <?php } ?>
        <?php endforeach; ?>
    </div><!-- end of chatScreen -->
</div><!-- end of user form -->