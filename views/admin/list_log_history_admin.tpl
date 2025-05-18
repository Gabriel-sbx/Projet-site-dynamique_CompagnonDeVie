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
                <h4 class="text-right">Historique de connexion des utilisateurs </h4>
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
                            <a    href='index.php?ctrl=log&action=details_log_history_admin&id={$objUserAll->getId()}' class='btn btn-danger' onclick=''>Voir l'historique de connexion</a>

                        </td>
                    </tr>
                    
                    {/foreach}

                </tbody>
            </table>
        </div>
   

  
    
        <div class="py-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="text-right">Historique de connexion des modérateurs</h4>
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

                            <a    href='index.php?ctrl=log&action=details_log_history_admin&id={$objModoAll->getId()}' class='btn btn-danger' onclick=''>Voir l'historique de connexion</a>

                       
                        </td>
                    </tr>
                    
                    {/foreach}

                </tbody>
            </table>
        </div>
   
        <div class="py-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="text-right">Historique de connexion des administrateurs</h4>
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

                    {foreach $arrAdminAll as $objAdminAll}
		
                    <tr>
                        <td> {$objAdminAll->getId()}</td>
                        <td> {$objAdminAll->getName()}</td>
                        <td> {$objAdminAll->getSurname()}</td>
                        <td> {$objAdminAll->getPseudo()}</td>
                        <td> {$objAdminAll->getEmail()}</td>
                        <td> {$objAdminAll->getDate_crea()|date_format:"d/m/Y H:i"}</td>
                        <td>
                        
                            <a    href='index.php?ctrl=log&action=details_log_history_admin&id={$objAdminAll->getId()}' class='btn btn-danger' onclick=''>Voir l'historique de connexion</a>
                        
                        </td>
                    </tr>
                    
                    {/foreach}

                </tbody>
            </table>
        </div>
    
</div>
</section>

{/block}

