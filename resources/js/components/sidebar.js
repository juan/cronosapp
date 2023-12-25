// Sidebar
const sidebar = () => {
  const sidebar = document.querySelector(".sidebar:not(.sidebar_customizer)");

  if (!sidebar) return;

  // Show Sidebar
  const showSidebar = () => {
    showBackdrop(true);
    sidebar.classList.add("open");
  };

  // Hide Sidebar
  const hideSidebar = () => {
    hideBackdrop();
    sidebar.classList.remove("open");
  };

  // Toggle Sidebar
  const toggleSidebar = () => {
    if (sidebar.classList.contains("open")) {
      hideSidebar();
    } else {
      showSidebar();
    }
  };

  // Watch the viewport width
  const watchWidth = () => {
    const sm = 640;
    const md = 768;
    const lg = 1024;
    const xl = 1280;

    const viewportWidth =
      window.innerWidth || document.documentElement.clientWidth;

    if (viewportWidth > lg) {
      hideSidebar();
    }
  };

  // On resize events, recalculate
  window.addEventListener(
    "resize",
    () => {
      watchWidth();
    },
    false
  );

  on("body", "click", '[data-toggle="sidebar"]', () => {
    toggleSidebar();
  });
};

sidebar();
