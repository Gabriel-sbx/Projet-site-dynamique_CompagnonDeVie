{extends file="views/layout.tpl"}
{block name="content"}
    {if $smarty.session.user->getType() != 'UC' }
    {include file="views/_partial/dashboardAdmin.tpl"}
    {else}
    {include file="views/_partial/dashboardUser.tpl"}
    {/if}
    <div class="col-md-10">
        <div class="py-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="text-right">Liste des témoignages archiver du site :</h4>
            </div>
            <table class="table m-5">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Titre</th>
                        <th>Pseudo de l'utilisateur</th>
                        <th>Date de création</th>
                        <th>Status du témoignages</th>
                    </tr>
                </thead>
                <tbody>
                    {foreach $arrTestify as $objTestify}
                        <tr>
                            <td> {$objTestify->getId()}</td>
                            <td> {$objTestify->getTitle()}</td>
                            <td> {$objTestify->getUser_pseudo()}</td>
                            <td> {$objTestify->getDate_crea()}</td>
                            <td> 
                                {if $objTestify->getStatus() == "V"}
                                    <span class="badge badge-warning">La demande est valider mais la date est dépasser</span>
                                 {/if}
                                 {if $objTestify->getStatus() == "NV"}
                                    <span class="badge badge-danger">La demande n'est pas valider</span>
                                 {/if}
                            </td>
                            <td>
                                 <a href='index.php?ctrl=Testify&action=edit_testify_profil&id={$objTestify->getId()}' class='btn btn-success  mx-2'>Modifier</a>
                                 <a href='index.php?ctrl=Testify&action=delete_testify_profil&id={$objTestify->getId()}' class='btn btn-danger  mx-2'>Supprimer</a>
                            </td>
                        </tr>
                    {/foreach}
                </tbody>
            </table>
        </div>
    </div>
</section>

{/block}

