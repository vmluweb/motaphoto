jQuery(document).ready(function ($) {
  // Gestion de l'ouverture et de la fermeture d'une liste
  $(".placeholder_option").click(function () {
    $(this).parent().toggleClass("active");
  });

  // Gestion de la sélection d'un élément dans une liste
  $(".options_items_list li").click(function () {
    $(this).siblings().removeClass("selectedOption");
    $(this).addClass("selectedOption");

    let currentele = $(this).html();
    $(this)
      .closest(".select_container")
      .find(".placeholder_option li")
      .html(currentele);
    $(this).closest(".select_container").removeClass("active");
  });
});
