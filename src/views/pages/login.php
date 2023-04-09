<!-- Main Content -->
<div class="container-fluid login__form">
		<div class="row main-content bg-success text-center">
			<div class="col-md-4 text-center company__info">
				<span class="company__logo"><h2><span class="fa fa-android"></span></h2></span>
				<h4 class="company_title">Porfolio de Ronan</h4>
			</div>
			<div class="col-md-8 col-xs-12 col-sm-12 login_form ">
				<div class="container-fluid mt-3">
					<div class="row ">
						<form control="" method="POST" action="<?=HTTPS?>://<?=$_SERVER['HTTP_HOST']?>/utilisateurs/login" class="form-group">
							<div class="row">
								<input type="text" name="identifiant_user" id="username" class="form__input" placeholder="Username">
							</div>
							<div class="row">
								<!-- <span class="fa fa-lock"></span> -->
								<input type="password" name="password" id="password" class="form__input" placeholder="Password">
							</div>
							<div class="row text-center mx-3">
								<input type="submit" name="submit" value="VALIDER" class="btn">
							</div>
						</form>
					</div>
                    <div class="row">
						<span class="message"><?=(!empty($_POST['message']))?$_POST['message']:"";?></span>
					</div>
				</div>
			</div>
		</div>
	</div>
