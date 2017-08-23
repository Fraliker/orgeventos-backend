<div class="events view">
<h2><?php echo __('Event'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($event['Event']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($event['Event']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($event['Event']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Startdate'); ?></dt>
		<dd>
			<?php echo h($event['Event']['startdate']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Enddate'); ?></dt>
		<dd>
			<?php echo h($event['Event']['enddate']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Site'); ?></dt>
		<dd>
			<?php echo h($event['Event']['site']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Phone'); ?></dt>
		<dd>
			<?php echo h($event['Event']['phone']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($event['Event']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address'); ?></dt>
		<dd>
			<?php echo h($event['Event']['address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Organizer'); ?></dt>
		<dd>
			<?php echo h($event['Event']['organizer']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Supporters'); ?></dt>
		<dd>
			<?php echo h($event['Event']['supporters']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Audience Limit'); ?></dt>
		<dd>
			<?php echo h($event['Event']['audience_limit']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Event'), array('action' => 'edit', $event['Event']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Event'), array('action' => 'delete', $event['Event']['id']), array(), __('Are you sure you want to delete # %s?', $event['Event']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Events'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Event'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Event Users'), array('controller' => 'event_users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Event User'), array('controller' => 'event_users', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Event Users'); ?></h3>
	<?php if (!empty($event['EventUser'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Event Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Confirmed'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($event['EventUser'] as $eventUser): ?>
		<tr>
			<td><?php echo $eventUser['id']; ?></td>
			<td><?php echo $eventUser['event_id']; ?></td>
			<td><?php echo $eventUser['user_id']; ?></td>
			<td><?php echo $eventUser['confirmed']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'event_users', 'action' => 'view', $eventUser['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'event_users', 'action' => 'edit', $eventUser['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'event_users', 'action' => 'delete', $eventUser['id']), array(), __('Are you sure you want to delete # %s?', $eventUser['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Event User'), array('controller' => 'event_users', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
