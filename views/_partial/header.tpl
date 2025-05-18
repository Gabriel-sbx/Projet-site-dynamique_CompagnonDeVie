
<!DOCTYPE html>
<html lang="fr"data-bs-theme="auto">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compagnon de Vie - Refuge</title>    
    <link href="assets/css/dashboard/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="assets/dist/css/bootstrap.min.css">    
    <link rel="stylesheet" href="assets/css/style.css">     

    
</head>
<body> 
    <header class="container-fluid px-5 py-3">
                <div class="logo">
                    <a href="index.php?ctrl=animal&action=home">
                        <img src="assets/images/logo.png" alt="Logo Compagnon de Vie">
                    </a>
                </div> 
                {include file="views/_partial/nav.tpl"}
                <div class="user-actions">
                    {if count($smarty.session) > 0 
                        && isset($smarty.session.user) 
                        && $smarty.session.user->getId() != "" }
                    <div class="alert alert-success" role="alert">
                        Bonjour <strong>{$smarty.session.user->getPseudo()}</strong> ! Vous êtes connecté 
                         ( <strong>
                            {if $smarty.session.user->getType() =="UC"} Utilisateur {/if}
                            {if $smarty.session.user->getType() =="MOD"} Modérateur {/if}    
                            {if $smarty.session.user->getType() =="ADM"} Administrateur {/if}   
                        </strong>)
                    </div>
                    <div>
                        <div>
                            <a href="index.php?ctrl=user&action=profil" class="btn btn-success btn-lg mx-2 ">Espace membre</a>
                            <a href="index.php?ctrl=user&action=logout" class="btn btn-inscription btn-lg mx-2">Déconnexion</a>
                            {else} 
                            <a href="index.php?ctrl=user&action=login" class="btn btn-success btn-lg mx-2">Connexion</a>
                            <a href="index.php?ctrl=user&action=signup" class="btn btn-inscription btn-lg mx-2">Inscription</a>
                            {/if} 
                        </div>
                    </div>
                </div>      
    </header>
    <main class="container-fluid">