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
                <a href="#" onclick="showEditForm(<?php echo $message['Message']['message_id'] ?>);
                                return false">Edit</a>
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