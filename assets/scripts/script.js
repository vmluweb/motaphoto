jQuery(document).ready(function ($) {
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
  $("#popup_link").click(function (e) {
    e.preventDefault(); // Empêcher le comportement par défaut du lien
    openPopup();
  });

  // Lorsque vous cliquez sur l'overlay
  $(".popup_overlay").click(function () {
    closePopup();
  });
});
