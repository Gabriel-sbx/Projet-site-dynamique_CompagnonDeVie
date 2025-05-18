
{extends file="views/layout.tpl"}
{block name="content"}


{if $smarty.session.user->getType() != 'UC' }
    {include file="views/_partial/dashboardAdmin.tpl"}
{else}
    {include file="views/_partial/dashboardUser.tpl"}
{/if}
    <div class="col-md-8 ">
        <div class=" py-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="text-right">Créer un témoignages</h4>
            </div>
            {include file='views/_partial/messages.tpl'}
            <div class="row ">
                <form action="" method="post" enctype="multipart/form-data">
                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="title"><h5>Titre du témoignages</h5></label>
                        <input type="text" id="title" name="title" class="form-control" value="{$objTestify->getTitle()}" />
                    </div>
                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="description"><h5>Contenu du témoignages</h5></label>
                        <textarea  id="description" name="description" class="form-control" value="">{$objTestify->getDescription()}</textarea>
                    </div>
                    <!-- <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="idAnimal"><h5>Identifiant de l'animal</h5></label>
                        <input type="number" id="idAnimal" name="idAnimal"   />
                    </div> -->
                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="file"><h5>Image du témoignages</h5></label>
                        <img src="assets/images/testify/{$objTestify->getPicture()}" alt="">
                        <input type="file" id="file" name="image" class="form-control" value="{$objTestify->getPicture()}"/>
                    </div>
                    <div class="col-md-3">
                    <div class="connectButton text-center pt-1 mb-5 pb-1">
                        <button  class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit">Envoyer</button>
                    </div>
                </div>
                </form> 
            </div>
        </div>
    </div>
</section>
{/block}

