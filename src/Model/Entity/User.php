<?php
namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

class User extends Entity
{

   //Campos accesibles del modelo
   protected $_accessible = ['*' => true];

   protected function _setPassword($password)
   {
      if (strlen($password) > 0) {
         $passwordHasher = new DefaultPasswordHasher;
         return $passwordHasher->hash($password);
      }
   }

}