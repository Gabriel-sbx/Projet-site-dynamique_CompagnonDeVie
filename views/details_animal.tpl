{extends file="views/layout.tpl"} {block name="content"}
<div class="container">
  <div class="row my-4">
    <div class="col">
      <h1 class="text-center">Fiche détaillée de l'animal</h1>
    </div>
  </div>
  <div class="row">
    <!-- Carrousel des photos -->
    <div class="col-md-5 my-4">
      <div
        id="carouselExampleIndicators"
        class="carousel slide"
        data-bs-ride="carousel"
      >
        <div class="carousel-inner">
          {foreach $arrPicture as $keys => $objPicture}
          <div class="carousel-item {$keys === 0 ? 'active' : ''}">
            <img
              src="assets/images/animal/gallery/{$objPicture->getPic_picture()}"
              class="d-block w-100"
              alt="{$objPicture->getPic_picture()}"
            />
          </div>
          {/foreach}
        </div>
        <button
          class="carousel-control-prev"
          type="button"
          data-bs-target="#carouselExampleIndicators"
          data-bs-slide="prev"
        >
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button
          class="carousel-control-next"
          type="button"
          data-bs-target="#carouselExampleIndicators"
          data-bs-slide="next"
        >
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
    <div class="col-md-1 my-4"></div>

    <!-- Informations sur l'animal -->

    <div class="col-md-6 my-4">
      <h2>Nom : {$objAnimals->getName()}</h2>
      <p>Refuge : {$objAnimals->getRefuge_name()}</p>
      <p>Race : {$objAnimals->getBreed_name()}</p>
      <p>Espèce : {$objAnimals->getSpec_name()}</p>
      <p>Date de naissance : {$objAnimals->getDate_birth()}</p>
      <p>Catégorie : {$objAnimals->getCat_name()}</p>
      <p>Caractéristiques : {$objAnimals->getBreed_characteristics()}</p>

      <a
        href="index.php?ctrl=adopt&action=demand_adopt_form"
        class="btn btn-inscription mb-5 btn-lg mx-2 mt-5"
        type="submit"
        >Adoptez-moi</a
      >
    </div>
  </div>

  <div class="row my-5">
    <div class="col">
      <h3>Description</h3>
      <p class="mt-3">{$objAnimals->getDescription()}</p>
    </div>
  </div>
</div>
{/block}
