{extends file="views/layout.tpl"}
{block name="content"}
{if $smarty.session.user->getType() != 'UC' }
{include file="views/_partial/dashboardAdmin.tpl"}
{else}
{include file="views/_partial/dashboardUser.tpl"}
{/if}

<div class="col-md-10 ">
  
  <div class="my-5">
    <h3 class="text-center">Modifier les informations des événement</h3>
  </div>
  {include file='views/_partial/messages.tpl'}

  <form action="" method="post" enctype="multipart/form-data">
    <div class="row justify-content-center my-5">
      
      {*Modification des photos de l'évenement*}
      <div class="col-md-5">
        <label><h5>Photo de l'événement de la Carte</h5></label>
        <img src="assets/images/event/{$objEvent->getPicture()}">
        <input type="file" id="picture" name="picture" class="form-control" value="{$objEvent->getPicture()}"/>

        
        
        {*Modification de la description de l'événement*}
        <div>
          <p><label for="description" class="labels"><h5>Description de l'événement</h5></label></p>
          <textarea  id="description" name="event_description" class="form-control" value="">{$objEvent->getDescription()}</textarea>
        </div>
      </div>
      
      {*Modification du nom de l'événement*}
      <div class="col-md-5">
        <div>
          <label for="name" class="labels"><h5>Nom de l'événement</h5></label>
          <input type="text" id="name" name="event_name" class="form-control" value="{$objEvent->getName()}" />
        </div>

      {*Modification de la date de naissance de l'événement*}
      <div>
        <p><label for="date_birth" class="labels"><h5>Date de l'événement</h5></label></p>
        <input id="date" name="date" type="date" class="form-control"   value="{$objEvent->getDate()}">
      </div>
    </div>
    <div class="col-md-2 connectButton text-center pt-1 mb-5 pb-1">
        <button  class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit">Envoyer</button>
    </div>
</form>
</section>
{/block}
  
      
