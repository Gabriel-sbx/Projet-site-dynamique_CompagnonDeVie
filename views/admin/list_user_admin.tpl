{extends file="views/layout.tpl"}
{block name="content"}
    {if $smarty.session.user->getType() != 'UC' }
    {include file="views/_partial/dashboardAdmin.tpl"}
    {else}
    {include file="views/_partial/dashboardUser.tpl"}
    {/if}
    <div class="col-8">
        <div class="py-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="text-right">Liste des utilisateurs du site :</h4>
            </div>
            <table class="table m-5">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Pseudo</th>
                        <th>Email</th>
                        <th>Date de création</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                    {foreach $arrUserAll as $objUserAll}
		
                    <tr>
                        <td> {$objUserAll->getId()}</td>
                        <td> {$objUserAll->getName()}</td>
                        <td> {$objUserAll->getSurname()}</td>
                        <td> {$objUserAll->getPseudo()}</td>
                        <td> {$objUserAll->getEmail()}</td>
                        <td> {$objUserAll->getDate_crea()|date_format:"d/m/Y H:i"}</td>
                        <td>

                            <a    href='index.php?ctrl=user&action=edit_user_admin&id={$objUserAll->getId()}' class='btn btn-primary'>Modifier</a>
                        {if $smarty.session.user->getType() == 'ADM' }
                            <a   href='index.php?ctrl=user&action=delete_user_admin&id={$objUserAll->getId()}' class='btn btn-danger' onclick=''>Supprimer</a>
                        {/if}
                        </td>
                    </tr>
                    
                    {/foreach}

                </tbody>
            </table>
        </div>
   

    {if $smarty.session.user->getType() == 'ADM' }
    
        <div class="py-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="text-right">Liste des modérateurs du site :</h4>
            </div>
            <table class="table m-5">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Pseudo</th>
                        <th>Email</th>
                        <th>Date de création</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                    {foreach $arrModoAll as $objModoAll}
		
                    <tr>
                        <td> {$objModoAll->getId()}</td>
                        <td> {$objModoAll->getName()}</td>
                        <td> {$objModoAll->getSurname()}</td>
                        <td> {$objModoAll->getPseudo()}</td>
                        <td> {$objModoAll->getEmail()}</td>
                        <td> {$objModoAll->getDate_crea()|date_format:"d/m/Y H:i"}</td>
                        <td>

                            <a    href='index.php?ctrl=user&action=edit_user_admin&id={$objModoAll->getId()}' class='btn btn-primary'>Modifier</a>
                        
                            <a    href='index.php?ctrl=user&action=delete_user_admin&id={$objModoAll->getId()}' class='btn btn-danger' onclick=''>Supprimer</a>
                       
                        </td>
                    </tr>
                    
                    {/foreach}

                </tbody>
            </table>
        </div>
   
        <div class="py-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="text-right">Liste des administrateurs du site :</h4>
            </div>
            <table class="table m-5">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Pseudo</th>
                        <th>Email</th>
                        <th>Date de création</th>
                        
                    </tr>
                </thead>
                <tbody>

                    {foreach $arrAdminAll as $objAdminAll}
        
                    <tr>
                        <td> {$objAdminAll->getId()}</td>
                        <td> {$objAdminAll->getName()}</td>
                        <td> {$objAdminAll->getSurname()}</td>
                        <td> {$objAdminAll->getPseudo()}</td>
                        <td> {$objAdminAll->getEmail()}</td>
                        <td> {$objAdminAll->getDate_crea()|date_format:"d/m/Y H:i"}</td>
                    
                    </tr>
                    
                    {/foreach}

                </tbody>
            </table>
        </div> 
    </div>
    {/if}
</section>

{/block}

