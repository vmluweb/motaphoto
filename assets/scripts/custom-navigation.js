// SOMMAIRE
////////////////////////////////////////////////////////////////////
// 01_Gestion du menu burger
// 02_Gestion du filtrage des photos avec AJAX
// 03_Chargement dynamique des publications supplémentaires au clic sur le bouton "Charger plus"
// 04_Gestion de l'affichage des miniatures au survol des flèches de navigation précédente et suivante
////////////////////////////////////////////////////////////////////

jQuery(document).ready(function ($) {
  // 01_Gestion du menu burger
  const icons = document.querySelector("#icons");
  const navbar = document.querySelector(".main-navigation");

  icons.addEventListener("click", () => {
    navbar.classList.toggle("active");
  });

  // 02_Gestion du filtrage des publications avec AJAX
  let selectedCategory = null;
  let selectedFormat = null;
  let selectedYear = null;
  let currentPage = 1;

  // Filtrage des photos avec AJAX
  $(".option_items").on("click", function () {
    let $this = $(this);
    let value = $this.data("value");
    let $ul = $this.closest("ul");

    // Mise à jour de la sélection en fonction de la liste
    if ($ul.is("#category_filter .options_items_list")) {
      selectedCategory = value;
    } else if ($ul.is("#format_filter .options_items_list")) {
      selectedFormat = value;
    } else if ($ul.is("#year-filter .options_items_list")) {
      selectedYear = value;
    }

    $(".option_items").removeClass("selected");
    $this.addClass("selected");

    // Requête AJAX avec les sélections
    let data = {
      action: "filter_photos",
      categorie: selectedCategory,
      format: selectedFormat,
      year: selectedYear,
    };

    // Mise à jour dynamique de la galerie avec la réponse AJAX
    $.post(myAjax.ajaxurl, data, function (response) {
      $("#gallery_grid_homepage").html(response);
    });
  });

  // 03_Chargement dynamique des publications supplémentaires au clic sur le bouton "Charger plus"
  $("#load-more").on("click", function () {
    currentPage++;

    $.ajax({
      type: "POST",
      url: myAjax.ajaxurl,
      dataType: "json",
      data: {
        action: "load_more_post",
        paged: currentPage,
        categorie: selectedCategory,
        format: selectedFormat,
        year: selectedYear,
      },
      success: function (res) {
        if (currentPage >= res.max) {
          $("#load-more").hide();
        }
        $("#gallery_grid_homepage").append(res.html);
      },
    });
  });

  // Single-photos
  $(".post-thumbnail").hide();
  // 04_Gestion de l'affichage des miniatures au survol des flèches de navigation précédente et suivante
  $(".prev").hover(
    function () {
      $prevThumbnailURL = $(this).data("thumbnail-url");
      console.log($prevThumbnailURL);
      $(".post-thumbnail").attr("src", $prevThumbnailURL);
      $(".post-thumbnail").show();
    },
    function () {
      $(".post-thumbnail").hide();
    }
  );

  $(".next").hover(
    function () {
      $nextThumbnailURL = $(this).data("thumbnail-url");
      $(".post-thumbnail").attr("src", $nextThumbnailURL);
      $(".post-thumbnail").show();
    },
    function () {
      $(".post-thumbnail").hide();
    }
  );
});
