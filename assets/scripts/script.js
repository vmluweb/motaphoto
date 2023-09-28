document.addEventListener("DOMContentLoaded", () => {
  const contactMenu = document.querySelector(".menu-item-42");
  const popup = document.querySelector(".popup_container");
  const overlay = document.querySelector(".popup_overlay");

  console.log(contactMenu);
  contactMenu.addEventListener("click", () => {
    overlay.style.display = "block";
    popup.style.display = "flex";
  });

  overlay.addEventListener("click", (e) => {
    if (e.target === overlay) {
      overlay.style.display = "none";
      popup.style.display = "none";
    }
  });
});
