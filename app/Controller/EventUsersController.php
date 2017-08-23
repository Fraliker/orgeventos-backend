<?php
App::uses('AppController', 'Controller');
/**
 * EventUsers Controller
 *
 * @property EventUser $EventUser
 * @property PaginatorComponent $Paginator
 */
class EventUsersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
        
                function beforeFilter() 
                {
                            // parent::beforeFilter();
                             $this->Auth->allow('addalluserstoevent');
               }
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->EventUser->recursive = 0;
		$this->set('eventUsers', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->EventUser->exists($id)) {
			throw new NotFoundException(__('Invalid event user'));
		}
		$options = array('conditions' => array('EventUser.' . $this->EventUser->primaryKey => $id));
		$this->set('eventUser', $this->EventUser->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->EventUser->create();
			if ($this->EventUser->save($this->request->data)) {
				$this->Session->setFlash(__('The event user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The event user could not be saved. Please, try again.'));
			}
		}
		$events = $this->EventUser->Event->find('list');
		$users = $this->EventUser->User->find('list');
		$this->set(compact('events', 'users'));
	}
        
        	public function addalluserstoevent($id = null) {

                                $this->loadModel('User');
                                $users = $this->User->find('all', array('recursive'=>0));
                                $c=0;
                                foreach($users as $key => $user){
                                    $c++;
                                    $neweventuser = array( 'EventUser' => array('event_id' => $id, 'user_id' =>$user['User']['id']));
                                    $this->EventUser->create();
		    $this->EventUser->save($neweventuser);
                                }
                                $events = array('response' =>$c);
                                $this->set('events', $events);
                                $this->set('_serialize', array('events'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->EventUser->exists($id)) {
			throw new NotFoundException(__('Invalid event user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->EventUser->save($this->request->data)) {
				$this->Session->setFlash(__('The event user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The event user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('EventUser.' . $this->EventUser->primaryKey => $id));
			$this->request->data = $this->EventUser->find('first', $options);
		}
		$events = $this->EventUser->Event->find('list');
		$users = $this->EventUser->User->find('list');
		$this->set(compact('events', 'users'));
	}
	public function confirm($id = null) {
		if (!$this->EventUser->exists($id)) {
			throw new NotFoundException(__('Invalid event user'));
		}
		if ($this->request->is(array('post', 'put'))) {
                                                   if($this->request->data['responsebtn'] == 'Yes') {
                                                        $this->request->data['EventUser']['confirmed']=1;
                                                        if ($this->EventUser->save($this->request->data)) {
                                                                $this->Session->setFlash(__('The event user has been saved.'));
                                                                return $this->redirect(array('action' => 'index'));
                                                        } else {
                                                                $this->Session->setFlash(__('The event user could not be saved. Please, try again.'));
                                                        }
                                                   } else {
                                                       //var_dump($this->request->data);die();
                                                     //  $this->request->allowMethod('post', 'delete');
                                                        if ($this->EventUser->delete($this->request->data['EventUser']['id'])) {
                                                                $this->Session->setFlash(__('The event user has been deleted.'));
                                                                return $this->redirect(array('action' => 'index'));
                                                        } else {
                                                                $this->Session->setFlash(__('The event user could not be deleted. Please, try again.'));
                                                        }
                                                   }

		} else {
			$options = array('conditions' => array('EventUser.' . $this->EventUser->primaryKey => $id));
			$this->request->data = $this->EventUser->find('first', $options);
		}
                
                                $options = array('conditions' => array('EventUser.' . $this->EventUser->primaryKey => $id));
		$eventuser = $this->EventUser->find('first', $options);
                                $options = array('recursive'=>0);
		$event = $this->EventUser->Event->find('all', $options)[0];
                                $this->set(compact('event'));
                                //var_dump($event);die();
                                

	}
/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->EventUser->id = $id;
		if (!$this->EventUser->exists()) {
			throw new NotFoundException(__('Invalid event user'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->EventUser->delete()) {
			$this->Session->setFlash(__('The event user has been deleted.'));
		} else {
			$this->Session->setFlash(__('The event user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
