<?php
class Pages extends Controller{
    public function index(){//méthode permettant d'afficher les pages complète ou statiques
        $this->theme="default";
        $this->loadModel("Article");
        $produits=$this->Article->getAllArticles();
     
        $this->render('index',compact('produits'));
      
    }
    public function erreur404(){//fait les redirections 404
        $this->layout="blank";//on choisit le layout et les éléments html (heads...)
        $this->theme="default";
        $this->render('404');
    }
} 
?>  