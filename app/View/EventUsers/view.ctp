<div class="eventUsers view">
<h2><?php echo __('Event User'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($eventUser['EventUser']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Event'); ?></dt>
		<dd>
			<?php echo $this->Html->link($eventUser['Event']['name'], array('controller' => 'events', 'action' => 'view', $eventUser['Event']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($eventUser['User']['name'], array('controller' => 'users', 'action' => 'view', $eventUser['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Confirmed'); ?></dt>
		<dd>
			<?php echo h($eventUser['EventUser']['confirmed']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Event User'), array('action' => 'edit', $eventUser['EventUser']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Event User'), array('action' => 'delete', $eventUser['EventUser']['id']), array(), __('Are you sure you want to delete # %s?', $eventUser['EventUser']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Event Users'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Event User'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Events'), array('controller' => 'events', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Event'), array('controller' => 'events', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
