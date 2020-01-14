<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table
{

   public function initialize(array $config)
   {
      $this->addBehavior('Timestamp');
      $this->hasMany('Articles');
   }

   //Validaciones del modelo
   public function validationDefault(Validator $validator)
   {
      return $validator
         ->notEmpty('username', 'Introduce un usuario')
         ->notEmpty('password', 'Introduce una contraseña')
         ->add('role', 'inList', [
            'rule' => ['inList', ['admin', 'author']],
            'message' => 'Seleccione un rol'
         ])
         ->add('username', 'custom', [
            'rule' => function ($value, $context) {
               $user = $this->find();
               $result = $user->select(['users' => $user->func()->count('Users.username')])
                  ->where(['Users.username' => $value])
                  ->toArray();
               if ($result[0]['users'] > 0) {
                  return false;
               }

               return true;
            },
            'message' => 'El usuario ya existe en la base de datos'
         ]);
   }

}