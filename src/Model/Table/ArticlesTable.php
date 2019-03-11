<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class ArticlesTable extends Table
{

   public function initialize(array $config)
   {
      $this->addBehavior('Timestamp');
      $this->belongsTo('Users');
   }

   //Conditions
   public function conditions($data) {
      $conditions = [];
      if (isset($data['q']) && !empty($data['q'])) {
         $conditions['Articles.title LIKE '] = '%'.$data['q'].'%';
      }
      return $conditions;
   }

   //Validaciones del modelo
   public function validationDefault(Validator $validator)
   {
      $validator
         ->add('title', [
            'length' => [
               'rule' => ['minLength', 5],
               'message' => 'El titulo es demasiado corto',
            ]
         ])
         ->add('body', [
            'length' => [
               'rule' => ['minLength', 10],
               'message' => 'El mensaje es demasiado corto',
            ]
         ]);

      return $validator;
   }

   //Comprobamos si el usuario es propietario del articulo
   public function isOwnedBy($articleId, $userId)
   {
      return $this->exists(['id' => $articleId, 'user_id' => $userId]);
   }

   //Post usuario con nombre
   public function getArticlesWithName() {
      return $this->find('all')
         ->contain([
            'Users.Articles',
            'Users' => [
               'fields' => [
                  'Users.username'
               ]
            ]
         ]);
   }

   //Post usuario con nombre
   public function getArticlesWithNameById($id) {
      return $this->find()
         ->contain([
            'Users.Articles',
            'Users' => [
               'fields' => [
                  'Users.username'
               ]
            ]
         ])
         ->where(['Articles.id' => $id])
         ->first();
   }

}