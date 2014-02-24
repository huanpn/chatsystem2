<div class="users form">
    <?php echo $this->Form->create('Room', array('url' => array('controller' => 'room', 'action' => 'create'))); ?>
    <fieldset>
        <legend><?php echo __('Create new Room'); ?></legend>
        <?php
        echo $this->Form->input('Room Name');
        echo $this->Form->submit('Create');
        ?>
    </fieldset>
    <?php echo $this->Form->end(); ?>
</div>
<?php echo $this->Html->link('Back', array('controller' => 'room', 'action' => 'index')) ?>
<br/>
<?php echo $this->Html->link('Log out', array('controller' => 'users', 'action' => 'logout')) ?>
    