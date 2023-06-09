<?php

class Article extends Model{

    public function __construct(){
        $this->table='tarif';
        $this->getConnection();
    }   

    public function getAllArticles(){
        $this->table='articles';
        $sql="SELECT * FROM articles ORDER BY ordre";
        return $query=$this->connexion->query($sql);

    }

    public function getOneArticle($champ,$valeur){
        $this->table='articles';
        return $this->getBy($champ,$valeur);
    }

    public function deleteOneArticle($champ,$valeur){
        $this->table='articles';
        $this->deleteBy($champ,$valeur);
    }
    

    public function updateOneArticle($id,$valeur_id){
        $this->table='articles';
        (empty($_POST['alaune']))? $_POST['alaune']="" : "";
        (empty($_POST['nomImage']))? $_POST['nomImage']="" : "";
        ($_POST['alaune']=="on")? $_POST['alaune']=1 : $_POST['alaune']=0;
        $data=[
            'libProd' => htmlspecialchars($_POST['libProd']),
            'alaune' => htmlspecialchars($_POST['alaune']),
            'descProd' => htmlspecialchars($_POST['descProd']),
            'ordre' => htmlspecialchars($_POST['ordre']),
            'nomImage' => htmlspecialchars($_POST['nomImage'])
        ];
        return $this->updateBy($id,$valeur_id,$data);
        
    }
    public function updateOneLocation($id,$valeur_id,$categories){
     
        //la table temps contient des clés primaires qui sont des foreign key pour d'autres tables. L'update ne peut se faire directement et doit passer par des sous étapes
        //On ajoute la nouvelle occurence dans la table temps
     
        $this->table="temps";
        $data['codeTemps']=htmlspecialchars($_POST['codeTemps'.str_replace(" ","_",$_POST['validating_edit'])]);
        $this->insertOne($data);//si l'occurence existe l'insertion échoue et on passe à l'étape suivante
       
        //on met à jour la table tarif contenant la foreign key
        $this->table='tarif';
        foreach($categories as $categorie) { 
          
            $data['codeCat']=$categorie['codeCat'];
            $data['tarif']=$_POST[str_replace(" ","_",$_POST['validating_edit']).$categorie['codeCat']];

            $i=0;
            $sql="UPDATE $this->table SET";
            foreach($data as $colonne => $valeur){
              $sql.=' '.$colonne.' = ? ,';
              $valeurs[$i]= $valeur;
              $i++;
            }
            $valeurs[$i]= $valeur_id;
            $valeurs[$i+1]= $categorie['codeCat'];
            $sql=substr($sql,0,-1);
            $sql.=" WHERE $id = ? AND codeCat = ? " ;
         
            $req=$this->connexion->prepare($sql);
            $req->execute($valeurs);
            
        }
        $this->table="temps";
        
        $results=$this->deleteBy($id,$valeur_id);//on supprime l'ancienne occurrence de temps
        //si l'occurence est utilisée la suppression échoue
    }
    public function insertOneArticle(){
        
        $this->table='articles';
        (empty($_POST['alaune']))? $_POST['alaune']="" : "";
        (empty($_POST['alaune']) =="on")? $_POST['alaune']=1 : $_POST['alaune']=0;
        (empty($_POST['libProd']))? $_POST['libProd']="" : "";
        (empty($_POST['descProd']))? $_POST['descProd']="" : "";
        (empty($_POST['descProd']))? $_POST['descProd']="" : rand(1,100);
        (empty($_POST['nomImage']))? $_POST['nomImage']="" : "";
        $data=[
            'libProd' => htmlspecialchars($_POST['libProd']),
            'alaune' => htmlspecialchars($_POST['alaune']),
            'descProd' => htmlspecialchars($_POST['descProd']),
            'ordre' => htmlspecialchars($_POST['ordre']),
            'nomImage' => htmlspecialchars($_POST['nomImage'])      
        ];
        return $this->insertOne($data);
        
    }
    public function insertCatLocation($articles){
        $this->table="tarif";
        foreach($articles as $article){
            $data=
            [
                "codeTemps" =>$article['codeTemps'],
                "codeCat"=>$_POST['catLocation'],
                "tarif"=>0
            ];
            $results=$this->insertOne($data);
        }
      
        return $results;
    }

    public function insertOneLocation($categories){
        $this->table="temps";
        $data['codeTemps']=htmlspecialchars($_POST['codeTemps']);
        $this->insertOne($data);
        $this->table='tarif';
        
        foreach($categories as $categorie) { 
            $data['codeCat']=$categorie['codeCat'];
            $data['tarif']=$_POST[$categorie['codeCat']];
            $results=$this->insertOne($data);
        }
        
        return $results;
        
    }
   
    public function generateTableau($data){
      
        //a partir du tableau des catégories existantes dans la table tarif on recherche les prix dans cette table en fonction des catégories
        $subreq2='';
        $i=0;
        foreach($data as $ligne){
            $subselect[$i]='t'.$i.'.tarif AS '.$ligne['codeCat'];
            $subreq1[$i]='(SELECT tarif.codeTemps,tarif.tarif
            FROM tarif
            WHERE tarif.codeCat="'.$ligne["codeCat"].'") as t'.$i;
            if($i>0){
                $subreq2.=' AND t'.($i-1).'.codeTemps=t'.$i.'.codeTemps';
            }
            $i++; 
        }
        
        $sql='SELECT DISTINCT tarif.codeTemps, '.implode(",",$subselect).'
            FROM tarif, '.implode(",",$subreq1).'
            WHERE tarif.codeTemps=t0.codeTemps'.
            $subreq2;
        $query=$this->connexion->prepare($sql);
        $query->execute();
        $results= $query->fetchAll();
        return $results;
    }
    
    public function getArticle(){
        return $this->getOne();
    }

    public function getLastId(){
        $sql="SELECT MAX(idProd) FROM articles";
        $query=$this->connexion->prepare($sql);
        $query->execute();
        $results=$query->fetch();
        $results=$results[0];
        return $results;
        
    }
}
