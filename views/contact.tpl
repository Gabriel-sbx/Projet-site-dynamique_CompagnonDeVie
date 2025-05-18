{extends file="views/layout.tpl"}
{block name="content"}
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h1 class="text-center">Nos refuges</h1>
    </div>
  </div>
  <div class="row">
   <!-- Afficher les info des refuge ici  -->
        {foreach from=$arrRefugeAll item=objRefugeAll}      
        <div class="col-md-6 py-5 m-auto text-success">

          <h2><strong>{$objRefugeAll->getName()}</strong></h2>          
          <p>Ville : {if $objRefugeAll->getTown() == "STRAS"}Strasbourg {/if}{if $objRefugeAll->getTown() == "COL"}Colmar {/if}{if $objRefugeAll->getTown() == "NIED"}Niederschaeffolsheim {/if}{if $objRefugeAll->getTown() == "SL"}Saint-Louis {/if}</p>
          <p>Adresse : {$objRefugeAll->getAdress()}</p>
          <p>Téléphone : {$objRefugeAll->getContact()}</p>
        </div> 
        {/foreach}  
      
  </div>
  <div class="row py-5">
  <h2>Formulaire de contact</h2>
	<form name="contactForm" action="#" method="post" novalidate onSubmit="verifForm();return false;">
    <div class="row g-3">
      <p>Les informations obligatoires sont suivies d'un *</p>
      {include file='views/_partial/messages.tpl'}
      <div class="col-sm-6">
        <label for="name" class="form-label">Nom*</label>
        <input type="text" class="form-control" name="name" id="name" value="{$name}">
      </div>
      <div class="col-sm-6">
        <label for="surname" class="form-label">Prénom*</label>
        <input type="text" class="form-control" name="surname" id="surname" value="{$surname}">
      </div>
      <div class="col-12">
        <label for="email" class="form-label">Adresse mail*</label>
        <input type="email" class="form-control" name="email" id="email" value="{$email}">
      </div>
      <div class="col-sm-6">
        <label for="tel" class="form-label">Numéro de téléphone*</label>
        <input type="tel" class="form-control" name="tel" id="tel" value="{$tel}">
      </div>
      <div class="col-sm-12">
        <label for="subject" class="form-label">Sujet du message*</label>
        <input type="text" required class="form-control" name="subject" id="subject" value="{$subject}" >
      </div>
      <div class="col-sm-12">
        <label for="content" class="form-label">Contenu du message*</label>
        <textarea  class="form-control" name="content" id="content" value="" required>{$content}</textarea>
      </div>
      <div class="col-12 form-check">
        <input required type="checkbox" class="form-check-input" name="rgpd" id="rgpd" value="on" />
        <label for="rgpd">Accepter les conditions RGPD</label>
      </div>
      <p>
        <input class="btn btn-inscription" type="submit" value="Envoyer le message" />
      </p>
  </form>
  </div>
</div>
{/block}