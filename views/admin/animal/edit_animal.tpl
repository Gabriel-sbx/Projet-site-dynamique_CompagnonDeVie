{extends file="views/layout.tpl"}
{block name="content"}
{if $smarty.session.user->getType() != 'UC' }
{include file="views/_partial/dashboardAdmin.tpl"}
{else}
{include file="views/_partial/dashboardUser.tpl"}
{/if}
<div class="col-md-10 ">
  
  <div class="my-5">
    <h2 class="text-center">Modifier les informations des animaux</h2>
  </div>
  {include file='views/_partial/messages.tpl'}

  <form action="" method="post" enctype="multipart/form-data">
    <div class="row justify-content-center my-5">
      
      {*Modification des photos de l'animal*}
      <div class="col-md-5">
        <label><h5>Photo Animal de la Carte</h5></label>
        <img src="assets/images/animal/card/{$objAnimal->getPicture()}" >
        <input class="form-control" name="image" id="file" type="file">
        
        
        {*Modification de la description de l'animal*}
        <div>
          <p><label for="description" class="labels"><h5>Description de l'animal</h5></label></p>
          <textarea id="description" name="description" type = "text" class="form-control"  value="">{$objAnimal->getDescription()}</textarea>
        </div>
      </div>
      
      {*Modification du nom de l'animal*}
      <div class="col-md-5">
        <div>
          <label for="name" class="labels"><h5>Nom de l'animal</h5></label>
          <input id="name" name="name" type="text" class="form-control"  value="{$objAnimal->getName()}">
        </div>
        
        {*Modification du statut de l'animal*}
        <div>
          <p><label for="status" class="labels"><h5>Statut</h5></label></p>
          <div class="form-check form-check-inline">
            <input class="form-check-input" name="status" {if $objAnimal->getStatus() == D} checked {/if}  type="radio" id="inlineCheckbox1" value="D">
            <label class="form-check-label" for="inlineCheckbox3">Disponible</label>
          </div>
          
          <div class="form-check form-check-inline">
            <input class="form-check-input" name="status" {if $objAnimal->getStatus() == ND} checked {/if}  type="radio" id="inlineCheckbox3" value="ND">
            <label class="form-check-label" for="inlineCheckbox3">Non-Disponible</label>
          </div>
          
        </div>
        
        {*Modification du refuge de l'animal*}
        <div>
          <p><label for="status" class="labels"><h5>Refuge</h5></label></p>
          <p><div class="form-check form-check-inline">
            <input class="form-check-input" name="refuge_id" {if $objAnimal->getRefuge_id() == 1} checked {/if}  type="radio" id="inlineCheckbox1" value="1">
            <label class="form-check-label" for="inlineCheckbox1">Refuge de Strasbourg</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" name="refuge_id" {if $objAnimal->getRefuge_id() == 2} checked {/if} type="radio" id="inlineCheckbox2" value="2">
            <label class="form-check-label" for="inlineCheckbox2">Refuge de Colmar</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" name="refuge_id" {if $objAnimal->getRefuge_id() == 3} checked {/if}  type="radio" id="inlineCheckbox3" value="3">
            <label class="form-check-label" for="inlineCheckbox3">Refuge de Saint-Louis</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" name="refuge_id" {if $objAnimal->getRefuge_id() == 4} checked {/if}  type="radio" id="inlineCheckbox4" value="4">
            <label class="form-check-label" for="inlineCheckbox3">Refuge de Niederschaeffolsheim</label>
          </div>
        </p>
      </div>
      
      {*Modification du sexe de l'animal*}
      <div>
        <div class="form-check form-check-inline">
          <p><label for="sexe" class="labels"><h5>Sexe</h5></label></p>
          <input class="form-check-input" name="sexe" {if $objAnimal->getSexe() == M} checked {/if}  type="radio" id="inlineCheckbox2" value="M">
          <label class="form-check-label" for="inlineCheckbox3">Male</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" name="sexe" {if $objAnimal->getSexe() == F} checked {/if}  type="radio" id="inlineCheckbox3" value="F">
          <label class="form-check-label" for="inlineCheckbox3">Femelle</label>
        </div>
        
      </div>
      
      {*Modification de la compatibilité avec les animaux*}
      <div>
        <p><label for="status" class="labels"><h5>Compatibilité avec les animaux</h5></label></p>
        <div class="form-check form-check-inline">
          <input class="form-check-input" name="compatibility_animals" {if $objAnimal->getCompatibility_animals() == O} checked {/if}  type="radio" id="inlineCheckbox1" value="O">
          <label class="form-check-label" for="inlineCheckbox1">Oui</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" name="compatibility_animals" {if $objAnimal->getCompatibility_animals() == N} checked {/if} type="radio" id="inlineCheckbox2" value="N">
          <label class="form-check-label" for="inlineCheckbox2">Non</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" name="compatibility_animals" {if $objAnimal->getCompatibility_animals() == AV} checked {/if}  type="radio" id="inlineCheckbox3" value="AV">
          <label class="form-check-label" for="inlineCheckbox3">A vérifier</label>
        </div>
        
      </div>
      
      {*Modification de la compatibilité avec les enfants*}
      <div>
        <p><label for="status" class="labels"><h5>Compatibilité avec les enfants</h5></label></p>
        <div class="form-check form-check-inline">
          <input class="form-check-input" name="compatibility_children" {if $objAnimal->getCompatibility_children() == O} checked {/if}  type="radio" id="inlineCheckbox1" value="O">
          <label class="form-check-label" for="inlineCheckbox1">Oui</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" name="compatibility_children" {if $objAnimal->getCompatibility_children() == N} checked {/if} type="radio" id="inlineCheckbox2" value="N">
          <label class="form-check-label" for="inlineCheckbox2">Non</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" name="compatibility_children" {if $objAnimal->getCompatibility_children() == AV} checked {/if}  type="radio" id="inlineCheckbox3" value="AV">
          <label class="form-check-label" for="inlineCheckbox3">A vérifier</label>
        </div>
      </div>
      
      {*Modification de la date de naissance de l'animal*}
      <div>
        <p><label for="date_birth" class="labels"><h5>Date de naissance</h5></label></p>
        <input id="date_birth" name="date_birth" type="date" class="form-control"   value="{$objAnimal->getDate_birth()}">
      </div>
      {*Modification de la race de l'animal*}
      <div>
        <p><label for="breed_id" class="labels"><h5>Race de l'animal</h5></label></p>
        <select id="breed_id" name="breed_id" type="number" class="form-control"  value="{$objAnimal->getbreed_name()} ">
          <option value="0" {$objAnimal->getbreed_id() == 0?"selected":""}>Toutes les races </option>

          {foreach $arrBreed as $arrDetBreed }
          <option value="{$arrDetBreed['breed_id']}"
          {$objAnimal->getbreed_id() == $arrDetBreed['breed_id']?"selected":""}>
          {$arrDetBreed['breed_name']}
        </option>
        {/foreach}
      </select>  
      </div> 
    </select>
    </div>

    </div>
  </div>
  <div class="row text-end">
    <div class="col ">
    <div class="my-5 text-center"><button class="btn btn-success btn-lg mx-2" type="submit">Sauvegarder les modifications</button></div>
  </div>
</form>
<div class="col-md-3">

<div><a href="index.php?ctrl=animal&action=edit_animal_caroussel&id={$objAnimal->getId()}" class="btn btn-success btn-lg mx-2 my-5 text-center">Modifier les images Fiche détaillées</a></div>
  </div>


</section>
{/block}
  
      
