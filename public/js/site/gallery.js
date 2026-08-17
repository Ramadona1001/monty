document.addEventListener("DOMContentLoaded", function () {
  const modal = document.getElementById("galleryModal");
  if (!modal) return;

  const titleEl = document.getElementById("galleryModalTitle");
  const contentEl = modal.querySelector(".gallery-modal__content");

  modal.addEventListener("show.bs.modal", function (event) {
    const trigger = event.relatedTarget;
    if (!trigger || !contentEl || !titleEl) return;

    titleEl.textContent = trigger.dataset.galleryTitle || "";
    contentEl.innerHTML = "";

    const type = trigger.dataset.galleryType;
    const src = trigger.dataset.gallerySrc;
    const embed = trigger.dataset.galleryEmbed;
    const video = trigger.dataset.galleryVideo;

    if (type === "image" && src) {
      contentEl.innerHTML = `<img src="${src}" alt="${titleEl.textContent}" class="gallery-modal__image">`;
      return;
    }

    if (embed) {
      contentEl.innerHTML = `<iframe src="${embed}" class="gallery-modal__iframe" allowfullscreen allow="autoplay; encrypted-media; picture-in-picture"></iframe>`;
      return;
    }

    if (video) {
      contentEl.innerHTML = `<video src="${video}" class="gallery-modal__video" controls autoplay></video>`;
    }
  });

  modal.addEventListener("hidden.bs.modal", function () {
    if (contentEl) {
      contentEl.innerHTML = "";
    }
  });
});
