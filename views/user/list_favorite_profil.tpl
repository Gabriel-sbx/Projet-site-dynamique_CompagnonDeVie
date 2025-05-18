{extends file="views/layout.tpl"}
{block name="content"}
{if $smarty.session.user->getType() != 'UC' }
{include file="views/_partial/dashboardAdmin.tpl"}
{else}
{include file="views/_partial/dashboardUser.tpl"}
{/if}
  <div class="col-md-10">
    <div class=" my-5">
        <div>
          <h4 class="mb-4 ">Votre liste de favoris</h4>
        </div> 
        <div class="row ">    
            {foreach from=$arrFavorite item=objAnimals}

              {include file="views/_partial/cardAnimal.tpl"}
              
            {/foreach}                  
        </div>
    </div>
  </div>
</section>
{/block}
