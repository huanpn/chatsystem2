<div class="users form">

    <?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __('Add User'); ?></legend>
        <?php
        echo $this->Form->input('username');
        echo $this->Form->input('password');
        echo $this->Form->submit('Add User');
        ?>
    </fieldset>
<?php echo $this->Form->end(); ?>
</div>
<?php
echo $this->Html->link('Back', array('controller' => 'users', 'action' => 'login'));
?>