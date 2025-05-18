

<section id="page-top " class="container-fluid">
    <!-- Page Wrapper -->
    <div id="wrapper" class="row">
        <div class="col-md-2">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php?ctrl=user&action=profil">
                <div class="sidebar-brand-icon rotate-n-15">
                </div>
                <div class="sidebar-brand-text mx-3">Espace Administration</div>
            </a>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="#">
                    <span>Tableau de Bord</span>
                </a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">
           
           <!-- Parametre du compte -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUser"
                    aria-expanded="true" aria-controls="collapseUser">
                    <span>Gestions Utilisateurs </span>
                </a>
                <div id="collapseUser" class="collapse" aria-labelledby="headingUser" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Actions :</h6>
                        <a class="collapse-item" href="index.php?ctrl=user&action=list_user_admin">Liste des utilisateurs</a>
                        <a class="collapse-item" href="index.php?ctrl=user&action=add_user_admin">Ajouter utilisateur</a>
                    </div>
                </div>
            </li>
             <!-- Gestion des animaux -->
             <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAnimals"
                    aria-expanded="true" aria-controls="collapseAnimals">
                    <span>Gestions des Animaux</span>
                </a>
                <div id="collapseAnimals" class="collapse" aria-labelledby="headingAnimals" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Actions :</h6>
                        <a class="collapse-item" href="index.php?ctrl=animal&action=list_animal_admin">Liste des animaux</a>
                        <a class="collapse-item" href="index.php?ctrl=animal&action=add_animal_admin">Ajouter un animal</a>
                        {*<a class="collapse-item" href="#">Archives</a>*}
                    </div>
                </div>
            </li>
            <!-- Demandes d'Adoption -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAdopt"
                    aria-expanded="true" aria-controls="collapseAdopt">
                    <span>Gestions adoption</span>
                </a>
                <div id="collapseAdopt" class="collapse" aria-labelledby="headingAdopt"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Demandes:</h6>

                        <a class="collapse-item" href="index.php?ctrl=adopt&action=demand_adopt_progress_admin">Demandes en Cours</a>
                        <a class="collapse-item" href="index.php?ctrl=adopt&action=demand_adopt_accept_admin">Demandes Approuvées</a>
                        <a class="collapse-item" href="index.php?ctrl=adopt&action=demand_adopt_refuse_admin">Demandes Refusées</a>

                    </div>
                </div>
            </li>
            <!--Témoignages -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTestify"
                    aria-expanded="true" aria-controls="collapseTestify">
                    <span>Gestions Témoignages</span>
                </a>
                <div id="collapseTestify" class="collapse" aria-labelledby="headingTestify" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Actions :</h6>
                        <a class="collapse-item" href="index.php?ctrl=testify&action=list_testify_validating_admin">Témoignages a valider</a>
                        <a class="collapse-item" href="index.php?ctrl=testify&action=list_testify_admin">Tous les témoignages</a>
                        <a class="collapse-item" href="index.php?ctrl=testify&action=list_testify_archives_admin">Archives</a>

                    </div>
                </div>
            </li>
             
             <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEvent"
                    aria-expanded="true" aria-controls="collapseEvent">
                    <span>Gestions Evenements</span>
                </a>
                <div id="collapseEvent" class="collapse" aria-labelledby="headingEvent" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Actions :</h6>                        
                        <a class="collapse-item" href="index.php?ctrl=event&action=list_event_admin">Liste des événements</a>
                        <a class="collapse-item" href="index.php?ctrl=event&action=add_event_admin">Créer un événement </a>
                    </div>
                </div>
            </li>
            {if $smarty.session.user->getType() == 'ADM' }
             <!--Admin seulemnt -->
             <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAdmin"
                    aria-expanded="true" aria-controls="collapseAdmin">
                    <span>Gestions Administrateur</span>
                </a>
                <div id="collapseAdmin" class="collapse" aria-labelledby="headingAdmin" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Journal de connexion :</h6>
                        <a class="collapse-item" href="index.php?ctrl=log&action=list_log_week_admin">Voir les connexions </a>
                        <a class="collapse-item" href="index.php?ctrl=log&action=list_log_history_admin">Historique</a>
                    </div>
                </div>
            </li>
            {/if}
             <!--Mon compte -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProfil"
                    aria-expanded="true" aria-controls="collapseProfil">
                    <span>Mon compte</span>
                </a>
                <div id="collapseProfil" class="collapse" aria-labelledby="headingProfil" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Actions :</h6>
                        <a class="collapse-item" href="index.php?ctrl=user&action=edit_profil">Modifier mes informations</a>
                        <a class="collapse-item" href="index.php?ctrl=user&action=edit_password">Modifier mot de passe</a>
                        <a class="collapse-item" href="index.php?ctrl=user&action=delete_profil">Supprimer mon compte</a>

                    </div>
                </div>
            </li>
            <!--Statistique du site  -->
            {if $strPage == "home_profil"}
                    <hr class="sidebar-divider d-none d-md-block">
                <div class="py-5">
                    <div class="row mb-3 justify-content-center text-center nav-item  text-white">
                        <div class="col-md-11  font-weight-bold ">Total des Utilisateurs :</div>
                        <div class="col-md-10 ">{$objUserCount->getCount_user()}</div>
                    </div>
                    <div class="row mb-3 justify-content-center text-center nav-item text-white">
                        <div class="col-md-11  font-weight-bold">Adoptions en cours :</div>
                        <div class="col-md-10 text-center">{$objAdoptCount->getCount_adopt()}</div>
                    </div>
                    {*
                        <div class="row mb-3  justify-content-center text-center nav-item text-white">
                            <div class="col-md-11 font-weight-bold">Evenements actifs :</div>
                            <div class="col-md-10 text-center"><?php ?></div>
                        </div>
                    *}
                    <div class="row mb-3 justify-content-center text-center nav-item text-white">
                        <div class="col-md-11 font-weight-bold">Témoignages à valider :</div>
                        <div class="col-md-10 text-center">{$objCountTestify->getCount_testify()}</div>
                    </div>
                </div>
            {/if}
        </ul>
    </div>