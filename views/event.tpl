

{extends file="views/layout.tpl"}
{block name="content"}
    <section class=" d-flex align-items-center hero-event ">
        <div class="container ">
            <div class="row">
                <div class="col-md-8 col-lg-6">
                    <h1 class="display-4 ">Nos Événements</h1>
                    <p class="lead ">Découvrez nos prochains événements et rejoignez-nous pour soutenir notre cause.</p>
                    <a href="#evenements-list" class="btn btn-success btn-lg s">Voir les événements</a>
                </div>
            </div>
        </div>
    </section>

    <section id="evenements-list" class="py-5">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-12">
                    <h2>Nos Prochains Événements</h2>
                </div>
            </div>
            <div class="row" id="events-container">
                <!-- Zone pour les cartes d'événements -->
                {foreach $arrEvent as $objEvent }
                {include file="views/_partial/cardEvent.tpl"}

                {/foreach}
                
            </div>
        </div>
    </section>
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row text-center">
                <div class="col-12">
                    <h2>Organisez un Événement</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                    <p class="lead">Vous souhaitez organiser un événement pour soutenir notre cause ?</p>
                    <div class="mt-4">
                        <a href="index.php?ctrl=page&action=contact" class="btn btn-success btn-lg mx-2">Nous contacter</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {/block}
