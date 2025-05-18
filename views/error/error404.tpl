{extends file="views/layout.tpl"} {block name="content"}
<div class="container">
  <div class="row">
    <h1 class="text-center">Error 404</h1>

    <div class="col-md-6">
      <img
        class=""
        src="assets/images/error/error404.jpg"
        style="width: 500px; height: 500px"
        alt="Image erreur 404"
      />
    </div>

    <!-- Afficher les info des refuge ici  -->
    <div class="col-md-6 m-auto">
      <h2>Page non trouvée</h2>
      <p>Désolé, la page que vous recherchez n'existe pas.</p>
      <p>
        Vous pouvez retourner à
        <a class="btn btn-inscription btn-lg mx-2" href="index.php?ctrl=animal&action=home">la page d'accueil</a>.
      </p>
    </div>
  </div>
</div>

{/block}
