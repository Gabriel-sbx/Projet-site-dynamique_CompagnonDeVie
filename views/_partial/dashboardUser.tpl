
<section id="page-top " class="container-fluid">
    <!-- Page Wrapper -->
    <div id="wrapper" class="row">
        <div class="col-2">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php?ctrl=user&action=profil">
                <div class="sidebar-brand-icon rotate-n-15">
                </div>
                <div class="sidebar-brand-text mx-3">Espace membre</div>
            </a>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="#">
                    <span>Tableau de Bord</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">
           <!-- Parametre du compte -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProfil"
                    aria-expanded="true" aria-controls="collapseProfil">
                    <span>Mon Compte</span>
                </a>
                <div id="collapseProfil" class="collapse" aria-labelledby="headingProfil" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Paramètres du Compte :</h6>
                        <a class="collapse-item" href="index.php?ctrl=user&action=edit_profil">Modifier Profil</a>
                        <a class="collapse-item" href="index.php?ctrl=user&action=edit_password">Changer Mot de Passe</a>
                        <a class="collapse-item" href="index.php?ctrl=user&action=delete_profil">Supprimer le compte</a>
                    </div>
                </div>
            </li>
            <!-- Demandes d'Adoption -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAdopt"
                    aria-expanded="true" aria-controls="collapseAdopt">
                    <span>Demandes d'Adoption</span>
                </a>
                <div id="collapseAdopt" class="collapse" aria-labelledby="headingAdopt"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Status des Demandes :</h6>
                        <a class="collapse-item" href="index.php?ctrl=adopt&action=demand_adopt_progress">Demandes en Cours</a>
                        <a class="collapse-item" href="index.php?ctrl=adopt&action=demand_adopt_accept">Demandes Approuvées</a>
                        <a class="collapse-item" href="index.php?ctrl=adopt&action=demand_adopt_refuse">Demandes Refusées</a>
                        {*<a class="collapse-item" href="index.php?ctrl=adopt&action=demand_adopt_create">Nouvelle Demande</a>*}
                    </div>
                </div>
            </li>
            <!--Témoignages -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTestify"
                    aria-expanded="true" aria-controls="collapseTestify">
                    <span>Témoignages</span>
                </a>
                <div id="collapseTestify" class="collapse" aria-labelledby="headingTestify" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Vos Témoignages :</h6>
                        <a class="collapse-item" href="index.php?ctrl=testify&action=list_testify_profil">Mes Témoignages</a>
                        <a class="collapse-item" href="index.php?ctrl=testify&action=add_testify_profil">Ajouter un Témoignage</a>
                    </div>
                </div>
            </li>
             <!--Evenement 
             <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEvent"
                    aria-expanded="true" aria-controls="collapseEvent">
                    <span>Evenements</span>
                </a>

                <div id="collapseEvent" class="collapse" aria-labelledby="headingEvent" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header"> Participation :</h6>
                        <a class="collapse-item" href="login.html">Mes participation </a>
                        <a class="collapse-item" href="register.html">Se désinscrire</a>
                    </div>
                </div>
            </li>-->
            <!-- Favoris-->
            <li class="nav-item">
                <a class="nav-link" href="index.php?ctrl=favorite&action=list_favorite">
                    <span>Mes favoris</span>
                </a>
            </li>

            {if $strPage == "home_profil"}
                    <hr class="sidebar-divider d-none d-md-block">
                <div class="py-5">
                    <div class="row mb-3 justify-content-center text-center nav-item  text-white">
                        <div class="col-md-11  font-weight-bold ">Nombre de favoris :</div>
                        <div class="col-md-10 ">{$objUserFavorite->getCount_favorite()}</div>
                    </div>
                    <div class="row mb-3 justify-content-center text-center nav-item text-white">
                        <div class="col-md-11  font-weight-bold">Nombre d'adoptions en cours de validation:</div>
                        <div class="col-md-10 text-center">{$objUserAdopt->getCount_adopt()}</div>
                    </div>
                    {*
                    <div class="row mb-3  justify-content-center text-center nav-item text-white">
                        <div class="col-md-11 font-weight-bold">Nombre de participations à des événements :</div>
                        <div class="col-md-10 text-center">A faire (event)</div>
                    </div>
                    *}
                    <div class="row mb-3 justify-content-center text-center nav-item text-white">
                        <div class="col-md-11 font-weight-bold">Nombre de témoignages :</div>
                        <div class="col-md-10 text-center">{$objUserTestify->getCount_testify()}</div>
                    </div>
                </div>
            {/if}
        </ul>
    </div>