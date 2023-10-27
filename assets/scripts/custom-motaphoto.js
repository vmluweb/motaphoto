jQuery(document).ready(function ($) {
  // Gestion de l'ouverture et de la fermeture d'une liste
  $(".placeholder_option").click(function (event) {
    $(this).parent().toggleClass("active");

    event.stopPropagation();
  });

  // Gestion d'une sélection dans une liste
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

  $(document).click(function () {
    $(".select_container").removeClass("active");
  });
});
