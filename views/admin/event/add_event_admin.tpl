  {extends file="views/layout.tpl"}
{block name="content"}
{if $smarty.session.user->getType() != 'UC' }
{include file="views/_partial/dashboardAdmin.tpl"}
{else}
{include file="views/_partial/dashboardUser.tpl"}
{/if}
  <div class="col-md-8 ">
    <div class=" py-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="text-right">Créer un événement</h4>
        </div>
        {include file='views/_partial/messages.tpl'}
        <div class="row ">
            <form action="" method="post" enctype="multipart/form-data">
                <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="event_name"><h5>Nom de l'évenement</h5></label>
                    <input type="text" id="name" name="event_name" class="form-control" value="{$objEvent->getName()}" />
                </div>
                <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="event_description"><h5>Description de l'événement</h5></label>
                    <textarea  id="description" name="event_description" class="form-control" value="{$objEvent->getDescription()}"></textarea>
                </div>
                <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="dateEvent"><h5>Date de l'événement</h5></label>
                    <input type="date" id="dateEvent" name="event_date" value="{$objEvent->getDate()}"   />
                </div> 
                <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="event_picture"><h5>Photo de l'évenement:</h5></label>
                    <img src="assets/images/event/{$objEvent->getPicture()}" alt="{$objEvent->getName()}">
                    <input type="file" id="picture" name="event_picture" class="form-control" value="{$objEvent->getPicture()}"/>
                </div>
                <div class="col-md-3">
                <div class="connectButton text-center pt-1 mb-5 pb-1">
                    <button  class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit">Envoyer</button>
                </div>
            </div>
            </form> 
        </div>
    </div>
</div>
</section>
{/block}