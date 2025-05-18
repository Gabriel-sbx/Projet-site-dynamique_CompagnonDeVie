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
                <h4 class="text-right">Liste des connexions de la semaine des utilisateurs du site :</h4>
            </div>
            <table class="table m-5">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Date de connexion</th>
                        <th>Pseudo</th>
                    </tr>
                </thead>
                <tbody>

                    {foreach $arrLogUserAll as $objLogUserAll}
		
                    <tr>
                        <td> {$objLogUserAll->getId()}</td>                        
                        <td> {$objLogUserAll->getDate_crea()|date_format:"d/m/Y à H:i"}</td>
                        <td> {$objLogUserAll->getUser_pseudo()}</td> 
                    </tr>
                    
                    {/foreach}

                </tbody>
            </table>
        </div>
    
        <div class="py-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="text-right">Liste des connexions de la semaine des modérateurs du site :</h4>
            </div>
            <table class="table m-5">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Date de connexion</th>
                        <th>Pseudo</th>
                    </tr>
                </thead>
                <tbody>

                    {foreach $arrLogModoAll as $objLogModoAll}
		
                    <tr>
                        <td> {$objLogModoAll->getId()}</td>                        
                        <td> {$objLogModoAll->getDate_crea()|date_format:"d/m/Y à H:i"}</td>
                        <td> {$objLogModoAll->getUser_pseudo()}</td> 
                    </tr>
                    
                    {/foreach}

                </tbody>
            </table>
        </div>
   
        <div class="py-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="text-right">Liste des connexions de la semaine des administrateurs du site :</h4>
            </div>
            <table class="table m-5">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Date de connexion</th>
                        <th>Pseudo</th>
                    </tr>
                </thead>
                <tbody>

                    {foreach $arrLogAdminAll as $objLogAdminAll}
		
                    <tr>
                        <td> {$objLogAdminAll->getId()}</td>                        
                        <td> {$objLogAdminAll->getDate_crea()|date_format:"d/m/Y à H:i"}</td>
                        <td> {$objLogAdminAll->getUser_pseudo()}</td> 
                    </tr>
                    
                    {/foreach}

                </tbody>
            </table>
        </div>
    
</div>
</section>

{/block}

