

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
                <h4 class="text-right">Demande d'adoption en cours :</h4>
            </div>
            <table class="table m-5">
                <thead>
                    <tr>
                        <th>Identifiant de la demande</th>
                        <th>Date de la demande</th>
                        <th>Pseudo</th>
                        <th>Nom de l'animal</th>
                        <th>Status de la demande</th>
                    </tr>
                </thead>
                <tbody>
                    
                    
                    {foreach $arrAdoptAll as $objAdopt}
		
              
				   	
			
                    <tr>
                        <td> {$objAdopt->getId()}</td>
                        <td> {$objAdopt->getDate_demand()}</td>
                        <td> {$objAdopt->getUser_pseudo()}</td>
                        <td> {$objAdopt->getAnimal_name()}</td>
                            {if $objAdopt->getStatus() == "ECV"} 
                                <td>
                                    <span class="badge badge-warning">En cours de validation</span>
                                </td>
                            {/if}
                        <td>
                            {*if $smarty.session.user->getType() == 'UC' }                           
                                <a href='index.php?ctrl=page&action=contact' class='btn btn-primary' >Contactez-nous</a>
                            {else}
                                <a href='#' class='btn btn-primary' >Traiter la demande</a> 
                            {/if*}
                        </td>                                      
                    </tr>
                    {/foreach}
                </tbody>
            </table>
        </div>
        
    </div>
</section>
{/block}