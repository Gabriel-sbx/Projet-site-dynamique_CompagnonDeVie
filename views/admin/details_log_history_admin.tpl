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
                <h4 class="text-right">Historique de connexion</h4>
            </div>
            {include file='views/_partial/messages.tpl'}

            <table class="table m-5">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Date de connexion</th>
                        <th>Pseudo</th>
                    </tr>
                </thead>
                <tbody>

                    {foreach $arrLogAll as $objLogAll}
                        <tr>
                            <td> {$objLogAll->getId()}</td>                        
                            <td> {$objLogAll->getDate_crea()|date_format:"d/m/Y à H:i"}</td>
                            <td> {$objLogAll->getUser_pseudo()}</td> 
                        </tr>
                    {/foreach}

                </tbody>
            </table>
        </div>
    
      
   
    
</div>
</section>

{/block}

