{extends file="views/layout.tpl"}
{block name="content"}

<div class="container mt-5">
  <div class="row">
    <section class="hero_listanimal_section">
      <div class="container-fluid">
      <div class="col ">
        <h1 class="display-4 "> Découvrez Tous Nos Amis du Règne Animal</h1>
        <p class="lead ">Explorez notre liste complète d'animaux, des fidèles compagnons domestiques aux créatures fascinantes du monde sauvage, et trouvez celui qui correspond le mieux à votre mode de vie et à vos envies.</p>
      </div>
    </div>
    </section>

    <div class="row">
      {foreach $arrCategory as $arrDetCategory}
      <div class="col">
        <a href="index.php?ctrl=animal&action=list_animal&id={$arrDetCategory['cat_id']}" class="btn btn-inscription mb-5 btn-lg mx-2 mt-4" type="submit">{$arrDetCategory['cat_name']}</a>
      </div>
      {/foreach}
      <div class="col">
        <a href="index.php?ctrl=animal&action=list_animal" class="btn btn-inscription mb-5 btn-lg mx-2 mt-4" type="reset">Tous</a>
      </div>
    </div>

    <div class="row">
  <form name="formSearch" method="post" action="#">
    <p>
    {* Recherche par mot clé *}
      <div class="input-group input-group-lg mb-3">
        <span class="input-group-text" id="inputGroup-sizing-lg">Recherche par mot clé</span>
        <input value="{$objAnimalsModel->strKeywords}" name="keywords" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">
      </div>
    </p>
  </div>
    {* Recherche par mot Espèce *}
    <div class="row">
    <div class="col">
      
      <p><label for="espece" class="labels"><h5>Espèce de l'animal</h5></label></p>
      <p><select class=" form-select-lg mb-3" aria-label="Large select example" name="specie">
            <option value="0" {$objAnimalsModel->strSpec == 0?"selected":""}>Toutes les espèces</option>
 
            {foreach $arrSpecie as $arrDetSpecie}
            <option value="{$arrDetSpecie['spec_name']}"{$objAnimalsModel->strSpec == $arrDetSpecie['spec_name']?"selected":""} >
              {$arrDetSpecie['spec_name']}
            </option>
            
            {/foreach}
            {$arrDetSpecie|@debug_print_var} 
          </select>
        </p>
      </div>
      
      {* Recherche par mot Race *}
      <div class="col">
        <p><label for="race" class="labels"><h5>Race de l'animal</h5></label></p>
        <select id="races" name="races" class="form-select-lg" aria-label="Large select example">
          <option value="0" {$objAnimalsModel->strRaces == 0?"selected":""}>Toutes les races </option>
          
          <!-- <?php var_dump($objAnimalsModel->strRaces);*} -->
          
          {foreach $arrBreed as $arrDetBreed }
          <option value="{$arrDetBreed['breed_name']}"
          {$objAnimalsModel->strRaces == $arrDetBreed['breed_name']?"selected":""}>
          {$arrDetBreed['breed_name']}
        </option>
        {/foreach}
      </select>
    </div>
    
    {* Recherche par Refuge *}
   <div class="col">
    <p><label for="refuge" class="labels"><h5>Refuge de l'animal</h5></label></p>
   <select class="form-select-lg mb-3" aria-label="Large select example" name="refuge">
      <option value="0" {$objAnimalsModel->strRef == 0? "selected" :""}>Tous les Refuges</option>
     
      {foreach $arrRefuge as $arrDetRefuge}
        <option value="{$arrDetRefuge['refuge_name']}">
        {$objAnimalsModel->strRef == $arrDetRefuge['refuge_name']?"selected":""}
        {$arrDetRefuge['refuge_name']}
      </option>
    {/foreach}
    </select>
   
   </div>          
  </div>
  {* Recherche par sexe *}
  <div class="row">
  <div class="col">
    <p><label for="sexe" class="labels"><h5>Sexe de l'animal</h5></label></p>
    <p><div class="form-check form-check-inline">
      <input class="form-check-input" name="sexe" {if $objAnimalsModel->strSexe == 0} checked {/if} type="radio" id="inlineCheckbox1" value="M">
      <label class="form-check-label" for="inlineCheckbox1">Male</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" name="sexe" {if $objAnimalsModel->strSexe == 1} checked {/if} type="radio" id="inlineCheckbox2" value="F">
      <label class="form-check-label" for="inlineCheckbox2">Femelle</label>
    </div>
  </p>
</div>

{*Recherche par taille*}
<div class="col">
  <p><label for="taille" class="labels"><h5>Taille de l'animal</h5></label></p>
<p><div class="form-check form-check-inline">
  <input class="form-check-input" name="size" {if $objAnimalsModel->strtSize == 0} checked {/if}  type="radio" id="inlineCheckbox1" value="PET">
  <label class="form-check-label" for="inlineCheckbox1">Petit</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" name="size" {if $objAnimalsModel->strtSize == 1} checked {/if} type="radio" id="inlineCheckbox2" value="MOY">
  <label class="form-check-label" for="inlineCheckbox2">Moyen</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" name="size" {if $objAnimalsModel->strtSize == 2} checked {/if}  type="radio" id="inlineCheckbox3" value="GRA">
  <label class="form-check-label" for="inlineCheckbox3">Grand</label>
</div>
</p>
</div>       
<div class="col">
  <p>
    <button class="btn btn-success btn-lg mx-2 mt-4" type="submit">Rechercher</button>
    <button class="btn btn-success btn-lg mx-2 mt-4" name="reset" type="reset">Réinitialiser</button>
  </p>
</div>
  </div>
  </form>
  </div>
  </div>
  {include file='views/_partial/messages.tpl'}


        <div class="row justify-content-center ">
             
               
          {foreach from=$arrAnimals item=objAnimals}
 
               
          {include file="views/_partial/cardAnimal.tpl"}
 
             
                 
      {/foreach}
             
        </div>
 
{/block}