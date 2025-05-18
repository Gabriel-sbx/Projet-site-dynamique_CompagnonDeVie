{extends file="views/layout.tpl"} {block name="content"}
<div class="container">
  <div class="row">
    <h1 class="text-center">Error 403</h1>

    <div class="col-md-6">
      <img
        class=""
        src="assets/images/error/error403.webp"
        style="width: 500px; height: 500px"
        alt="Image erreur 404"
      />
    </div>

    <!-- Afficher les info des refuge ici  -->
    <div class="col-md-6 m-auto">
      <h2>Accès interdit</h2>
      <p>
        Désolé, vous n'avez pas les droits nécessaires pour accéder à cette
        page.
      </p>
      <p>
        Vous pouvez retourner à
        <a class="btn btn-inscription btn-lg mx-2" href="index.php?ctrl=animal&action=home">la page d'accueil</a>.
      </p>
    </div>
  </div>
</div>

{/block}
