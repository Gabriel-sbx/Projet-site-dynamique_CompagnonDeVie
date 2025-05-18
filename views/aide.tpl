{extends file="views/layout.tpl"} {block name="content"}
<section class="container my-5">
  {if $smarty.session.user->getType() == 'UC' }
  <div class="col-12">
    <div class="card shadow-sm">
      <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Aide & Support</h5>
      </div>
      <div class="card-body">
        <div class="accordion" id="helpAccordion">
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button
                class="accordion-button"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#faqSection"
              >
                Questions Fréquentes
              </button>
            </h2>
            <div
              id="faqSection"
              class="accordion-collapse collapse show"
              data-bs-parent="#helpAccordion"
            >
              <div class="accordion-body">
                <div class="mb-4">
                  <h6 class="fw-bold">Comment créer un compte ?</h6>
                  <p>
                    Cliquez sur le bouton "Créer un compte" en haut de la page
                    et suivez les instructions.
                  </p>
                </div>
                <div class="mb-4">
                  <h6 class="fw-bold">Comment modifier mon profil ?</h6>
                  <p>
                    Accédez à votre espace membre et cliquez sur "Modifier le
                    profil".
                  </p>
                </div>
                <div class="mb-4">
                  <h6 class="fw-bold">Comment modifier mon mot de passe ?</h6>
                  <p>
                    Accédez à votre espace membre et cliquez sur "Modifier le
                    mot de passe".
                  </p>
                </div>
                <div class="mb-4">
                  <h6 class="fw-bold">Comment supprimer mon compte ?</h6>
                  <p>
                    Accédez à votre espace membre et cliquez sur "Supprimez le
                    compte".
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button
                class="accordion-button collapsed"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#contactSection"
              >
                Nous Contacter
              </button>
            </h2>
            <div
              id="contactSection"
              class="accordion-collapse collapse"
              data-bs-parent="#helpAccordion"
            >
              <div class="accordion-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="d-flex align-items-center mb-3">
                      <i class="bi bi-envelope-fill me-2"></i>
                      <span>support@refugeanimaux.com</span>
                    </div>
                    <div class="d-flex align-items-center">
                      <i class="bi bi-telephone-fill me-2"></i>
                      <span>01 23 45 67 89</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  {/if} {if $smarty.session.user->getType() == 'MOD' }
  <div class="col-12">
    <div class="card shadow-sm">
      <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Guide du Modérateur</h5>
      </div>
      <div class="card-body">
        <div class="accordion" id="helpAccordion">
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button
                class="accordion-button"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#faqSection"
              >
                Gestion des Utilisateurs
              </button>
            </h2>
            <div
              id="faqSection"
              class="accordion-collapse collapse show"
              data-bs-parent="#helpAccordion"
            >
              <div class="accordion-body">
                <div class="mb-4">
                  <h6 class="fw-bold">
                    Comment gérer la liste des utilisateurs ?
                  </h6>
                  <p>
                    Accédez à "Gestions Utilisateurs" dans le menu pour voir
                    tous les utilisateurs et modifier leurs informations.
                  </p>
                </div>
                <div class="mb-4">
                  <h6 class="fw-bold">Comment ajoutez un utilisateur ?</h6>
                  <p>
                    Accédez à "Gestions Utilisateurs" dans le menu pour ajoutez
                    un utilisateur remplissez le formulaire avec les
                    informations nécessaires. .
                  </p>
                </div>
              </div>
            </div>
          </div>

          <div class="accordion-item">
            <h2 class="accordion-header">
              <button
                class="accordion-button collapsed"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#animalsSection"
              >
                Gestion des Animaux
              </button>
            </h2>
            <div
              id="animalsSection"
              class="accordion-collapse collapse"
              data-bs-parent="#helpAccordion"
            >
              <div class="accordion-body">
                <div class="mb-4">
                  <h6 class="fw-bold">Comment ajouter un animal ?</h6>
                  <p>
                    Utilisez le bouton "Ajouter un animal" et remplissez le
                    formulaire avec les informations nécessaires.
                  </p>
                </div>
                <div class="mb-4">
                  <h6 class="fw-bold">Comment gérer les fiches existantes ?</h6>
                  <p>
                    Dans la liste des animaux, utilisez les boutons "Modifier"
                    ou "Supprimer" selon vos besoins.
                  </p>
                </div>
              </div>
            </div>
          </div>

          <div class="accordion-item">
            <h2 class="accordion-header">
              <button
                class="accordion-button collapsed"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#testimonialSection"
              >
                Gestion des Témoignages
              </button>
            </h2>
            <div
              id="testimonialSection"
              class="accordion-collapse collapse"
              data-bs-parent="#helpAccordion"
            >
              <div class="accordion-body">
                <div class="mb-4">
                  <h6 class="fw-bold">Comment valider un témoignage ?</h6>
                  <p>
                    Accédez à la section "Témoignages à valider" et utilisez le
                    bouton "Valider" ou "Refuser".
                  </p>
                </div>
                <div class="mb-4">
                  <h6 class="fw-bold">Comment modérer les commentaires ?</h6>
                  <p>
                    Surveillez régulièrement les témoignages publiés et utilisez
                    les outils de modération si nécessaire.
                  </p>
                </div>
              </div>
            </div>
          </div>

          <div class="accordion-item">
            <h2 class="accordion-header">
              <button
                class="accordion-button collapsed"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#contactSection"
              >
                Nous Contacter
              </button>
            </h2>
            <div
              id="contactSection"
              class="accordion-collapse collapse"
              data-bs-parent="#helpAccordion"
            >
              <div class="accordion-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="d-flex align-items-center mb-3">
                      <i class="bi bi-envelope-fill me-2"></i>
                      <span>support@refugeanimaux.com</span>
                    </div>
                    <div class="d-flex align-items-center">
                      <i class="bi bi-telephone-fill me-2"></i>
                      <span>00 23 45 67 89</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {/if} {if $smarty.session.user->getType() == 'ADM' }
  <div class="col-12">
    <div class="card shadow-sm">
      <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Guide de l'Administrateur</h5>
      </div>
      <div class="card-body">
        <div class="accordion" id="adminHelpAccordion">
          <!-- Gestion des Utilisateurs Section -->
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button
                class="accordion-button"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#userManagementSection"
              >
                Gestion des Utilisateurs
              </button>
            </h2>
            <div
              id="userManagementSection"
              class="accordion-collapse collapse show"
              data-bs-parent="#adminHelpAccordion"
            >
              <div class="accordion-body">
                <div class="mb-4">
                  <h6 class="fw-bold">Comment gérer les utilisateurs ?</h6>
                  <p>Dans la section "Gestions Utilisateurs", vous pouvez :</p>
                  <ul>
                    <li>Voir la liste complète des utilisateurs</li>
                    <li>Modifier les informations des utilisateurs</li>
                    <li>
                      Changer les rôles (Utilisateur, Modérateur,
                      Administrateur)
                    </li>
                    <li>Désactiver ou supprimer des comptes</li>
                  </ul>
                </div>
                <div class="mb-4">
                  <h6 class="fw-bold">Comment gérer les modérateurs ?</h6>
                  <p>En tant qu'administrateur, vous pouvez :</p>
                  <ul>
                    <li>Promouvoir un utilisateur au rang de modérateur</li>
                    <li>Superviser les actions des modérateurs</li>
                    <li>Révoquer les privilèges de modération si nécessaire</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>

          <!-- Gestion des Animaux Section -->
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button
                class="accordion-button collapsed"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#animalManagementSection"
              >
                Gestion des Animaux
              </button>
            </h2>
            <div
              id="animalManagementSection"
              class="accordion-collapse collapse"
              data-bs-parent="#adminHelpAccordion"
            >
              <div class="accordion-body">
                <div class="mb-4">
                  <h6 class="fw-bold">Gestion du catalogue d'animaux</h6>
                  <p>
                    Vous avez accès à toutes les fonctionnalités de gestion :
                  </p>
                  <ul>
                    <li>Ajouter, modifier et supprimer des fiches d'animaux</li>
                    <li>Gérer les catégories et races d'animaux</li>
                    <li>
                      Valider les modifications proposées par les modérateurs
                    </li>
                    <li>Gérer les statuts d'adoption</li>
                  </ul>
                </div>
                <div class="mb-4">
                  <h6 class="fw-bold">Gestion des photos</h6>
                  <p>Pour la gestion des médias :</p>
                  <ul>
                    <li>Valider les photos uploadées</li>
                    <li>Gérer la galerie photos</li>
                    <li>Définir les photos principales des fiches</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>

          <!-- Gestion du Site Section -->
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button
                class="accordion-button collapsed"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#siteManagementSection"
              >
                Gestion du Site
              </button>
            </h2>
            <div
              id="siteManagementSection"
              class="accordion-collapse collapse"
              data-bs-parent="#adminHelpAccordion"
            >
              <div class="accordion-body">
                <div class="mb-4">
                  <h6 class="fw-bold">Paramètres généraux</h6>
                  <p>Configuration du site :</p>
                  <ul>
                    <li>Modifier les informations de contact</li>
                    <li>Gérer les paramètres de sécurité</li>
                    <li>Configurer les emails automatiques</li>
                    <li>Gérer les sauvegardes</li>
                  </ul>
                </div>
                <div class="mb-4">
                  <h6 class="fw-bold">Gestion des contenus</h6>
                  <p>Vous pouvez gérer :</p>
                  <ul>
                    <li>Les pages statiques du site</li>
                    <li>Les actualités et événements</li>
                    <li>Les formulaires de contact</li>
                    <li>La FAQ</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>

          <!-- Support Technique Section -->
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button
                class="accordion-button collapsed"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#technicalSupportSection"
              >
                Support Technique
              </button>
            </h2>
            <div
              id="technicalSupportSection"
              class="accordion-collapse collapse"
              data-bs-parent="#adminHelpAccordion"
            >
              <div class="accordion-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="d-flex align-items-center mb-3">
                      <i class="bi bi-envelope-fill me-2"></i>
                      <span>admin-support@refugeanimaux.fr</span>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                      <i class="bi bi-telephone-fill me-2"></i>
                      <span>01 23 45 67 89 (Ligne dédiée administrateurs)</span>
                    </div>
                    <div class="d-flex align-items-center">
                      <i class="bi bi-shield-lock-fill me-2"></i>
                      <span>Support prioritaire 24/7</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
{/if} {/block}
