<?php
namespace App\Controller;

use Cake\Event\Event;
use Cake\Http\Exception\NotFoundException;

class UsersController extends AppController
{

   public function beforeFilter(Event $event)
   {
      parent::beforeFilter($event);
      $this->Auth->allow([
         'register',
         'logout'
      ]);
   }

   public function index()
   {
      $this->set([
         'users' => $this->Users->find('all')
      ]);
   }

   public function register()
   {
      //Iniciamos entidad (para validadiones)
      $user = $this->Users->newEntity();
      //Si el request es post
      if ($this->request->is('post')) {
         //Default rol
         $this->request->data['role'] = 'author';
         //Asociamos request al usuario
         $user = $this->Users->patchEntity($user, $this->request->getData());
         //Si se añade el usuario
         if ($this->Users->save($user)) {
            $this->Flash->success(__('Usuario creado correctamente'));
            $this->redirect([
               'action' => 'login'
            ]);
         } else {
            $this->Flash->error(__('No se pudo crear el usuario'));
         }

      }
      $this->viewBuilder()->setLayout('ajax_custom');
      $this->set([
         'user' => $user
      ]);
   }

   public function login()
   {
      //Si el request es post
      if ($this->request->is('post')) {
         //Recogemos identidad del formulario
         $user = $this->Auth->identify();
         //Si existe usuario
         if ($user) {
            //Asignamos usuario a la session
            $this->Auth->setUser($user);
            $this->redirect($this->Auth->redirectUrl());
         } else {
            $this->Flash->error(__('Usuario o contraseña no validos'));
         }
      }
      $this->set([
         'user' => isset($user) ? $user : false
      ]);
      $this->viewBuilder()->setLayout('ajax_custom');
   }

   public function logout()
   {
      $this->redirect($this->Auth->logout());
   }

}