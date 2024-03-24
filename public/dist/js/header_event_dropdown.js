// Sélection de la balise ul
const ulElement = document.querySelector('ul#header_dropdown_sm');

// Fonction pour remplacer le contenu de ul par le code HTML fourni
function replaceWithDropdown() {
    if (document.querySelector('div#header_dropdown_sm')) {
        return; // Sortir de la fonction si le dropdown existe déjà
    }

    // Création de l'élément div avec la classe "dropdown"
    const dropdownDiv = document.createElement('div');
    dropdownDiv.id = 'header_dropdown_sm';

    dropdownDiv.classList.add('dropdown', 'mr-3', 'dropleft');

    // Ajout du code HTML à l'élément div
    dropdownDiv.innerHTML = `
        <button class="btn btn-secondary " type="button" data-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-ellipsis-vertical"></i>
        </button>
        <div class="dropdown-menu">
            <button class="btn btn-primary dropdown-item" data-toggle="modal" data-target="#update_event" style="font-size: 14px;">
                <i class="nav-icon fa-regular fa-pen-to-square"></i>
                Modifier
            </button>
            <button class="btn btn-danger dropdown-item" data-toggle="modal" data-target="#delete_event" style="font-size: 14px;">
                <i class="nav-icon fa-solid fa-trash-can"></i>
                Sipprimer
            </button>
        </div>
    `;

    // Remplacement de la balise ul par l'élément div dans le DOM
    ulElement.parentNode.replaceChild(dropdownDiv, ulElement);
}

// Vérification de la largeur de l'écran au chargement de la page
if (window.innerWidth < 768) {
    replaceWithDropdown();
}

// Écoute de l'événement de redimensionnement de la fenêtre
window.addEventListener('resize', () => {
    if (window.innerWidth < 768) {
        replaceWithDropdown();
    } else {
        // Si la taille de l'écran est supérieure à 768 pixels, on restaure le contenu de la balise ul
        location.reload();
    }
});
