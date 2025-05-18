{extends file="views/layout.tpl"} {block name="content"} {if
$smarty.session.user->getType() != 'UC' } {include
file="views/_partial/dashboardAdmin.tpl"} {else} {include
file="views/_partial/dashboardUser.tpl"} {/if}
<div class="col-md-10">
  <form action="" method="post" enctype="multipart/form-data">
    <div class="row justify-content-center my-5 text-center">
      <h3 class="my-5">Ajout de l'image dans le caroussel</h3>
      {include file='views/_partial/messages.tpl'} {*Modification des photos de
      l'animal*}
      <div class="col-md-3 my-4">
        <label><h5>Photo Animal du caroussel</h5></label>

        <input
          class="form-control"
          name="image"
          id="file"
          type="file"
          value=""
        />

        <div class="my-5 text-center">
          <button class="btn btn-success btn-lg mx-2" type="submit">
            Sauvegarder les modifications
          </button>
        </div>
      </div>
    </div>
    <h2 class="my-5">Modifier/Supprimer les images du caroussel</h2>

    <div class="row">
      {foreach $arrPicture as $objPicture}

      <div class="col text-center">
        <img
          src="assets/images/animal/gallery/{$objPicture->getPic_picture()}"
          class="d-block w-100"
          alt="{$objPicture->getPic_picture()}"
        />

        <a
          href="index.php?ctrl=animal&action=delete_picture_caroussel_admin&id={$objPicture->getPic_id()}"
          class="btn btn-inscription btn-lg mx-2 my-3"
          onclick=""
          >Supprimer</a
        >
      </div>
      {/foreach}
    </div>
  </form>
</div>
{/block}
