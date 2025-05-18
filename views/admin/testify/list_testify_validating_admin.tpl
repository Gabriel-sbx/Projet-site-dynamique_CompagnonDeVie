
{extends file="views/layout.tpl"}
{block name="content"}
{if $smarty.session.user->getType() != 'UC' }
    {include file="views/_partial/dashboardAdmin.tpl"}
{else}
    {include file="views/_partial/dashboardUser.tpl"}
{/if}
<div class="col-8">
    <div class="py-5">
        <div class="d-flex align-items-center mb-3">
            <h4 class="text-right">Liste des témoignages à valider</h4>
        </div>
            {include file='views/_partial/messages.tpl'}
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
                                    <a href='index.php?ctrl=testify&action=update_testify_validating_admin&id={$objTestify->getId()}' class='btn btn-success'>Valider</a> 
                                </div>
                                <div class="col-md-2 ">
                                    <a href='index.php?ctrl=testify&action=update_testify_no_validating_admin&id={$objTestify->getId()}' class='btn btn-inscription' onclick=''>Refuser</a>
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
