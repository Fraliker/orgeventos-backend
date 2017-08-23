<?php
App::uses('AppModel', 'Model');
/**
 * Event Model
 *
 * @property EventUser $EventUser
 */
class Event extends AppModel {
        public $virtualFields = array(
            'title' => 'Event.name',
            'start' => 'DATE_FORMAT(Event.startdate,"%Y-%m-%dT%T.000Z")',
            'end'=> 'DATE_FORMAT(Event.enddate,"%Y-%m-%dT%T.000Z")'
        );
	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'EventUser' => array(
			'className' => 'EventUser',
			'foreignKey' => 'event_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
