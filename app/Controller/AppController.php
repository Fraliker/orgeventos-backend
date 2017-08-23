<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
require ROOT . DS . 'vendors/autoload.php';
use Firebase\JWT\JWT;
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    // 'DebugKit.Toolbar',
    public $components = array(
        'Session',
        'RequestHandler',
        'Auth' => array( 
            'authenticate' => array(
                'Form' => array(
                    'fields' => array('username' => 'email','password' => 'password'),
                     'passwordHasher' => 'Blowfish'
                )
            ),
        'BzUtils.JwtToken' => array(
                'fields' => array(
                        'username' => 'email',
                        'password' => 'password',
                        'token'=> 'token'
                ),
                'header' => 'Bearer', //AuthToken Bearer
                'userModel' => 'User'
        ),
        'loginRedirect' => array('controller' => 'events', 'action' => 'index'),
        'logoutRedirect' => array('controller' => 'users', 'action' => 'login')
        )
    );
        public function beforeFilter() {
       
            if (isset($_SERVER['HTTP_ORIGIN'])) {
                header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
                header('Access-Control-Allow-Credentials: true');
                header('Access-Control-Max-Age: 86400');    // cache for 1 day
            }

            // Access-Control headers are received during OPTIONS requests
            if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

                if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
                    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         

                if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
                    header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

                exit(0);
            } 

            // $this->__setupAuth(); 
         /*try {
               $tk = $this->request->header('Bearer');
               if (!empty($tk)) {
                    $usr= JWT::decode($tk, Configure::read('Security.salt'), array('HS256'));              }
                if (empty($tk)) {
                    $this->__setupAuth(); 
                }
            } catch (\Exception $e) {
                $this->__setupAuth(); 
            }*/
            
           //$this->Auth->deny('index', 'view');
        }
    /*

        $this->Auth->authenticate = array(
            AuthComponent::ALL => array(
                'fields' => array(
                    'username' => 'email',
                    'password' => 'password'
                ),'passwordHasher' => 'Blowfish'
            ),
            'Form',
        );

        if (isset($this->request->params['ext']) && $this->request->params['ext'] == 'json') {

            header("Access-Control-Allow-Origin: *");
            
            $params = json_decode(file_get_contents('php://input'),true);
            $this->Auth->authenticate = array('Basic');
           
            if (!$this->Auth->login($params)) {
                
                $data = array (
                    'status' => 400,
                    'message' => $this->Auth->authError,
                );
                $this->set('data', $data);
                $this->set('_serialize', 'data');

                $this->viewClass = 'Json';
                $this->render();
            } 
        } //else {            echo "err auth";die(); } 
    }
     * 
     */
}
