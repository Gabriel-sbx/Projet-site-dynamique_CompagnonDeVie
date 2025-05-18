{extends file="views/layout.tpl"}
{block name="content"}

{if $smarty.session.user->getType() != 'UC' }
{include file="views/_partial/dashboardAdmin.tpl"}
{else}
{include file="views/_partial/dashboardUser.tpl"}
{/if}

    <div class="col-8">
      <div class=" my-5">
        <div class="row ">
          <div class="col-md-8">
            <div class="">
              <div class="">
                <h4 class="mb-4 ">Mon Profil</h4>
              </div>
              <div class="">
                <div class="row mb-3">
                  <div class="col-md-4 text-md-right font-weight-bold">Nom et prénom :</div>
                  <div class="col-md-8">{$objUserProfil->getName()} {$objUserProfil->getSurname()} </div>
                </div>
                <div class="row mb-3">
                  <div class="col-md-4 text-md-right font-weight-bold">Pseudo :</div>
                  <div class="col-md-8">{$objUserProfil->getPseudo()}</div>
                </div>
                <div class="row mb-3">
                  <div class="col-md-4 text-md-right font-weight-bold">Email :</div>
                  <div class="col-md-8">{$objUserProfil->getEmail()}</div>
                </div>
                <div class="row mb-3">
                  <div class="col-md-4 text-md-right font-weight-bold">Créé le :</div>
                  <div class="col-md-8">{$objUserProfil->getDate_crea()}</div>
                </div>
                <div class="row justify-content-center">
                  <div class="col-md-4">
                    <a href="index.php?ctrl=user&action=edit_profil" class="btn btn-success">Modifier</a>
                  </div>
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