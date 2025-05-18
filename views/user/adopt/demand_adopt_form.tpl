{extends file="views/layout.tpl"}
{block name="content"}
<section class="" >
  <div class="container py-5 ">
    <div class="row d-flex justify-content-center align-items-center">
      <div class="col-xl-10">
        <div class="card rounded-3 text-black">
          <div class="row g-0">
            <div class="col-lg-6">
              <div class="card-body p-md-5 mx-md-4">
                <div class="text-center">
                  <img src="assets/images/logo.png"
                    style="width: 185px;" class="mx-auto" alt="logo">
                  <h4 class="mt-1 mb-5 pb-1">Formulaire a remplir pour l'adoption</h4>
                </div>
                {include file='views/_partial/messages.tpl'}

                <form method="post">
                  <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="name"></label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Votre nom " value="{*$objUserAdd->getName()*}"/>
                  </div>
                  
                  <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="email"></label>
                    <input type="text" id="email" name="email" class="form-control" placeholder="Votre E-mail" value="{*$objUserAdd->getEmail()*}" />
                  </div>
               
				          <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="animalName"></label>
                    <input type="text" id="animalName" name="animalName" class="form-control" placeholder="Le nom de l'animal concerné" value="{*$objUserAdd->getSurname()*}" />
                  </div>
                  {*
                  <div class="connectButton text-center pt-1 mb-5 pb-1">
                    <button  class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit">Envoyer</button>
                  </div>*}
                  
                </form>
              </div>
            </div>
            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
              <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                <h4 class="mb-4">Pour adopter sur notre plateforme  "Compagnon de Vie"</h4>
                <div class="small mb-0">
                      <h5>Les différentes étapes pour adopter un animal:</h3>
                        <p>Adopter un animal est une démarche qui nécessite plusieurs étapes afin de garantir son bien-être et de s’assurer que vous êtes prêt à l’accueillir dans les meilleures conditions. Voici les différentes phases du processus :</p>
                      <ul>
                          <li>Completer le formulaire </li>
                          <p>La première étape consiste à remplir un formulaire de demande d’adoption avec vos informations.</p>
                          <li>Réception et envoi d’un document complémentaire</li>
                          <p>Une fois votre formulaire reçu, nous vous enverrons un document supplémentaire à compléter, contenant des informations plus détaillées sur vos conditions d’accueil et votre expérience avec les animaux.</p>
                          <li> Retour du document complété</li>
                          <p>Après avoir rempli le document, vous devrez nous le retourner par e-mail afin que nous puissions l’examiner.</p>
                          <li>Suivi de votre demande</li>
                          <p>Vous pourrez suivre l’état d’avancement de votre demande directement depuis votre espace membre.</p>
                          <li>Analyse et décision finale</li>
                          <p>Après étude de votre dossier, nous vous informerons si votre demande d’adoption a été acceptée ou non.</p>
                      </ul>       
                      <p>Nous mettons tout en œuvre pour assurer le bien-être de nos animaux et veiller à leur placement dans un foyer adapté. Merci pour votre engagement !</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
{/block}