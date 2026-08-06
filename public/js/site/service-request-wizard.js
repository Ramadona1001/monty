(function () {
  const wizard = document.getElementById("service-request-wizard");
  if (!wizard) return;

  const form = document.getElementById("service-request-form");
  const openButtons = document.querySelectorAll(".js-open-service-wizard");
  const closeTriggers = wizard.querySelectorAll("[data-wizard-close]");
  const stepScreens = wizard.querySelectorAll("[data-wizard-step]");
  const stepIndicators = wizard.querySelectorAll("[data-step-indicator]");
  const prevBtn = wizard.querySelector("[data-wizard-prev]");
  const nextBtn = wizard.querySelector("[data-wizard-next]");
  const submitBtn = wizard.querySelector("[data-wizard-submit]");
  const homeBtn = wizard.querySelector("[data-wizard-home]");
  const actions = wizard.querySelector("[data-wizard-actions]");
  const errorBox = wizard.querySelector("[data-wizard-error]");
  const branchSelect = wizard.querySelector("#wizard-branch");
  const serviceRadios = wizard.querySelectorAll('input[name="service_request_type_id"]');
  const summaryBranch = wizard.querySelector("[data-summary-branch]");
  const summaryService = wizard.querySelector("[data-summary-service]");
  const serviceDisplay = wizard.querySelector("#wizard-service-display");
  const detailsTitle = wizard.querySelector("[data-wizard-details-title]");

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

  function getSelectedServiceRadio() {
    return wizard.querySelector('input[name="service_request_type_id"]:checked');
  }

  function updateSummary() {
    const branchOption = branchSelect?.selectedOptions[0];
    const serviceRadio = getSelectedServiceRadio();

    if (summaryBranch && branchOption) {
      summaryBranch.textContent = branchOption.value ? branchOption.textContent : "—";
    }

    if (serviceRadio) {
      const serviceName = serviceRadio.dataset.serviceName || "";
      if (summaryService) summaryService.textContent = serviceName;
      if (serviceDisplay) serviceDisplay.value = serviceName;
      if (detailsTitle) detailsTitle.textContent = serviceName;
    }
  }

  function setStep(step) {
    currentStep = step;
    hideError();

    stepScreens.forEach((screen) => {
      const screenStep = screen.dataset.wizardStep;
      screen.classList.toggle("is-active", screenStep === String(step));
    });

    stepIndicators.forEach((indicator) => {
      const indicatorStep = Number(indicator.dataset.stepIndicator);
      indicator.classList.toggle("is-active", indicatorStep === step);
      indicator.classList.toggle("is-complete", indicatorStep < step);
    });

    const isSuccess = step === "success";
    wizard.classList.toggle("is-success", isSuccess);

    if (prevBtn) prevBtn.hidden = step <= 1 || isSuccess;
    if (nextBtn) nextBtn.hidden = step >= 3 || isSuccess;
    if (submitBtn) submitBtn.hidden = step !== 3 || isSuccess;
    if (homeBtn) homeBtn.hidden = !isSuccess;
    if (actions) actions.hidden = isSuccess ? false : false;

    wizard.querySelector(".service-wizard__steps")?.classList.toggle("is-hidden", isSuccess);
  }

  function validateStep(step) {
    if (step === 1) {
      if (!branchSelect?.value) {
        branchSelect?.focus();
        showError(messages.validation);
        return false;
      }
    }

    if (step === 2) {
      if (!getSelectedServiceRadio()) {
        showError(messages.validation);
        return false;
      }
    }

    if (step === 3) {
      const nameInput = wizard.querySelector("#wizard-customer-name");
      const phoneInput = wizard.querySelector("#wizard-phone");

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
    serviceRadios.forEach((radio) => {
      radio.closest(".service-wizard__card")?.classList.remove("is-selected");
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

    if (currentStep === 2) {
      updateSummary();
    }

    if (currentStep < 3) {
      setStep(currentStep + 1);
    }
  });

  serviceRadios.forEach((radio) => {
    radio.addEventListener("change", () => {
      serviceRadios.forEach((item) => {
        item.closest(".service-wizard__card")?.classList.toggle("is-selected", item.checked);
      });
      hideError();
    });
  });

  branchSelect?.addEventListener("change", hideError);

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
