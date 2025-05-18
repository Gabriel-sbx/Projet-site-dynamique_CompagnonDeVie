{extends file="views/layout.tpl"} {block name="content"}
<!-- Contenu spécifique de la page d'accueil -->
<section class="d-flex align-items-center hero-section">
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-lg-6">
        <h1 class="display-4">Bienvenue sur Compagnon de vie</h1>
        <p class="lead">
          Pour une adoption responsable, trouvez votre futur compagnon parmi nos
          refuges en Alsace.
        </p>
        <a
          href="index.php?ctrl=animal&action=list_animal"
          class="btn btn-success btn-lg s"
          >Découvrir nos animaux</a
        >
      </div>
    </div>
  </div>
</section>
<section class="py-5">
  <div class="container">
    <div class="row text-center mb-5">
      <div class="col-12">
        <h2>Nos missions</h2>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4 mb-4">
        <div class="card h-100">
          <div class="card-body text-center">
            <i class="fas fa-heart fa-3x text-primary mb-3"></i>
            <h3>Protection</h3>
            <p>
              Notre refuge accueille et prend soin des animaux abandonnés dans
              nos quatre centres en Alsace.
            </p>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="card h-100">
          <div class="card-body text-center">
            <i class="fas fa-home text-primary mb-3"></i>
            <h3>Adoption</h3>
            <p>
              Notre équipe vous accompagne dans votre démarche d'adoption pour
              trouver le compagnon idéal.
            </p>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="card h-100">
          <div class="card-body text-center">
            <i class="fas fa-hands-helping text-primary mb-3"></i>
            <h3>Bénévolat</h3>
            <p>
              Participez à nos événements et devenez bénévole pour nous aider à
              prendre soin de nos pensionnaires.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section id="adoptions" class="py-5 bg-light">
  <div class="container">
    <div class="row text-center mb-5">
      <div class="col-12">
        <h2>Nos derniers arrivants</h2>
      </div>
    </div>
    <div class="row" id="animals-container">
      {foreach from=$arrAnimals item=objAnimals} {include
      file="views/_partial/cardAnimal.tpl"} {/foreach}
    </div>
  </div>
</section>
<section class="py-5">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-12">
                <h2>Nos prochains événements</h2>
            </div>
        </div>
        <div class="row" id="events-container">

        {foreach from=$arrEventAll item=objEvent}
		
            {include file="views/_partial/cardEvent.tpl"}
                   
        {/foreach}

        </div>
    </div>
  </div>
</section>
<section class="py-5 bg-light">
  <div class="container">
    <div class="row text-center">
      <div class="col-12">
        <h2>Rejoignez-nous !</h2>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-8 text-center">
        <p class="lead">
          Vous souhaitez adopter un animal ou devenir bénévole ?
        </p>
        <div class="mt-4">
          <a
            href="index.php?ctrl=user&action=signup"
            class="btn btn-success btn-lg mx-2"
            >Créer un compte</a
          >
          <a
            href="index.php?ctrl=user&action=login"
            class="btn btn-outline-success btn-lg mx-2"
            >Se connecter</a
          >
        </div>
      </div>
    </div>
  </div>
</section>
{/block}
