<?php

namespace app\models;
use yii\db\ActiveRecord; 
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface{
   
    /**
     * Finds an identity by the given ID.
     * @param string|integer $id the ID to be looked for
     * @return IdentityInterface|null the identity object that matches the given ID .
     */
    
    public static function findIdentity($id) {
        return static::findOne($id);
    }
    
   /**
    * Finds an identity by the given token.
    * @param string|integer $token 
    * @param type $type
    */
    
    public static function findIdentityByAccessToken($token, $type = null) {
        return static::findOne(['access_token' => $token]);
    }
    
    /**
     * 
     * @return string|integer current user auth key
     */
    
    public function getAuthKey() {
        return $this->auth_key;
    }
    
    /**
     * @return int|integer current user ID
     */
    
    public function getId() {
        return $this->sid;
    }
    
    /**
     * @param string $authKey
     * @return boolean if auth key is valid for current user
     */
    
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

}
