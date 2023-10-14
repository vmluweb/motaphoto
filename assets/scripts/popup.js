//01_POPUP

jQuery(document).ready(function ($) {
  // Fonction pour afficher la modal
  function openPopup() {
    $(".modal").fadeIn();
    $(".popup_overlay").fadeIn();
    //Insertion REF PHOTO
    let photoReference = $(".post_description_text p:contains('Réf. photo :')")
      .text()
      .trim();
    photoReference = photoReference.replace("Réf. photo :", "").trim();
    $("input[name='your-reference']").val(photoReference);
  }

  // Fonction pour fermer la modal
  function closePopup() {
    $(".modal").fadeOut();
    $(".popup_overlay").fadeOut();
  }

  $(".popup_link").click(function (e) {
    e.preventDefault();
    openPopup();
  });

  $(".modal").click(function (e) {
    e.stopPropagation();
    $(".modal form input:first").focus();
  });

  $(".modal form").submit(function (e) {
    let isValid = true;
    if (!isValid) {
      e.preventDefault();
    } else {
      closePopup();
    }
  });

  $(".popup_overlay").click(function () {
    closePopup();
  });
});
