(function () {
  const wizard = document.getElementById("shop-wizard");
  if (!wizard) return;

  const form = document.getElementById("shop-request-form");
  const productsDataElement = document.getElementById("shop-products-data");
  const openButtons = document.querySelectorAll(".js-open-shop-wizard");
  const closeTriggers = wizard.querySelectorAll("[data-shop-close]");
  const stepScreens = wizard.querySelectorAll("[data-shop-step]");
  const stepIndicators = wizard.querySelectorAll("[data-shop-step-indicator]");
  const prevBtn = wizard.querySelector("[data-shop-prev]");
  const nextBtn = wizard.querySelector("[data-shop-next]");
  const submitBtn = wizard.querySelector("[data-shop-submit]");
  const homeBtn = wizard.querySelector("[data-shop-home]");
  const errorBox = wizard.querySelector("[data-shop-error]");
  const productIdInput = wizard.querySelector("#shop-product-id");
  const summaryProduct = wizard.querySelector("[data-shop-summary-product]");
  const galleryContainer = wizard.querySelector("[data-shop-gallery]");
  const selectedBadges = wizard.querySelectorAll("[data-shop-selected-badge]");
  const progressFill = wizard.querySelector("[data-shop-progress-fill]");
  const productSelectButtons = wizard.querySelectorAll("[data-shop-select-product]");

  let currentStep = 1;
  let selectedProduct = null;
  const submitUrl = wizard.dataset.submitUrl;
  const productsData = productsDataElement
    ? JSON.parse(productsDataElement.textContent || "{}")
    : {};

  const messages = {
    validation: wizard.dataset.validation || "Please complete all required fields.",
    error: wizard.dataset.error || "Something went wrong. Please try again.",
    noImages: wizard.dataset.noImages || "No images available for this product.",
  };

  function showError(message) {
    if (!errorBox) return;
    errorBox.textContent = message;
    errorBox.hidden = false;
  }

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

  function updateSummary() {
    if (summaryProduct && selectedProduct) {
      summaryProduct.textContent = selectedProduct.title || "—";
    }

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

    if (!images.length) {
      galleryContainer.hidden = false;
      galleryContainer.innerHTML = `<p class="shop-wizard__gallery-empty">${messages.noImages}</p>`;
      return;
    }

    galleryContainer.hidden = false;

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

    if (!product) {
      showError(messages.validation);
      return;
    }

    selectedProduct = {
      id: Number(productId),
      title: productName || product.title,
      images: product.images || [],
    };

    if (productIdInput) {
      productIdInput.value = String(productId);
    }

    updateProductSelectionUi();
    updateSummary();
    renderGallery();
    hideError();
    setStep(2);
  }

  function setStep(step) {
    currentStep = step;
    hideError();

    stepScreens.forEach((screen) => {
      const screenStep = screen.dataset.shopStep;
      screen.classList.toggle("is-active", screenStep === String(step));
    });

    stepIndicators.forEach((indicator) => {
      const indicatorStep = Number(indicator.dataset.shopStepIndicator);
      indicator.classList.toggle("is-active", indicatorStep === step);
      indicator.classList.toggle("is-complete", indicatorStep < step);
    });

    const isSuccess = step === "success";
    wizard.classList.toggle("is-success", isSuccess);

    if (prevBtn) prevBtn.hidden = step <= 1 || isSuccess;
    if (nextBtn) nextBtn.hidden = step !== 2 || isSuccess;
    if (submitBtn) submitBtn.hidden = step !== 3 || isSuccess;
    if (homeBtn) homeBtn.hidden = !isSuccess;

    wizard.querySelector(".shop-wizard__steps")?.classList.toggle("is-hidden", isSuccess);
    wizard.querySelector(".shop-wizard__progress")?.classList.toggle("is-hidden", isSuccess);

    if (progressFill && typeof step === "number") {
      progressFill.style.width = `${((step - 1) / 2) * 100}%`;
    }
  }

  function validateStep(step) {
    if (step === 1) {
      if (!selectedProduct) {
        showError(messages.validation);
        return false;
      }
    }

    if (step === 3) {
      const nameInput = wizard.querySelector("#shop-customer-name");
      const phoneInput = wizard.querySelector("#shop-phone");

      if (!nameInput?.value.trim()) {
        nameInput?.focus();
        showError(messages.validation);
        return false;
      }

      if (!phoneInput?.value.trim()) {
        phoneInput?.focus();
        showError(messages.validation);
        return false;
      }

      if (!selectedProduct || !productIdInput?.value) {
        showError(messages.validation);
        return false;
      }
    }

    hideError();
    return true;
  }

  function resetWizard() {
    selectedProduct = null;

    if (productIdInput) {
      productIdInput.value = "";
    }

    if (galleryContainer) {
      galleryContainer.innerHTML = "";
      galleryContainer.hidden = true;
    }

    updateProductSelectionUi();
    form?.reset();
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

  nextBtn?.addEventListener("click", () => {
    if (currentStep === 2) {
      setStep(3);
    }
  });

  productSelectButtons.forEach((button) => {
    button.addEventListener("click", () => {
      selectProduct(button.dataset.productId, button.dataset.productName);
    });
  });

  form?.addEventListener("submit", async (event) => {
    event.preventDefault();

    if (!validateStep(3)) return;

    hideError();
    submitBtn.disabled = true;

    const formData = new FormData(form);

    try {
      const response = await fetch(submitUrl, {
        method: "POST",
        headers: {
          Accept: "application/json",
          "X-Requested-With": "XMLHttpRequest",
        },
        body: formData,
      });

      if (!response.ok) {
        const payload = await response.json().catch(() => ({}));
        const firstError = payload.errors ? Object.values(payload.errors).flat()[0] : null;
        showError(firstError || messages.error);
        return;
      }

      setStep("success");
      form.reset();
      if (productIdInput && selectedProduct) {
        productIdInput.value = String(selectedProduct.id);
      }
    } catch (error) {
      showError(messages.error);
    } finally {
      submitBtn.disabled = false;
    }
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
