{extends file="views/layout.tpl"}
{block name="content"}
<section class="py-5">
   <div class="container">
       <div class="text-center mb-5">
           <h2>Nos récentes réussites d'adoption</h2>
           <p class="text-muted">Découvrez les belles histoires de nos adoptants</p>

           {if !isset($smarty.session.user)}
           <a href="index.php?ctrl=user&action=login" class="btn btn-success mt-3">
           
           
           {else}
            <a href="index.php?ctrl=testify&action=add_testify_profil" class="btn btn-success mt-3">

           {/if} 
             
            <i class="fas fa-plus me-2"></i>Ajouter un témoignage
           </a>
       </div>
       <!-- <div class="card mb-4">
           <div class="card-header bg-light">
               <div class="row align-items-center">
                   <div class="col">
                       <strong>Trier par date:</strong>
                   </div>
                  <form action="" method="post">
                    <div class="col-auto">
                        <select class="form-select form-select-sm">
                            <option name="" value="ASC" >Plus récent</option>
                            <option name="" value="DESC">Plus ancien</option>
                        </select>
                    </div>
                    <button class="btn btn-success btn-lg mx-2" type="submit">Rechercher</button>                  
                </form>
               </div>
           </div>
       </div> -->
       <div class="row g-4">
        {foreach $arrTestify as $objTestify}
            <div class="col-6">
                <div class="card success-sm h-100">
                    <div class="card-body d-flex flex-column">
                        <div class="row h-100">
                            <div class="col-6 d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="card-title mb-0">{$objTestify->getTitle()}</h5>
                                </div>
                                <p class="card-text">{$objTestify->getDescription()}</p>
                                
                                <!-- Cette div sera poussée en bas -->
                                <div class="text-muted mt-auto">
                                    <small>Publié le {$objTestify->getDate_crea()} Par {$objTestify->getUser_pseudo()}</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <img src="assets/images/testify/{$objTestify->getPicture()}" 
                                     class="img-fluid rounded mb-3" 
                                     alt="Photo témoignage">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        {/foreach}
    
   </div>
</section>



{/block}