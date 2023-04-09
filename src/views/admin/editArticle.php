<section>
  <div class="container admin">
    <div class="row">
      <form class="col-8 edit" method="POST" enctype="multipart/form-data">
        <h2>
          Modifier l'article
        </h2>
        <p class="text-center">
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
          <input id="id" name="idProd" class="edit_input" type="text" value="<?=$article['idProd']?>" readonly="readonly"/>
        </div>
        <div class="mb-3">
          <label for="libéllé" class="form-label">
            <h3>
              Nom de l'image
            </h3>
          </label>
          <textarea name="libProd" class="form-control" id="libéllé" placeholder="Description du produit" required><?=$article['libProd']?></textarea>
        </div>
        <div class="mb-3">
          <label for="ordre" class="form-label">
            <h3>
              Ordre
            </h3>
          </label>
          <input type="number" name="ordre" class="form-control" id="ordre" placeholder="Ordre du produit" value="<?=$article['ordre']?>"required>
        </div>

        <div class="mb-3">
          <label for="Description" class="form-label">
            <h3>
              Description de l'article
            </h3>
          </label>
          <textarea name="descProd" class="form-control" id="Description" rows="10" placeholder="Description du produit" required><?=$article['descProd']?></textarea>
        </div>

        <div class="form-check mb-3">
          <input  name="alaune" type="checkbox" id="defaultCheck2" <?=($article['alaune']==1)?"checked":"";?>/>
          <label class="form-chack-label" for="validationFormCheck1">Actif</label>
          <div class="invalid-feedback">Example invalid feedback text</div>
        </div>

        <div class="mb-3">
          <h3>
            Changer l'image de l'article (.jpg &lt;100ko)
          </h3>
          <img src="<?= HTTPS.'://'.$_SERVER['HTTP_HOST']?>/images/produits/<?= $article['libProd'].$article['idProd'].'.'.$article['nomImage']?>" alt="<?= $article['nomImage']?>" class="img-fluid image">
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
          <button class="btn btn-primary" name="validating_edit" value="<?=$article['idProd']?>"type="submit">Valider</button>
          <a class="btn btn-success" type="button" href="<?=HTTPS?>://<?=$_SERVER['HTTP_HOST']?>/admin/articles">retour</a>
        </div>
      </form>
    </div>
  </div>
</section