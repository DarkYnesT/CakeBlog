<?php
namespace App\Controller;

use Cake\Event\Event;

class ArticlesController extends AppController
{
   //Establecemos permisos
   public function isAuthorized($user)
   {
      // Permitimos a los usuarios agregar articulos
      if ($this->request->getParam('action') === 'add') {
         return true;
      }

      // Si es propietario de un articulo le permitimos borrarlo o editarlo
      if (in_array($this->request->getParam('action'), ['edit', 'delete'])) {
         $articleId = (int)$this->request->getParam('pass.0');
         if ($this->Articles->isOwnedBy($articleId, $user['id'])) {
            return true;
         }
      }

      return parent::isAuthorized($user);
   }

   public function beforeFilter(Event $event)
   {
      parent::beforeFilter($event);
      $this->Auth->allow([
         'redirecToIndex',
         'index'
      ]);
   }

   public function index()
   {
      $login = false;
      //Si esta logeado enviamos true a la vista
      if ($this->Auth->user()) $login = true;
      //Todos los articulos
      $allArticles = $this->Articles->getArticlesWithName();
      //Si existe Busqueda
      if (!empty($this->request->getQuery())) {
         $articles = $this->paginar(
            $this->Articles->getArticlesWithName(),
            8,
            null,
            $this->Articles->conditions($this->request->getQuery())
         );
      } else {
         $articles = $this->paginar($this->Articles->getArticlesWithName(), 8);
      }

      $this->set([
         'articles' => $articles,
         'allArticles' => $allArticles,
         'login' => $login
      ]);
   }

   public function view($id = null)
   {
      $login = false;
      //Si esta logeado enviamos true a la vista
      if ($this->Auth->user()) $login = true;
      //Obtener un articulo por id
      $article = $this->Articles->getArticlesWithNameById($id);
      $articles = $this->Articles->find('all');

      $this->set([
         'article' => $article,
         'allArticles' => $articles,
         'login' => $login
      ]);
   }

   public function add()
   {
      //Iniciamos entidad
      $article = $this->Articles->newEntity();
      //Si el request es post
      if ($this->request->is('post')) {
         //Completar datos entidad con datos formulario
         $article = $this->Articles->patchEntity($article, $this->request->getData());
         //Guardamos id del usuario logeado
         $article->user_id = $this->Auth->user('id');
         //Guardamos datos en db
         $save = $this->Articles->save($article);
         if ($save) {
            $this->Flash->success(__('Articulo Guardado'));
            $this->redirect([
               'action' => 'edit',
               $save->id
            ]);
         } else {
            $this->Flash->error(__('No se pudo guardar el articulo'));
         }
      }
      $articles = $this->Articles->find('all');

      $this->set([
         'article' => $article,
         'allArticles' => $articles,
      ]);
   }

   public function edit($id = null)
   {
      //Obtener un articulo por id
      $article = $this->Articles->get($id);
      //Si el request es post o put
      if ($this->request->is(['post', 'put'])) {
         //Completar datos entidad con datos formulario
         $this->Articles->patchEntity($article, $this->request->getData());
         //Guardamos datos en db
         if ($this->Articles->save($article)) {
            $this->Flash->success(__('Tu artículo ha sido actualizado.'));
            $this->redirect([
               'action' => 'view',
               $id
            ]);
         } else {
            $this->Flash->error(__('Tu artículo no se ha podido actualizar.'));
         }
      }
      $articles = $this->Articles->find('all');

      $this->set([
         'article' => $article,
         'allArticles' => $articles,
         'referer' => $this->referer()
      ]);
   }

   public function delete($id)
   {
      //Comprobarmos que la peticion sea post o delete
      $this->request->allowMethod(['post', 'delete']);
      //Cogemos articulo
      $article = $this->Articles->get($id);
      //Si se ha eliminado
      if ($this->Articles->delete($article)) {
         $this->Flash->success(__('El artículo con id: {0} ha sido eliminado.', h($id)));
         $this->redirect(
            ['action' => 'index']
         );
      } else {
         $this->Flash->error(__('No se pudo eliminar'));
      }
   }
}
