{extends file="views/layout.tpl"}
{block name="content"}
<section >
  <div class="container py-5 ">
    <div class="row d-flex justify-content-center align-items-center ">
      <div class="col-xl-10">
        <div class="card rounded-3 text-black">
          <div class="row g-0">
            <div class="col-lg-6">
              <div class="card-body p-md-5 mx-md-4">
                <div class="text-center">
                  <img src="assets/images/logo.png"
                    style="width: 185px;" class="mx-auto" alt="logo">
                  <h4 class="mt-1 mb-5 pb-1">Connectez-vous !</h4>
                </div>
                {include file='views/_partial/messages.tpl'}
                <form method="post">
                  <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="email"></label>
                    <input type="text" id="email" name="email" class="form-control" placeholder="Adresse-mail" value="{$strEmail}" />
                  </div>
                  <div data-mdb-input-init class=" input-group form-outline mb-4">
                    <label class="form-label"  for="password"></label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Mot de passe"  />
                    <i class="input-group-text bi-eye" onclick="toggleDisplayPassword(event)"></i>
                  </div>
                  <div class="connectButton text-center pt-1 mb-5 pb-1">
                    <button  class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit">Se connecter</button>
                      {*<div>
                        <a class="text-muted" href="#!">Mot de passe oublié ?</a>
                    </div>*}
                  </div>
                  <div class="d-flex align-items-center justify-content-center pb-4">
                    <p class="mb-0 me-2">Pas de compte ?</p>
                    <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-outline"><a class="text-muted"  href="index.php?ctrl=user&action=signup">Créer un nouveau</a></button>
                  </div>
                </form>
              </div>
            </div>
            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
              <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                <h4 class="mb-4">Nous sommes plus qu’un simple refuge</h4>
                <p class="small mb-0">Notre engagement va au-delà du simple abri. Nous plaçons le bien-être des animaux et de leurs futures familles au cœur de notre mission.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
{/block}