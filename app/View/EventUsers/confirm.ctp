<style>
    .submit {
    display: inline-block;
    /* add more crazy CSS3 stuff like rounded corners and gradients... */
}
</style><div class="eventUsers form">
<?php echo $this->Form->create('EventUser'); ?>
	<fieldset>
                 <?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
	<legend><?php echo __('User Confirmation'); ?></legend>
                <h2>Would you like to go to <?php echo $event['Event']['name']; ?> from <?php echo $event['Event']['startdate']; ?> to <?php echo $event['Event']['enddate']; ?> about to happen in the address <?php echo $event['Event']['address'];?> ? 
                </h2>
                <center><p><?php echo $this->Form->submit('No', array('name' => 'responsebtn')); ?>
                <?php echo $this->Form->submit('Yes', array('name' => 'responsebtn')); ?></p>
                </center>
                 </fieldset>
<?php echo $this->Form->end(); ?>
</div>
                