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
                <h4 class="text-right">Supprimez ce témoignage</h4>
            </div>
            {include file='views/_partial/messages.tpl'}
            <form action="" method="post">
                <div class="row mt-2">
                <div data-mdb-input-init class="form-outline mb-4">	
                    <p>Êtes-vous sûr de vouloir supprimer ce témoignages ? Cette action est irréversible et entraînera la perte de toutes les données.</p>				
                </div>
                <div class="col-md-6">
                    <p><label for="verifDelete" class="labels"><h5>Inscrire <strong>"SUPPRIMER"</strong> dans le champ pour confirmer</h5></label></p>
                    <input type="text" id="verifDelete" name="verifDelete" class="form-control" value=""  />
                </div>
                </div>
                <div class="mt-5 text-center"><button class="btn btn-success profile-button" type="submit">Supprimez le témoignages</button></div>
            </form>
        </div>
</div>
{/block}