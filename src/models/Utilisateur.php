<?php

    class Utilisateur extends Model{
        
        public function __construct(){
            $this->table='users';
            $this->getConnection();
        }   

        public function checkUser($mail,$password){
           
            $sql="SELECT * FROM users WHERE id_user = ? AND password_user = AES_ENCRYPT(?,'0x89cd9986f89e70d43f0b349e0e294172')";
        
            $query=$this->connexion->prepare($sql);
            $query->execute(array($mail,$password));
            $results=$query->fetch();
            return $results;  
        }
        public function getAllUsers(){
            $this->table='users';
            return $this->getAll();
        }
    
        public function getOneUser($champ,$valeur){
            $this->table='users';
            return $this->getBy($champ,$valeur);
        }
    
        public function deleteOneUser($champ,$valeur){
            $this->table='users';
            $this->deleteBy($champ,$valeur);
        }
    
        public function updateOneUser($id,$password){
            $sql="UPDATE users SET password_user = AES_ENCRYPT(?,'0x89cd9986f89e70d43f0b349e0e294172') WHERE id_user = ?";
            $query=$this->connexion->prepare($sql);
            $query->execute(array($password,$id));
            return $this->affectedRow = $query->rowCount();
            
        }
    
        public function insertOneUser(){
             
            $this->table='users';
            (empty($_POST['id_user']))? $_POST['id_user']="" : "";
            (empty($_POST['password_user']))? $_POST['password_user']="" : "";

            $sql="INSERT INTO users (id_user,password_user) VALUES(?, AES_ENCRYPT(?,'0x89cd9986f89e70d43f0b349e0e294172'));";
        
            $query=$this->connexion->prepare($sql);
            $query->execute(array($_POST['id_user'],$_POST['password_user']));
            return $this->affectedRow = $query->rowCount();
        }
    
    }
?>
