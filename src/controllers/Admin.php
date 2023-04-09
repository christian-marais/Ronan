<?php
class Admin extends Controller{

    public function index(){//pour aller au menu de back-end
        if($_SESSION['login']=='logged'){//si on est loggé on affiche le menu
            $this->layout="admin";
            $this->theme="admin";
            $this->render('index',[],'admin');
        }else{//sinon réaffiche la page de login
            header('Location: '.HTTPS.'://'.$_SERVER['HTTP_HOST'].'/utilisateurs/login');
        }
    }

    public function articles(){

        if($_SESSION['login']=='logged'){//si on est loggé on peut accéder au backend du produit
              
            if(empty($_POST)){//si aucune opération n'a été faite on charge quand meme l'affichage 
                // on charge les données et définit le layout puis charge l'affichage
                $this->loadModel("Article");
                $articles=$this->Article->getAllArticles();
                $this->layout='admin';
                $this->render('produits',compact('articles'));// on envoie les variables obtenues dans la méthode


            }elseif(!empty($_POST['edit'])){//si on veut accéder à la page d'édition d'un produit
                $this->loadModel("Article");
                $this->loadModel("Categorie");
                $article=$this->Article->getOneArticle('idProd',htmlspecialchars($_POST['edit']));//les données recues sont systématiquement échappées
                $categories=$this->Categorie->getAllCategories();
                $this->layout='admin';
                $this->render('editArticle',compact('article','categories'));


            }elseif(isset($_POST['validating_edit'])){//quand on valide une edition
                
                $this->loadModel("Article");
                $this->loadModel("Categorie");
                $article=$this->Article->getOneArticle('idProd',htmlspecialchars($_POST['validating_edit']));
                
                //json avec les données de l'image et ses contrainte; la méthode gestion de fichier s'occupe de la sélection et du déplacement de fichier
                $data=[
                    'name'=> $article['libProd'].$article['idProd'],// on passe par le php pour donner un nom avec un id à 6 chiffres 
                    'ext'=> ['jpg','gif','png','mp4'],//on aurait pu le faire en sql mais on aurait du gérer à chaque fois un id à 6 chiffres
                    'height' => 20000,//on définit une hauteur maximale autorisée
                    'width'=> 20000,//etc
                    'size' => 200000,//on définit une taille maximale autorisée
                    'path' => 'images/produits/'//on donne l'adress ou le fichier doit être copié à partir de la racine
                ];
                $this->gestionfichier($data);// on utilise la méthode gestion de fichier
                if($this->Article->updateOneArticle('idProd',htmlspecialchars($_POST['validating_edit']))){
                    
                 
                    $_POST['message'].="L'article a été mis à jour";
                    
                }else{
                    unlink(ROOT.'images/produits/'.$article['libProd'].$article['idProd'].$_POST['nomImage']);
                }
                $article=$this->Article->getOneArticle('idProd',htmlspecialchars($_POST['validating_edit']));
                $categories=$this->Categorie->getAllCategories();
                $this->layout='admin';
                $this->render('editArticle',compact('article','categories')); 


            }elseif(!empty($_POST['delete'])){//si si on valide le delete
               $this->loadModel("Article");
                
                if($this->Article->deleteOneArticle('idProd',htmlspecialchars($_POST['delete']))){
                    $_POST['message']="L'article a bien été supprimé";
                    unlink(ROOT.'images/produits/'.substr("000000",strlen($_POST['delete'])).'.jpg');
                }
                $articles=$this->Article->getAllArticles();
                $this->layout='admin';
                $this->render('produits',compact('articles'));
               

            }elseif(isset($_POST['create'])){//si on veut aller sur la page de création de produit
                $this->loadModel("Categorie");
                $categories=$this->Categorie->getAllCategories();
                $this->layout='admin';
                $this->render('createArticle',compact('categories'));


            }elseif(isset($_POST['validating_create'])){//si on valide la création
                
                $this->loadModel("Article");
                
                $article=$this->Article->getLastId()+1;
                $data=[
                    'name'=> $_POST['libProd'].$article,// on passe par le php pour donner un nom avec un id à 6 chiffres 
                    'ext'=> ['jpg','gif','png'],//on aurait pu le faire en sql mais on aurait du gérer à chaque fois un id à 6 chiffres
                    'height' => 20000,//on définit une hauteur maximale autorisée
                    'width'=> 20000,//etc
                    'size' => 200000,//on définit une taille maximale autorisée
                    'path' => 'images/produits/'//on donne l'adress ou le fichier doit être copié à partir de la racine
                ];
                $this->gestionfichier($data);// on utilise la méthode gestion de fichier
                
                if($this->Article->insertOneArticle()){//on insert un article. on execute l'opération à réaliser dans un if pour avoir les succès et echecs

                    $_POST['message'].="L'article a été créé.";
                    header('Location: '.HTTPS.'://'.$_SERVER['HTTP_HOST'].'/admin/articles');  
                }else{
                    unlink(ROOT.'images/produits/'.$article['libProd'].$article['idProd'].$_POST['nomImage']);
                }
                $this->layout='admin';
                $this->render('createArticle');   
            }
        }else{
            header('Location: '.HTTPS.'://'.$_SERVER['HTTP_HOST'].'/utilisateurs/login');
        }
    }
    //idem voir la méthode similaire produits
    public function utilisateurs(){//methode appellé pour la gestion des équipiers

        if($_SESSION['login']=='logged'){
            
            if(empty($_POST)){
                
                $this->loadModel("Utilisateur");
                $utilisateurs=$this->Utilisateur->getAllUsers();
                $this->layout='admin';
                $this->render('users',compact('utilisateurs'));
                
                
            }elseif(!empty($_POST['edit'])){//si on veut aller à la page d'édition
                $this->loadModel("Utilisateur");
                $utilisateur=$this->Utilisateur->getOneUser('id_user',htmlspecialchars($_POST['edit']));
                $this->layout='admin';
                $this->render('editUser',compact('utilisateur'));


            }elseif(isset($_POST['validating_edit'])){//si l'édition a réussie
                $this->loadModel("Utilisateur");
                $utilisateur=$this->Utilisateur->getOneUser('id_user',$_POST['validating_edit']);
                $data=[
                    'name'=> $utilisateur['id_user'],
                    'ext'=> ['jpg'],
                    'height' => 2000,
                    'width'=> 2000,
                    'size' => 1000,
                    'path' => 'images/banque/'
                ];
                $this->gestionfichier($data);
                if($this->Utilisateur->updateOneUser(htmlspecialchars($_POST['validating_edit']),htmlspecialchars($_POST['password_user']))){
                   
                    $_POST['message'].="L'utlisateur a été mis à jour. ";
                    header('Location: '.HTTPS.'://'.$_SERVER['HTTP_HOST'].'/admin/utilisateurs'); //si on reussit l'insert on est redirigé        
                
                }else{
                    unlink(ROOT.'images/banque/'.$utilisateur['id_user'].'jpg');
                }
                
                $this->layout='admin';
                $this->render('editUser',compact('utilisateur')); 


            }elseif(!empty($_POST['delete'])){//si le delete a réussi
                $this->loadModel("Utilisateur");
                if($this->Utilisateur->deleteOneUser('id_user',htmlspecialchars($_POST['delete']))){
                    $_POST['message']="L'utilisateur a bien été supprimé";
                    unlink(ROOT.'images/banque/'.$_POST['delete'].'.jpg');
                }
                $utilisateurs=$this->Utilisateur->getAllUsers();
                $this->layout='admin';
                $this->render('users',compact('utilisateurs'));
            

            }elseif(isset($_POST['create'])){//si on veut aller à la page de création
                $this->layout='admin';
                $this->render('createUser');


            }elseif(isset($_POST['validating_create'])){//si l'équipier a bien été créé
                
                $this->loadModel("Utilisateur");
                $this->layout='admin';
               
                if($this->Utilisateur->insertOneUser()){//en cas d'insert réussi
                    $data=[
                        'name'=> $_POST['id_user'],
                        'ext'=> ['jpg'],
                        'height' => 1000,
                        'width'=> 1000,
                        'size' => 500,
                        'path' => 'images/banque/'
                    ];
                    $this->gestionfichier($data);
                    $_POST['message'].="L'utilisateur a été créé.";
                    header('Location: '.HTTPS.'://'.$_SERVER['HTTP_HOST'].'/admin/utilisateurs'); //si on reussit l'insert on est redirigé        
                }
                $_POST['message'].="L'utilisateur n'a pas été créé.";//message en cas d'érreur
                $this->render('createUser');//si l'insert n'est pas réussie on affiche la page pour le résultat
            }   
        }else{
            header('Location: '.HTTPS.'://'.$_SERVER['HTTP_HOST'].'/utilisateurs/login');
        }
         
    }
    public function getThis(){
        return $this->this;
    }
}

?>