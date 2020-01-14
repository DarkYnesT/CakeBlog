<?php

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

class AppController extends Controller
{

    //Funcion para cargar componentes
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        $this->loadComponent('Flash');

        $this->loadComponent('Security');

        $this->loadComponent('Auth', [
            'authorize' => ['Controller'],
            'loginRedirect' => [
                'controller' => 'articles',
                'action' => 'index',
            ],
            'logoutRedirect' => [
                'controller' => 'articles',
                'action' => 'index',
            ],
        ]);
    }

    //Antes de las acciones
    public function beforeFilter(Event $event)
    {
        $this->Auth->allow(['index', 'view']);
    }

    //Autorizacion por roles
    public function isAuthorized($user)
    {
        // Admin can access every action
        if (isset($user['role']) && $user['role'] === 'admin') {
            return true;
        }

        // Default deny
        return false;
    }

    /**
     * Funcion para paginar modelos
     *
     * @param $model //objeto modelo a paginar
     * @param int $limit //canidad de resultados por pagina mayor que 0
     * @param int $maxLimit //canidad pagima a paginar
     * @param array|null $order //Orden en que se mostrarn los resultados
     * @param array|null $contain //Modelos con los que se relaciona
     * @param array|null $conditions //Condiciones a aplicar a la vista
     * @param array|null $whitelist //Ordenar por modelos relacionados
     * @return \Cake\Datasource\ResultSetInterface|\Cake\ORM\ResultSet
     */
    public function paginar($model, $limit = 10, $maxLimit = 100, 
        array $order = null, array $contain = null, array $conditions = null, array $whitelist = null) 
    {
        $this->paginate = [
            //canidad de resultados por pagina
            'limit' => (is_numeric($limit) && $limit > 0) ? $limit : '',
            //limite maximo
            'maxLimit' => (is_numeric($maxLimit) && $maxLimit > 0) ? $maxLimit : '',
            //ordenamiento de los datos
            'order' => !is_null($order) ? $order : '',
            //Modelos a relacionar
            'contain' => !is_null($contain) ? $contain : '',
            //condiciones para aplicar a la consulta
            'conditions' => !is_null($conditions) ? $conditions : ''
        ];
        //permitir ordenar por modelo relacionado
        if (!is_null($whitelist)) {
            $this->paginate['sortWhitelist'] = $whitelist;
        }
        return $this->paginate($model);
    }
}
