
<nav class="navbar navbar-expand-lg navbar-dark">
   <div class="container">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
     </button>

      <div class="collapse navbar-collapse" id="navbarsExample07">
         <ul class="navbar-nav mr-auto">

            <li class="nav-item">
               <a class="nav-link" href="<?=HTTPS?>://<?=$_SERVER['HTTP_HOST']?>/admin">Menu</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="<?=HTTPS?>://<?=$_SERVER['HTTP_HOST']?>/admin/utilisateurs">Utilisateurs</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="<?=HTTPS?>://<?=$_SERVER['HTTP_HOST']?>/admin/articles">Articles</a>
            </li>
         </ul>
         <a href="<?=HTTPS?>://<?=$_SERVER['HTTP_HOST']?>/utilisateurs/logout" type="button" class="btn">Deconnexion</a>
      </div>
   </div>
</nav>
