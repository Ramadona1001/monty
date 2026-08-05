window.onload = function () {
  const hamburger = document.querySelector(".hamburger");
  const closingBtn = document.querySelector(".closing_btn");
  const mobileMenu = document.querySelector(".mobile-nav");
  const mobileMenuOverlay = document.querySelector(".mobile-nav__overlay");
  const plusBtn = document.querySelector(".plus__btn");
  const mobileDropDown = document.querySelector(".mobile__dropdown__content");

  hamburger.addEventListener("click", function () {
    hamburger.classList.toggle("is-active");
    mobileMenu.classList.toggle("is-active");
    mobileMenuOverlay.classList.toggle("is-active");

    closingBtn.addEventListener("click", function () {
      hamburger.classList.remove("is-active");
      mobileMenu.classList.remove("is-active");
      mobileMenuOverlay.classList.remove("is-active");
    });
  });
  plusBtn?.addEventListener("click", function () {
    plusBtn.classList.toggle("is-active");
    mobileDropDown?.classList.toggle("is-active");
  });
};

window.onscroll = function () {
  // change navbar visabilty
  if (document.body.scrollTop > 30 || document.documentElement.scrollTop > 30) {
    document.querySelector(".header").style.position = "fixed";
  } else {
    document.querySelector(".header").style.position = "absolute";
  }

  // change scroll to top btn visabilty
  //   if (document.documentElement.scrollTop > 200) {
  //     document.getElementById("scroll-top").style.display = "block";
  //   } else {
  //     document.getElementById("scroll-top").style.display = "none";
  //   }
};