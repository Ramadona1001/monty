(function () {
  const wizard = document.getElementById("shop-wizard");
  if (!wizard) return;

  const form = document.getElementById("shop-request-form");
  const openButtons = document.querySelectorAll(".js-open-shop-wizard");
  const closeTriggers = wizard.querySelectorAll("[data-shop-close]");
  const stepScreens = wizard.querySelectorAll("[data-shop-step]");
  const stepIndicators = wizard.querySelectorAll("[data-shop-step-indicator]");
  const prevBtn = wizard.querySelector("[data-shop-prev]");
  const nextBtn = wizard.querySelector("[data-shop-next]");
  const submitBtn = wizard.querySelector("[data-shop-submit]");
  const homeBtn = wizard.querySelector("[data-shop-home]");
  const errorBox = wizard.querySelector("[data-shop-error]");
  const productRadios = wizard.querySelectorAll('input[name="product_id"]');
  const summaryProduct = wizard.querySelector("[data-shop-summary-product]");

  let currentStep = 1;
  const submitUrl = wizard.dataset.submitUrl;

  const messages = {
    validation: wizard.dataset.validation || "Please complete all required fields.",
    error: wizard.dataset.error || "Something went wrong. Please try again.",
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

  function getSelectedProductRadio() {
    return wizard.querySelector('input[name="product_id"]:checked');
  }

  function updateSummary() {
    const productRadio = getSelectedProductRadio();
    if (summaryProduct && productRadio) {
      summaryProduct.textContent = productRadio.dataset.productName || "—";
    }
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
    if (nextBtn) nextBtn.hidden = step >= 2 || isSuccess;
    if (submitBtn) submitBtn.hidden = step !== 2 || isSuccess;
    if (homeBtn) homeBtn.hidden = !isSuccess;

    wizard.querySelector(".service-wizard__steps")?.classList.toggle("is-hidden", isSuccess);
  }

  function validateStep(step) {
    if (step === 1) {
      if (!getSelectedProductRadio()) {
        showError(messages.validation);
        return false;
      }
    }

    if (step === 2) {
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

      if (!getSelectedProductRadio()) {
        showError(messages.validation);
        return false;
      }
    }

    hideError();
    return true;
  }

  function openWizard() {
    wizard.hidden = false;
    wizard.setAttribute("aria-hidden", "false");
    document.body.classList.add("service-wizard-open");
    setStep(1);
  }

  function closeWizard() {
    wizard.hidden = true;
    wizard.setAttribute("aria-hidden", "true");
    document.body.classList.remove("service-wizard-open");
    form?.reset();
    productRadios.forEach((radio) => {
      radio.closest(".shop-wizard__product")?.classList.remove("is-selected");
    });
    setStep(1);
    hideError();
  }

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
    if (!validateStep(currentStep)) return;

    if (currentStep === 1) {
      updateSummary();
    }

    if (currentStep < 2) {
      setStep(currentStep + 1);
    }
  });

  productRadios.forEach((radio) => {
    radio.addEventListener("change", () => {
      productRadios.forEach((item) => {
        item.closest(".shop-wizard__product")?.classList.toggle("is-selected", item.checked);
      });
      hideError();
    });
  });

  form?.addEventListener("submit", async (event) => {
    event.preventDefault();

    if (!validateStep(2)) return;

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
})();
