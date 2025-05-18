function toggleDisplayPassword(event) {

    /* La source de l'événement */
    const srcElement = event.srcElement;

    /* Récupère l'élément enfant qui précède l'élément source */
    const passwordField = srcElement.previousElementSibling;

    /* Si le champ est de type "mot de passe" */
    if (passwordField.type == "password") {

        /* Interversion des icônes */
        srcElement.classList.remove("bi-eye");
        srcElement.classList.add("bi-eye-slash");

        /* Affiche le texte en clair */
        passwordField.type = "text";

    } else if (passwordField.type == "text") {

        /* Interversion des icônes */
        srcElement.classList.remove("bi-eye-slash");
        srcElement.classList.add("bi-eye");

        /* Cache le texte du mot de passe */
        passwordField.type = "password";
    }

}