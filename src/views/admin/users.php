<section>
      <div class="container admin">
         <div class="bloc location">
            
            <h2>Utilisateurs</h2>
            <p>
               <span class="message">
                  <?=(!empty($_POST['message']))?$_POST['message']:"";?>
               </span>
            </p>
            <form method="POST">
               <button class="btn btn-success mb-3" type="submit" name="create" href="<?=HTTPS?>://<?=$_SERVER['HTTP_HOST']?>/admin/">
                  <i class="uil uil-plus"></i> Creer
               </button>
            </form>
  
            <table class="table">
               <thead>
                  <tr>
                     <th>ID</th>
                     <th class='textarea'>Image</th>
                     <th>Password</th>
                     <th></th>
                  </tr>
               </thead>
               <tbody>
                    <form method="post" id="form_produit" readonly="readonly">
                    
                    <?php foreach($utilisateurs as $equipier){
                        echo'
                        <tr id="'.$equipier['id_user'].'" class="text-center">
                            <td><input class="input" type="text" value="'.$equipier['id_user'].'" readonly="readonly"/></td>
                            <td> <img src='.HTTPS.'://'.$_SERVER['HTTP_HOST'].'/images/banque/'.strtolower($equipier['id_user']).'.jpg alt="'.$equipier['id_user'].'" class="img-fluid image"></td>
                            <td><input class="input" type="text" value="'.$equipier['password_user'].'"/></td>
                            <td><button type="submit" name="edit" value="'.$equipier['id_user'].'"class="edit_produit"><i class="uil uil-pen"></i></button><button type="submit" name="delete" value="'.$equipier['id_user'].'" class="delete_produit"><i class="uil uil-trash-alt"></i></button></td>
                        </tr>
                        ';
                    }
                    ?>
                    </form>
               </tbody>
            </table>
         </div>
      </div>
   </section>