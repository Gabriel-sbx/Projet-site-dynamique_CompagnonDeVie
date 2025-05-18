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
                <h4 class="text-right">Modifier les informations qui ont besoin d'etre modifier</h4>
            </div>
            {include file='views/_partial/messages.tpl'}

            <form action="" method="post">
                <div class="row mt-2">
                    <div class="col-md-6">
                        <label for="name" class="labels">Nom</label>
                        <input id="name" name="name" type="text" class="form-control" placeholder="Ton nom" value="{$objUserProfil->getName()}">
                    </div>
                    <div class="col-md-6">
                        <label for="surname" class="labels">Prénom</label>
                        <input id="surname" name="surname" type="text" class="form-control" placeholder="Ton prénom" value="{$objUserProfil->getSurname()}">
                    </div>
                    <div class="col-md-6">
                        <label for="pseudo" class="labels">Pseudo</label>
                        <input id="pseudo" name="pseudo" type="text" class="form-control"  placeholder="Pseudo" value="{$objUserProfil->getPseudo()}">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <label for="email" class="labels">Email</label>
                        <input id="email" name="email" type="text" class="form-control" placeholder="Ton adresse email" value="{$objUserProfil->getEmail()}">
                    </div>
                </div>
                {if $smarty.session.user->getType() == 'ADM' }
                    <p><label for="type" class="labels"><h5>Type d'utilisateur</h5></label></p>
                    {if $strPage == "edit_profil"} 
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="type" value="ADM" {if $objUserProfil->getType() == ADM} checked {/if} type="radio" id="inlineCheckbox2" >
                            <label id="type" class="form-check-label" for="inlineCheckbox3">Administrateur</label>
                        </div>
                    {else}  
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="type" value="UC" {if $objUserProfil->getType() == UC || $objUserProfil->getType() == "" } checked {/if}  type="radio" id="inlineCheckbox1">
                            <label id="type" class="form-check-label" for="inlineCheckbox1">Utilisateur</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="type" value="MOD" {if $objUserProfil->getType() == MOD} checked {/if} type="radio" id="inlineCheckbox2" >
                            <label id="type" class="form-check-label" for="inlineCheckbox2">Modérateur</label>
                        </div>
                    
                        
                    {/if}
                {/if}
                <div class="mt-5 text-center"><button class=" btn btn-success" type="submit">Sauvegarder les modifications</button></div>
            </form>
         </div>
    </div>
    <div class="col-md-3 ">
        <div class="d-flex flex-column align-items-center text-center p-3 py-5">
            <img class="rounded-circle mt-5" width="200px" height="250px" src="https://picsum.photos/id/{$randomImage}/200/300 ">
            <span class="font-weight-bold">
                {$objUserProfil->getSurname()}  
            </span>
            <span class="text-black-50">
                {$objUserProfil->getEmail()}
            </span>
        </div>
    </div>
</section>
{/block}
