
<div class="container">
   <div class="row text-center">
      <div class="col-12 home__title">
            <h1 class=" display1">PORTFOLIO R. LOPIN </h1>
            <div class="socials">
               <a href=""><i class="uil uil-linkedin"></i></a>
               <a href="mailto:ronanlopin@yahou.fr"><i class="uil uil-envelope "></i></a>
            </div>
                 
      </div>       
   </div>
</div>
<?php 
   foreach($produits as $produit){
      if($produit['alaune']===1){
         echo'
         <div class="container article">
            <div class="row mb-1 text-center">
               <div class="card col-8" style="">
               <img src="'.HTTPS.'://'.$_SERVER['HTTP_HOST'].'/images/produits/'.$produit['libProd'].$produit['idProd'].'.'.$produit['nomImage'].'" alt="'.$produit['libProd'].'" class="img-fluid image ">
               <div class="card-body">
                        <p class="card-text">'.$produit["descProd"].'</p>
                  </div>
               </div>     
            </div>
         </div>
         ';
      }
   }
?>
    