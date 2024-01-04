
// Votre fichier JavaScript

document.addEventListener('DOMContentLoaded', function () { // Écouteur d'événement pour le bouton "Ajouter un enfant"
    document.getElementById('add-child').addEventListener('click', function () { // Clônez le premier champ pour les enfants
        var firstChild = document.querySelector('.child-form');
        var clonedChild = firstChild.cloneNode(true);

        // Effacez les valeurs des champs clonés
        clonedChild.querySelectorAll('input').forEach(function (input) {
            input.value = '';
        });

        // Ajoutez le champ cloné au conteneur des enfants
        document.getElementById('children-container').appendChild(clonedChild);
    })
});

