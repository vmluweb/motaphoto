jQuery(document).ready(function ($) {
  // Lightbox Fancybox
  // Personnalisation des flèches de navigation
  $.fancybox.defaults.btnTpl.arrowLeft =
    '<a data-fancybox-prev class="fancybox-button fancybox-button--arrowLeft" title="Précédente"><span>Précédente</span></a>';

  $.fancybox.defaults.btnTpl.arrowRight =
    '<a data-fancybox-next class="fancybox-button fancybox-button--arrowRight" title="Suivante"><span>Suivante</span></a>';

  // Personnalisation de la barre d'outils
  $.fancybox.defaults.btnTpl.zoom = "";
  $.fancybox.defaults.btnTpl.slideShow = "";
  $.fancybox.defaults.btnTpl.thumbs = "";
  $.fancybox.defaults.loop = true;
  $.fancybox.defaults.infobar = false;
});
