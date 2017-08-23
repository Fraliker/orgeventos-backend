<?php
App::uses('AppController', 'Controller');
/**
 * Events Controller
 *
 * @property Event $Event
 * @property PaginatorComponent $Paginator
 */
class EventsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

        function beforeFilter() 
            {
               // parent::beforeFilter();
                $this->Auth->allow('index','calendar', 'add');
            }
/**
 * index method
 *
 * @return void
 */
	public function index() {
                            $this->response->header('Access-Control-Allow-Origin', '*');
            
                               // $this->loadModel('EventUser');
                                $userevents = $this->Event->EventUser->find('all',array('recursive'=>-1,'conditions'=> array('EventUser.confirmed'=>false,'EventUser.user_id'=>$this->Auth->user('id'))));
                                //var_dump($user);die();

		$this->Event->recursive = 0;
                                $this->set('userevents', $userevents[0]);
		$this->set('events', $this->Paginator->paginate());
                                $this->set('_serialize', array('events'));
	}
        
	public function calendar() {
                            $this->response->header('Access-Control-Allow-Origin', '*');
            
                               // $this->loadModel('EventUser');
                                $userevents = $this->Event->EventUser->find('all',array('recursive'=>-1,'conditions'=> array('EventUser.confirmed'=>false,'EventUser.user_id'=>$this->Auth->user('id'))));
                                //var_dump($user);die();

		$this->Event->recursive = 0;
                                $this->set('userevents', $userevents[0]);
                                $options = array('recursive'=>0,'fields' => array('title', 'start','end'),'conditions'=> array('Event.startdate is not null','Event.enddate is not null'));
                                $events = $this->Event->find('all', $options);
		$this->set('events', $events);
                                $this->set('_serialize', array('events'));
	}
        

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Event->exists($id)) {
			throw new NotFoundException(__('Invalid event'));
		}
		$options = array('conditions' => array('Event.' . $this->Event->primaryKey => $id));
		$this->set('event', $this->Event->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
                             $this->response->header('Access-Control-Allow-Origin', '*');
		if ($this->request->is('post')) {
			$this->Event->create();
                                                if (!isset($this->request->params['ext']) && $this->request->params['ext'] != 'json') {
                                                    if ($this->Event->save($this->request->data)) {
                                                            $this->Session->setFlash(__('The event has been saved.'));
                                                            return $this->redirect(array('action' => 'index'));
                                                    } else {
                                                            $this->Session->setFlash(__('The event could not be saved. Please, try again.'));
                                                    }
                                                } else {
                                                    $dates = new DateTime($this->request->data['startdate']); //'2012-09-09T21:24:34Z'
                                                    $this->request->data['startdate'] = $dates->format('Y-m-d H:i:s');
                                                     $datee = new DateTime($this->request->data['enddate']); //'2012-09-09T21:24:34Z'
                                                    $this->request->data['enddate'] = $datee->format('Y-m-d H:i:s');
                                                    $this->Event->save($this->request->data);
                                                    //$this->log(print_r($this->Event->validationErrors, true));
                                                    $events = array('response' => 'ok');
                                                    $this->set('events', $events);
                                                    $this->set('_serialize', array('events'));
                                                }
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Event->exists($id)) {
			throw new NotFoundException(__('Invalid event'));
		}
		if ($this->request->is(array('post', 'put'))) {
                                    if (!isset($this->request->params['ext']) && $this->request->params['ext'] != 'json') {


                                        if ($this->Event->save($this->request->data)) {
                                                $this->Session->setFlash(__('The event has been saved.'));
                                                return $this->redirect(array('action' => 'index'));
                                        } else {
                                                $this->Session->setFlash(__('The event could not be saved. Please, try again.'));
                                        }
                                    } else {
                                        $events = array('response' => 'ok');
                                        $this->set('events', $events);
                                        $this->set('_serialize', array('events'));
                                    }
		} else {
			$options = array('conditions' => array('Event.' . $this->Event->primaryKey => $id));
			$this->request->data = $this->Event->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Event->id = $id;
		if (!$this->Event->exists()) {
			throw new NotFoundException(__('Invalid event'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Event->delete()) {
			$this->Session->setFlash(__('The event has been deleted.'));
		} else {
			$this->Session->setFlash(__('The event could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
