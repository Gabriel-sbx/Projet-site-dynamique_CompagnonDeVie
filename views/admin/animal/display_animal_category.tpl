{extends file="views/layout.tpl"} {block name="content"}

<div class="row justify-content-center">
  {foreach from=$arrAnimals item=objAnimals} {include
  file="views/_partial/cardAnimal.tpl"} {/foreach}
</div>

{/block}
