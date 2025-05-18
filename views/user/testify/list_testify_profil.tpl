
{extends file="views/layout.tpl"}
{block name="content"}

{if $smarty.session.user->getType() != 'UC' }
    {include file="views/_partial/dashboardAdmin.tpl"}
{else}
    {include file="views/_partial/dashboardUser.tpl"}
{/if}

    <div class="col-md-10">
        <div class=" my-5">
            <div>
            <h4 class="mb-4 ">Votre liste de témoignages</h4>
            </div> 
            <div class="row ">
                    {foreach $arrTestify as $objTestify}
                        <div class="col-6">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h5 class="card-title mb-0">{$objTestify->getTitle()}</h5>
                                    </div>
                                    <p class="card-text">{$objTestify->getDescription()}</p>
                            
                                        <img src="assets/images/testify/{$objTestify->getPicture()}" 
                                            class="img-fluid rounded mb-3" 
                                            alt="Photo témoignage">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">Publié le {$objTestify->getDate_crea()}. Par {$objTestify->getUser_pseudo()}</small>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class=" col-md-2 ">
                                        <a href='index.php?ctrl=testify&action=edit_testify_profil&id={$objTestify->getId()}' class='btn btn-success'>Modifier</a> 
                                    </div>
                                    <div class="col-md-2 ">
                                        <a href='index.php?ctrl=testify&action=delete_testify_profil&id={$objTestify->getId()}' class='btn btn-inscription' onclick=''>Supprimer</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    {/foreach}          
            </div>
        </div>
    </div>
</section>
{/block}
