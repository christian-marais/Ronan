<?php
class Utilisateurs extends Controller{//classe utilisée pour la gestion du login et logout

    
    public function login(){
        $this->loadModel("Utilisateur");
      
        
        if(!empty($_SESSION['login'])){
            header('Location: '.HTTPS.'://'.$_SERVER['HTTP_HOST'].'/admin');
        
        }else{      
           
            if (isset($_POST['submit'])){ 
                  
                $this->layout='login';//le layout login comprend l'element html, snippet du formulaire de connexion par sa constante LOGIN
                $this->theme='login';

                if(!empty($_POST['identifiant_user']) && !empty($_POST['password'])){
                    $password = htmlspecialchars($_POST['password']);
                    $mail=htmlspecialchars($_POST['identifiant_user']);
                    
                    $utilisateur=$this->Utilisateur->checkUser($mail,$password);
                    if(!empty($utilisateur)){
                        $_SESSION['login']="logged";
                        $_POST['message']='<p>Félicitations! Vous êtes connecté! </p>'; 
                        header('Location: '.HTTPS.'://'.$_SERVER['HTTP_HOST'].'/admin');
                        
                    }else{
                        $_POST['message']='<p>Le login n\'est pas correcte</br> Essayez de vous reconnecter</p>';  
                    }
                }else{
                    $_POST['message']='<p>Tous les champs doivent être renseignés.</p>';
                    header('Location: '.HTTPS.'://'.$_SERVER['HTTP_HOST'].'/utilisateurs/login');
                }
                
            }
            $this->render('login',[],'pages');
        }
       
    
    }
    
   

    public function logout(){//on détruit les variablse de session et met fin à la session active
        session_start();
        session_destroy();
        header('Location: '.HTTPS.'://'.$_SERVER['HTTP_HOST']);

    }
} 

?>  