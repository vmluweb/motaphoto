jQuery(document).ready(function ($) {
  // Lightbox Fancybox
  // Personnalisation des flèches de navigation
  function updateFancyboxButtons() {
    let windowWidth = $(window).width();

    // Désactivation des flèches à partir de 968px
    if (windowWidth < 968) {
      $.fancybox.defaults.btnTpl.arrowLeft = "";
      $.fancybox.defaults.btnTpl.arrowRight = "";
    } else {
      $.fancybox.defaults.btnTpl.arrowLeft =
        '<a data-fancybox-prev class="fancybox-button fancybox-button--arrowLeft" title="Précédente"><span>Précédente</span></a>';
      $.fancybox.defaults.btnTpl.arrowRight =
        '<a data-fancybox-next class="fancybox-button fancybox-button--arrowRight" title="Suivante"><span>Suivante</span></a>';
    }
  }

  updateFancyboxButtons();

  // Redimensionnement de la fenêtre
  $(window).resize(function () {
    updateFancyboxButtons();
  });

  // Personnalisation de la barre d'outils
  $.fancybox.defaults.btnTpl.zoom = "";
  $.fancybox.defaults.btnTpl.slideShow = "";
  $.fancybox.defaults.btnTpl.thumbs = "";
  $.fancybox.defaults.loop = true;
  $.fancybox.defaults.infobar = false;
});
