jQuery(document).ready(function ($) {
  // Gestion de la modal
  console.log(".modal");
  // Fonction pour afficher la modal
  function openPopup() {
    $(".modal").fadeIn();
    $(".popup_overlay").fadeIn();
  }

  // Fonction pour fermer la modal
  function closePopup() {
    $(".modal").fadeOut();
    $(".popup_overlay").fadeOut();
  }

  // Lorsque vous cliquez sur le bouton #popup_link
  $(".popup_link").click(function (e) {
    e.preventDefault(); // Empêcher le comportement par défaut du lien
    openPopup();
  });

  // Lorsque vous cliquez sur l'overlay
  $(".popup_overlay").click(function () {
    closePopup();
  });

  // Gestion des images au survol des flèches
  // Sélection des éléments flèches et du div pour l'aperçu
  const $previousLink = $(".left a");
  const $nextLink = $(".right a");
  const $previousImage = $(".preview.prev_thumbnail");
  const $nextImage = $(".preview.next_thumbnail");

  // Affichage du thumbnail du post précédent
  function showPreviousThumbnail() {
    $previousImage.show();
    $nextImage.hide();
  }

  // Affichage du thumbnail du post suivant
  function showNextThumbnail() {
    $nextImage.show();
    $previousImage.hide();
  }

  // Affichage du thumbnail du post précédent au survol
  $previousLink.hover(function () {
    showPreviousThumbnail();
  });

  // Affichage du thumbnail du post suivant au survol
  $nextLink.hover(function () {
    showNextThumbnail();
  });
});
