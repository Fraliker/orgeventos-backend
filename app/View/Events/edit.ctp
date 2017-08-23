<div class="events form">
<?php echo $this->Form->create('Event'); ?>
	<fieldset>
		<legend><?php echo __('Edit Event'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('startdate');
		echo $this->Form->input('enddate');
		echo $this->Form->input('site');
		echo $this->Form->input('phone');
		echo $this->Form->input('email');
		echo $this->Form->input('address');
		echo $this->Form->input('organizer');
		echo $this->Form->input('supporters');
		echo $this->Form->input('audience_limit');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Event.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Event.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Events'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Event Users'), array('controller' => 'event_users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Event User'), array('controller' => 'event_users', 'action' => 'add')); ?> </li>
	</ul>
</div>
