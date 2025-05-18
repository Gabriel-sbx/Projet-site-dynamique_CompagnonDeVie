
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
                <h4 class="text-right">Modifier un témoignages</h4>
            </div>
            {include file='views/_partial/messages.tpl'}
            <div class="row ">
                <form action="" method="post" enctype="multipart/form-data">
                    
                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="title"><h5>Titre du témoignages</h5></label>
                        <input type="text" id="title" name="title" class="form-control" value="{$objTestify->getTitle()}" />
                    </div>
                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="description"><h5>Contenu du témoignages</h5></label>
                        <textarea  id="description" name="description" class="form-control" value="">{$objTestify->getDescription()}</textarea>
                    </div>
                    {if $smarty.session.user->getType() == 'MOD' || $smarty.session.user->getType() == 'ADM'}
                    <p><label for="status" class="labels"><h5>Statut du témoignage</h5></label></p>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="status" value="V" {if $objTestify->getStatus() == V || $objTestify->getStatus() == "" } checked {/if}  type="radio" id="inlineCheckbox1">
                        <label class="form-check-label" for="inlineCheckbox1">Valider</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="status" value="NV" {if $objTestify->getStatus() == NV} checked {/if} type="radio" id="inlineCheckbox2" >
                        <label class="form-check-label" for="inlineCheckbox2">Non valider</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="status" value="ECV" {if $objTestify->getStatus() == ECV} checked {/if} type="radio" id="inlineCheckbox2" >
                        <label class="form-check-label" for="inlineCheckbox3">En cours de validation</label>
                    </div>   
                    {else}
                    <div class="form-check form-check-inline d-none">
                        <input class="form-check-input " name="status" value="ECV"  checked  type="radio" id="inlineCheckbox2" >
                        <label class="form-check-label " for="inlineCheckbox3">En cours de validation</label>
                    </div>   
                    {/if}
                    <div data-mdb-input-init class="form-outline mb-4 ">
                        <label class="form-label" for="file"><h5>Image du témoignages</h5></label>
                        <input type="file" id="file" name="image" class="form-control" />
                        <img src="assets/images/testify/{$objTestify->getPicture()}">
                    </div>
                    
                    <div class="col-md-2 connectButton text-center pt-1 mb-5 pb-1">
                        <button  class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit">Envoyer</button>
                    </div>
                </form> 
            </div>
        </div>
    </div>
</section>
{/block}
