<?php
App::uses('AppController', 'Controller');
require ROOT . DS . 'vendors/autoload.php';
use Firebase\JWT\JWT;
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {
        public function beforeFilter() {
           $this->Auth->allow('add', 'login','index');
           //$this->Auth->deny('index', 'view');
        }
/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
        
     public function login() {
         $this->response->header('Access-Control-Allow-Origin', '*');
                                
        //$this->response->header('Access-Control-Allow-Origin', '*');
        //$params = json_decode(file_get_contents('php://input'),true);
        //var_dump($params);
        //$jsonData = $this->request->input('json_decode');
        //var_dump($this->request->data);die();

        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
               // echo "logado!";die();
                     if (!isset($this->request->params['ext']) && $this->request->params['ext'] != 'json') {
                         $this->redirect("/events");
                     }
                     $uid = $this->Auth->user('id');
                    if (isset($uid)) {
                        $user = $this->Auth->user();
                        $token = JWT::encode($user, Configure::read('Security.salt'));
                        $this->set('user', $user);
                        $this->set('token', $token);
                        $this->set('_serialize', array('user', 'token'));
                    } else {
                        $user = null;
                        $token= null;
                        $this->set('_serialize', array('user', 'token'));
                    }
            } else {
                if (!isset($this->request->params['ext']) && $this->request->params['ext'] != 'json') {
                    $this->redirect($this->Auth->redirect());
                }
                //$this->Session->setFlash(__('Invalid username or password, try again'));
                //throw new NotAcceptableException(__('Email or password is wrong.'));
                //echo "err";
                $data = array (
                    'status' => 400,
                    'message' => $this->Auth->authError,
                );
                $this->set('data', $data);
                $this->set('_serialize', 'data');

                $this->viewClass = 'Json';
                $this->render();
            }
        }
    }

    public function logout() {
        $this->redirect($this->Auth->logout());
    }
    
/**
 * index method
 *
 * @return void
 */
	public function index() {
                                $this->response->header('Access-Control-Allow-Origin', '*');
                                
		$this->User->recursive = 0;
		//$this->set('users', $this->Paginator->paginate());
                        
              
                              /* if (isset($category_id)) {
                                   $options = array('conditions' => array('Business.category_id' => $category_id));
                                   $businesses = $this->Business->find('all',$options);
                               } else {
                                    $businesses = $this->Business->find('all');
                               }*/
                            //   var_dump($businesses);
                        //if ($this->Auth->login()) {
                                       $users = $this->User->find('all');
                                       $this->set(array(
                                           'users' => $users,
                                           '_serialize' => array('users')
                                       ));
                       // }
                
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
                    $this->response->header('Access-Control-Allow-Origin', '*');
                    if ($this->request->is('post')) {
                        $this->User->create();
                       //$params = json_decode(file_get_contents('php://input'),true);
                       //var_dump($params);
                       //var_dump($this->request->data);die();
                        if ($this->User->save($this->request->data)) { //$this->request->data)
                            //if (!isset($this->request->params['ext']) && $this->request->params['ext'] != 'json') {
                            //    $this->Session->setFlash(__('The user has been saved'));
                            //    $this->redirect(array('action' => 'index'));
                           // } else {
                                $ret = array("add"=> true);
                                $this->set('add',$ret);
                                $this->set('_serialize', array('add'));
                           // }
                        } else {
                            $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
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
                             $this->response->header('Access-Control-Allow-Origin', '*');
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
                                                 var_dump($this->request->data);die();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
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
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('The user has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
