<section>
      <div class="container admin">
         <div class="row">

<form class="col-8 edit" method="POST" enctype="multipart/form-data">
  <h2>
    Ajouter un utilisateur
  </h2>
  <p>
    <span class="message">
      <?=(!empty($_POST['message']))?$_POST['message']:"";?>
    </span>
  </p>
  <div class="col-md-4 mb-3">
    <label for="id" class="form-label">
      <h3>
        Identifiant de l'utilisateur
      </h3>
    </label>
    <input name="id_user" class="form-control input" id="id" value=""/>
  </div>
  <div class="col-md-4 mb-3">
    <label for="password" class="form-label">
      <h3>
        Mot de passe : 
      </h3>
    </label>
    <input name="password_user" class="form-control input" id="password" value=""/>
  </div>




  <div class="mb-3">
    <h3>
      Importer la photo de l'utilisateur (.jpg &lt;500ko)
    </h3>
    <?php
      if(!empty($_FILES)){
        echo'<p>Nom de fichier: '.$_FILES['file']['name'].'</p>
          <p>Taille: '.substr($_FILES['file']['size'],0,-3).' ko</p>
          <p>Type de fichier : '.$_FILES['file']['type'].'</p>
        ';
      }
    ?>
    <input type="file" name="file" class="form-control" aria-label="file example">
  </div>

  <div class="mb-3">
    <button class="btn btn-primary" name="validating_create" type="submit">Valider</button>
    <a class="btn btn-success" type="button" href="<?=HTTPS?>://<?=$_SERVER['HTTP_HOST']?>/admin/utilisateurs">retour</a>
  </div>
</form>
</div>
</div>
</section