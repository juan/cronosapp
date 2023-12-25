// Modal
const modal = () => {
  const selector = '[data-toggle="modal"]';

  // Show
  const showModal = (modal) => {
    showBackdrop();
    modal.classList.add("active");
    const animation = modal.dataset.animations.split(", ")[0];
    const modalContent = modal.querySelector(".modal-content");
    animateCSS(modalContent, animation);

    modal.addEventListener("click", (event) => {
      if (modal.dataset.staticBackdrop !== undefined) return;
      if (modal !== event.target) return;
      closeModal(modal);
    });
  };

  // Close
  const closeModal = (modal) => {
    hideBackdrop();
    const animation = modal.dataset.animations.split(", ")[1];
    const modalContent = modal.querySelector(".modal-content");
    animateCSS(modalContent, animation).then(() => {
      modal.classList.remove("active");
    });
  };

  on("body", "click", selector, (event) => {
    const modalTrigger = event.target.closest(selector);
    const modal = document.querySelector(modalTrigger.dataset.target);
    showModal(modal);
  });

  on(".modal", "click", '[data-dismiss="modal"]', (event) => {
    const modal = event.target.closest(".modal");
    closeModal(modal);
  });
};

modal();
