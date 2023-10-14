jQuery(document).ready(function ($) {
  //SINGLE-PHOTO: Affichage de la featured image au survol des flèches de navigation
  $(".post-thumbnail").hide();
  $(".prev").hover(
    function () {
      let prevThumbnailURL = $(this).data("thumbnail-url");
      console.log(prevThumbnailURL);
      $(".post-thumbnail").attr("src", prevThumbnailURL);
      $(".post-thumbnail").show();
    },
    function () {
      $(".post-thumbnail").hide();
    }
  );

  $(".next").hover(
    function () {
      let nextThumbnailURL = $(this).data("thumbnail-url");
      $(".post-thumbnail").attr("src", nextThumbnailURL);
      $(".post-thumbnail").show();
    },
    function () {
      $(".post-thumbnail").hide();
    }
  );
});
