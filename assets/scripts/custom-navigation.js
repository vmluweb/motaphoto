jQuery(document).ready(function ($) {
  //SINGLE-PHOTO: Affichage de la featured image au survol des flèches de navigation
  $(".post-thumbnail").hide();
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

  // SINGLE-PHOTO: Chargement des publications similaires à partir d'un gestionnaire d'événements au clic

  let currentPage = 1;
  $("#load-more").on("click", function () {
    currentPage++;

    let currentCategory = myAjax.currentCategory;
    let postID = myAjax.postID;

    $.ajax({
      type: "POST",
      url: myAjax.ajaxurl,
      dataType: "html",
      data: {
        action: "load_more_post_single",
        paged: currentPage,
        post_id: postID,
        current_category: currentCategory,
      },
      success: function (res) {
        $("#gallery_grid_single").append(res);
      },
    });
  });
});
