(function () {
  const wizard = document.getElementById("shop-wizard");
  if (!wizard) return;

  const productsDataElement = document.getElementById("shop-products-data");
  const openButtons = document.querySelectorAll(".js-open-shop-wizard");
  const closeTriggers = wizard.querySelectorAll("[data-shop-close]");
  const stepScreens = wizard.querySelectorAll("[data-shop-step]");
  const stepIndicators = wizard.querySelectorAll("[data-shop-step-indicator]");
  const prevBtn = wizard.querySelector("[data-shop-prev]");
  const actions = wizard.querySelector("[data-shop-actions]");
  const errorBox = wizard.querySelector("[data-shop-error]");
  const galleryContainer = wizard.querySelector("[data-shop-gallery]");
  const selectedBadges = wizard.querySelectorAll("[data-shop-selected-badge]");
  const progressFill = wizard.querySelector("[data-shop-progress-fill]");
  const productSelectButtons = wizard.querySelectorAll("[data-shop-select-product]");

  let currentStep = 1;
  let selectedProduct = null;
  const productsData = productsDataElement
    ? JSON.parse(productsDataElement.textContent || "{}")
    : {};

  const messages = {
    noImages: wizard.dataset.noImages || "No images available for this product.",
  };

  function hideError() {
    if (!errorBox) return;
    errorBox.hidden = true;
    errorBox.textContent = "";
  }

  function updateProductSelectionUi() {
    productSelectButtons.forEach((button) => {
      const isSelected = selectedProduct && Number(button.dataset.productId) === selectedProduct.id;
      button.classList.toggle("is-selected", Boolean(isSelected));
    });
  }

  function updateSelectedBadge() {
    selectedBadges.forEach((badge) => {
      if (!selectedProduct) {
        badge.hidden = true;
        badge.textContent = "";
        return;
      }

      badge.hidden = false;
      badge.textContent = selectedProduct.title;
    });
  }

  function renderGallery() {
    if (!galleryContainer || !selectedProduct) return;

    const images = selectedProduct.images || [];
    galleryContainer.innerHTML = "";
    galleryContainer.hidden = false;

    if (!images.length) {
      galleryContainer.innerHTML = `<p class="shop-wizard__gallery-empty">${messages.noImages}</p>`;
      return;
    }

    images.forEach((src, index) => {
      const item = document.createElement("button");
      item.type = "button";
      item.className = "shop-wizard__gallery-item";
      item.innerHTML = `<img src="${src}" alt="${selectedProduct.title} ${index + 1}" loading="lazy">`;
      item.addEventListener("click", () => openLightbox(images, index));
      galleryContainer.appendChild(item);
    });
  }

  function openLightbox(images, startIndex) {
    let currentIndex = startIndex;

    const overlay = document.createElement("div");
    overlay.className = "shop-wizard__lightbox";
    overlay.innerHTML = `
      <button type="button" class="shop-wizard__lightbox-close" aria-label="Close">
        <i class="fa-solid fa-xmark"></i>
      </button>
      <button type="button" class="shop-wizard__lightbox-nav shop-wizard__lightbox-nav--prev" aria-label="Previous">
        <i class="fa-solid fa-chevron-left"></i>
      </button>
      <img class="shop-wizard__lightbox-image" src="" alt="">
      <button type="button" class="shop-wizard__lightbox-nav shop-wizard__lightbox-nav--next" aria-label="Next">
        <i class="fa-solid fa-chevron-right"></i>
      </button>
    `;

    const imageEl = overlay.querySelector(".shop-wizard__lightbox-image");
    const closeBtn = overlay.querySelector(".shop-wizard__lightbox-close");
    const prevNav = overlay.querySelector(".shop-wizard__lightbox-nav--prev");
    const nextNav = overlay.querySelector(".shop-wizard__lightbox-nav--next");

    function renderImage() {
      imageEl.src = images[currentIndex];
      imageEl.alt = `${selectedProduct.title} ${currentIndex + 1}`;
      prevNav.hidden = images.length <= 1;
      nextNav.hidden = images.length <= 1;
    }

    function closeLightbox() {
      overlay.remove();
      document.body.classList.remove("shop-wizard-lightbox-open");
    }

    closeBtn.addEventListener("click", closeLightbox);
    overlay.addEventListener("click", (event) => {
      if (event.target === overlay) {
        closeLightbox();
      }
    });

    prevNav.addEventListener("click", () => {
      currentIndex = (currentIndex - 1 + images.length) % images.length;
      renderImage();
    });

    nextNav.addEventListener("click", () => {
      currentIndex = (currentIndex + 1) % images.length;
      renderImage();
    });

    document.body.appendChild(overlay);
    document.body.classList.add("shop-wizard-lightbox-open");
    renderImage();
  }

  function selectProduct(productId, productName) {
    const product = productsData[String(productId)] || productsData[productId];

    if (!product) return;

    selectedProduct = {
      id: Number(productId),
      title: productName || product.title,
      images: product.images || [],
    };

    updateProductSelectionUi();
    updateSelectedBadge();
    renderGallery();
    hideError();
    setStep(2);
  }

  function setStep(step) {
    currentStep = step;
    hideError();

    stepScreens.forEach((screen) => {
      screen.classList.toggle("is-active", screen.dataset.shopStep === String(step));
    });

    stepIndicators.forEach((indicator) => {
      const indicatorStep = Number(indicator.dataset.shopStepIndicator);
      indicator.classList.toggle("is-active", indicatorStep === step);
      indicator.classList.toggle("is-complete", indicatorStep < step);
    });

    if (prevBtn) prevBtn.hidden = step <= 1;
    if (actions) actions.hidden = step <= 1;

    if (progressFill) {
      progressFill.style.width = step <= 1 ? "0%" : "100%";
    }
  }

  function resetWizard() {
    selectedProduct = null;

    if (galleryContainer) {
      galleryContainer.innerHTML = "";
      galleryContainer.hidden = true;
    }

    updateProductSelectionUi();
    updateSelectedBadge();
    setStep(1);
    hideError();
  }

  function openWizard() {
    wizard.hidden = false;
    wizard.setAttribute("aria-hidden", "false");
    document.body.classList.add("service-wizard-open");
    resetWizard();
  }

  function closeWizard() {
    wizard.hidden = true;
    wizard.setAttribute("aria-hidden", "true");
    document.body.classList.remove("service-wizard-open");
    resetWizard();
  }

  const categoryTabs = document.getElementById("shopCategoryTabs");

  categoryTabs?.addEventListener("shown.bs.tab", (event) => {
    const activeTab = event.target;
    if (!activeTab || typeof activeTab.scrollIntoView !== "function") return;

    activeTab.scrollIntoView({
      behavior: "smooth",
      block: "nearest",
      inline: "center",
    });
  });

  openButtons.forEach((button) => {
    button.addEventListener("click", openWizard);
  });

  closeTriggers.forEach((trigger) => {
    trigger.addEventListener("click", closeWizard);
  });

  prevBtn?.addEventListener("click", () => {
    if (currentStep > 1) {
      setStep(currentStep - 1);
    }
  });

  productSelectButtons.forEach((button) => {
    button.addEventListener("click", () => {
      selectProduct(button.dataset.productId, button.dataset.productName);
    });
  });

  document.addEventListener("keydown", (event) => {
    if (event.key === "Escape" && !wizard.hidden) {
      closeWizard();
    }
  });

  if (window.location.hash === "#shop") {
    openWizard();
    history.replaceState(null, "", window.location.pathname + window.location.search);
  }
})();
