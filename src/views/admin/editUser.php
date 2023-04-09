<section>
  <div class="container admin">
    <div class="row">
      <form class="col-8 edit" method="POST" enctype="multipart/form-data">
        <h2>
          Mettre à jour l'utilisateur
        </h2>
        <p>
          <span class="message">
            <?=(!empty($_POST['message']))?$_POST['message']:"";?>
          </span>
        </p>
        <div class="mb-3">
          <label for="id" >
            <h3>
              Id :
            </h3>
          </label>
          <input id="id" name="id_user" class="edit_input" type="text" value="<?= (empty($utilisateur['id_user']))? $utilisateur['id_user'] ="":$utilisateur['id_user']; ?>" readonly="readonly"/>
        </div>
        <div class="mb-3">
          <label for="libéllé" class="form-label">
            <h3>
              password : 
            </h3>
          </label>
          <textarea name="password_user" class="form-control" id="libéllé" placeholder="Mot de passe" required><?= (empty($utilisateur['password_user']))? $utilisateur['password_user'] ="":$utilisateur['password_user']; ?></textarea>
        </div>

       
        <div class="mb-3">
          <h3>
            Changer la photo de l'utilisateur (.jpg &lt;500ko)
          </h3>
          <img src="<?= HTTPS.'://'.$_SERVER['HTTP_HOST']?>/images/banque/<?= strtolower($utilisateur['id_user'])?>.jpg" alt="<?= $utilisateur['id_user']?>" class="img-fluid image">
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
          <button class="btn btn-primary" name="validating_edit" value="<?=$utilisateur['id_user']?>"type="submit">Valider</button>
          <a class="btn btn-success" type="button" href="<?=HTTPS?>://<?=$_SERVER['HTTP_HOST']?>/admin/utilisateurs">retour</a>
        </div>
      </form>
    </div>
  </div>
</section