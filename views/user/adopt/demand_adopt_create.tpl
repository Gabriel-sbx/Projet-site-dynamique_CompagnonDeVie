{extends file="views/layout.tpl"}
{block name="content"}

{if $smarty.session.user->getType() != 'UC' }
{include file="views/_partial/dashboardAdmin.tpl"}
{else}
{include file="views/_partial/dashboardUser.tpl"}
{/if}
  <div class="col-8">
    <div class=" my-5">
        <div>
          <h4 class="mb-4 ">Créer une demande d'adoption </h4>
        </div> 
        <div class="row ">       
        </div>
    </div>
  </div>
</section>
{/block}
