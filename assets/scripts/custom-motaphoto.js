// SOMMAIRE
////////////////////////////////////////////////////////////////////
// 01_Gestion du clic sur une liste déroulante personnalisée
// 02_Gestion de la sélection d'une option dans une liste déroulante
// 03_Gestion du clic en dehors des listes déroulantes pour désactiver l'état actif
////////////////////////////////////////////////////////////////////

jQuery(document).ready(function ($) {
  // Front-page
  // 01_Gestion du clic sur une liste déroulante personnalisée
  $(".placeholder_option").click(function (event) {
    $(this).parent().toggleClass("active");

    event.stopPropagation();
  });

  // 02_Gestion de la sélection d'une option dans une liste déroulante
  $(".options_items_list li").click(function (event) {
    let $this = $(this);
    let value = $this.data("value");

    if (value === "") {
      $(this).siblings().removeClass("selectedOption");
      let defaultText = "";

      let target = $this.closest(".options_items_list").data("target");
      switch (target) {
        case "category_filter":
          defaultText = "Catégories";
          break;
        case "format_filter":
          defaultText = "Formats";
          break;
        case "year_filter":
          defaultText = "Trier par";
          break;
      }

      $this
        .closest(".select_container")
        .find(".placeholder_option li")
        .html(defaultText);
    } else {
      $(this).siblings().removeClass("selectedOption");
      $(this).addClass("selectedOption");

      let currentElement = $(this).html();
      $(this)
        .closest(".select_container")
        .find(".placeholder_option li")
        .html(currentElement);
      $(this).closest(".select_container").removeClass("active");
    }
    event.stopPropagation();
  });

  // 03_Gestion du clic en dehors des listes déroulantes pour désactiver l'état actif
  $(document).click(function () {
    $(".select_container").removeClass("active");
  });
});
