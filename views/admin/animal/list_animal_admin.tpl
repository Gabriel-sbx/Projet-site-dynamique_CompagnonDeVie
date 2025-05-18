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
                <h4 class="text-right">Liste des animaux du site :</h4>
            </div>
            <table class="table m-5">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Date de création</th>
                        <th>Statut</th>
                        <th>Refuge</th>
                    </tr>
                </thead>
                <tbody>
                   
                    {foreach $arrFindAnimalAdmin as $objAnimals}
                   
       
                    <tr>
                        <td> {$objAnimals->getId()}</td>
                        <td> {$objAnimals->getName()}</td>
                        <td> {$objAnimals->getDate_crea()}</td>
                        <td> {$objAnimals->getStatus()}</td>
                        <td> {$objAnimals->getRefuge_name()}</td>
                        <td>
                            <a href='index.php?ctrl=animal&action=edit_animal&id={$objAnimals->getId()}' class='btn btn-success btn-lg mx-2'>Modifier</a>
                            <a href='index.php?ctrl=animal&action=delete_animal_admin&id={$objAnimals->getId()}' class='btn btn-inscription btn-lg mx-2' onclick=''>Supprimer</a>
                        </td>
                    </tr>
                   
                    {/foreach}
                   
                </tbody>
            </table>
        </div>
    </div>
</section>
{/block}
             
                   
           