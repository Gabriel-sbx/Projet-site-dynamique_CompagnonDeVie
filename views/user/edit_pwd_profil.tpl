{extends file="views/layout.tpl"}
{block name="content"}
    {if $smarty.session.user->getType() != 'UC' }
    {include file="views/_partial/dashboardAdmin.tpl"}
    {else}
    {include file="views/_partial/dashboardUser.tpl"}
    {/if}
    <div class="col-md-5 ">
        <div class=" py-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="text-right">Modifier votre mot de passe</h4>
            </div>
            {include file='views/_partial/messages.tpl'}
            <form action="" method="post">
                <div class="row mt-2">
                <div data-mdb-input-init class="form-outline mb-4">	
                    <p>Le mot de passe doit contenir une minuscule, une majuscule, un caractère spéciaux et doit faire plus de 16 caractères :</p>				
                  </div>
                    <div class="col-md-6">
                        <label for="password" class="labels">Mot de passe</label>
                        <input type="password" id="password" name="password" class="form-control" value="" />
                        </div>
                    <div class="col-md-6">
                        <label for="confirm_password" class="labels">Confirmation du mot de passe</label>
                        <input type="password" id="confirm_password" name="confirm_password" class="form-control"  value="" />
                    </div>
                </div>
                <div class="mt-5 text-center"><button class="btn btn-success profile-button" type="submit">Sauvegarder les modifications</button></div>
            </form>
         </div>
    </div>
    {/block}