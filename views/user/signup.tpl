{extends file="views/layout.tpl"}
{block name="content"}
<section class="" >
  <div class="container py-5 ">
    <div class="row d-flex justify-content-center align-items-center">
      <div class="col-xl-10">
        <div class="card rounded-3 text-black">
          <div class="row g-0">
            <div class="col-lg-6">
              <div class="card-body p-md-5 mx-md-4">
                <div class="text-center">
                  <img src="assets/images/logo.png"
                    style="width: 185px;" class="mx-auto"  alt="logo">
                  <h4 class="mt-1 mb-5 pb-1">Inscrivez vous</h4>
                </div>
                {include file='views/_partial/messages.tpl'}
                <form method="post">
                  <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="name"></label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Votre nom " value="{$objUserAdd->getName()}"/>
                  </div>
                  <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="surname"></label>
                    <input type="text" id="surname" name="surname" class="form-control" placeholder="Votre prénom" value="{$objUserAdd->getSurname()}" />
                  </div>
				          <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="pseudo"></label>
                    <input type="text" id="pseudo" name="pseudo" class="form-control" placeholder="Votre pseudo" value="{$objUserAdd->getPseudo()}" />
                  </div>
				          <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="email"></label>
                    <input type="text" id="email" name="email" class="form-control" placeholder="Votre E-mail" value="{$objUserAdd->getEmail()}" />
                  </div>
                  <div data-mdb-input-init class="form-outline mb-4">	
                    <p>Le mot de passe doit contenir une minuscule, une majuscule, un caractère spéciaux et doit faire plus de 16 caractères :</p>				
                  </div>
				          <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="password"></label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Mot de passe" value="" />
                  </div>
				          <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="confirm_password"></label>
                    <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Confirmation du mot de passe" value="" />   
                  </div>
                  <div class="connectButton text-center pt-1 mb-5 pb-1">
                    <button  class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit">S'inscrire</button>
                  </div>
                  <div class="d-flex align-items-center justify-content-center pb-4">
                    <p class="mb-0 me-2">Deja un compte ?</p>
                    <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-outline"><a class="text-muted" href="index.php?ctrl=user&action=login">Connectez vous</a></button>
                  </div>
                </form>
              </div>
            </div>
            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
              <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                <h4 class="mb-4">Rejoindre notre plateforme "Compagnon de Vie"</h4>
                <div class="small mb-0">
                      <h5>Fonctionnalités exclusives :</h3>
                      <ul>
                          <li>Liste de favoris pour suivre vos animaux coup de cœur</li>
                          <li>Suivi transparent des demandes d'adoption</li>
                          <li>Inscription aux événements bénévoles</li>
                          <li>Partage de témoignages post-adoption</li>
                      </ul>       
                      <p>Ensemble, facilitons l'adoption et changeons des vies.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
{/block}