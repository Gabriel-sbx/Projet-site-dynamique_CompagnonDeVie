
{extends file="views/layout.tpl"}
{block name="content"}


{if $smarty.session.user->getType() != 'UC' }
    {include file="views/_partial/dashboardAdmin.tpl"}
{else}
    {include file="views/_partial/dashboardUser.tpl"}
{/if}
    <div class="col-md-8 ">
        <div class=" py-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="text-right">Créer un Compte</h4>
            </div>
            {include file='views/_partial/messages.tpl'}
            <div class="row ">
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
                    <div>
                      {if $smarty.session.user->getType() == 'ADM' }

                        <p><label for="status" class="labels"><h5>Type d'utilisateur</h5></label></p>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="type" value="UC" {if $objUserAdd->getType() == UC || $objUserAdd->getType() == "" } checked {/if}  type="radio" id="inlineCheckbox1">
                            <label class="form-check-label" for="inlineCheckbox1">Utilisateur </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="type" value="MOD" {if $objUserAdd->getType() == MOD} checked {/if} type="radio" id="inlineCheckbox2" >
                            <label class="form-check-label" for="inlineCheckbox2">Modérateur</label>
                        </div>                   
                    </div>
                    {/if}
                    <div data-mdb-input-init class="form-outline mt-4">	
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
                    <div class="col-md-4 justify-content-center">
                        <div class="connectButton text-center pt-1 mb-5 pb-1">
                            <button  class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit">Ajoutez</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
{/block}
