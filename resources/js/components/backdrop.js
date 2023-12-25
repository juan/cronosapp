// Backdrop
// Show
const showBackdrop = (workspace) => {
  if (document.querySelector(".backdrop")) return;

  document.body.classList.add("backdrop-show");

  const backdrop = document.createElement("div");
  if (workspace) {
    backdrop.setAttribute("class", "backdrop backdrop_workspace");
  } else {
    backdrop.setAttribute("class", "backdrop");
  }

  document.body.appendChild(backdrop);
  backdrop.classList.add("active");
};

// Hide
const hideBackdrop = () => {
  backdropToRemove = document.querySelector(".backdrop");

  if (!backdropToRemove) return;

  document.body.classList.remove("backdrop-show");

  backdropToRemove.classList.remove("active");
  document.body.removeChild(backdropToRemove);
};
