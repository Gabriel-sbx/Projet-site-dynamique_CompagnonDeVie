 {extends file="views/layout.tpl"}
{block name="content"}
    {include file="views/_partial/dashboardAdmin.tpl"}

    <div class="col-md-10">
        <div class="py-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="text-right">Liste des événements du site :</h4>
            </div>
            <table class="table m-5">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Déscription</th>
                        <th>Date de création</th>
                    </tr>
                </thead>
                <tbody>
                   
                    {foreach $arrEventAll as $objEvent}
                   
       
                    <tr>
                        <td> {$objEvent->getId()}</td>
                        <td> {$objEvent->getName()}</td>
                        <td> {$objEvent->getDescription()}</td>
                        <td> {$objEvent->getDate()}</td>
                        <td>
                            <a href='index.php?ctrl=event&action=edit_event_admin&id={$objEvent->getId()}' class='btn btn-success btn-lg mx-2'>Modifier</a>
                            <a href='index.php?ctrl=event&action=delete_event_admin&id={$objEvent->getId()}' class='btn btn-inscription btn-lg mx-2' onclick=''>Supprimer</a>
                        </td>
                    </tr>
                   
                    {/foreach}
                   
                </tbody>
            </table>
        </div>
    </div>
</section>
{/block}
             
                   
           