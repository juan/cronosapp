// Menu
const menu = () => {
  const root = document.documentElement;

  const menuBar = document.querySelector(".menu-bar");
  const menuItems = document.querySelector(".menu-items");

  if (!menuBar && !menuItems) return;

  // Check Settings
  const menuType = localStorage.getItem("menuType");

  if (menuType) {
    root.classList.add(menuType);
    menuBar.classList.add(menuType);
  }

  // Open Menu Detail
  const openMenuDetail = (event) => {
    const menuLink = event.target.closest(".link");
    const menu = menuLink.dataset.target;
    const selectedMenu = menuBar.querySelector(menu);

    if (selectedMenu && !menuBar.classList.contains("menu-wide")) {
      const isSelectedMenuOpen = selectedMenu.classList.contains("open");

      hideMenuDetail();

      if (selectedMenu && !isSelectedMenuOpen) {
        showBackdrop(true);
        selectedMenu.classList.add("open");
      } else {
        hideBackdrop();
      }
    }
  };

  // Hide Menu Detail
  const hideMenuDetail = () => {
    menuBar.querySelectorAll(".menu-detail.open").forEach((menuDetail) => {
      hideBackdrop();

      if (!menuBar.classList.contains("menu-wide")) {
        menuDetail.classList.remove("open");
      }
    });
  };

  // Open Menu
  const openMenu = () => {
    root.classList.remove("menu-hidden");
    menuBar.classList.remove("menu-hidden");
  };

  // Close Menu
  const closeMenu = () => {
    root.classList.add("menu-hidden");
    menuBar.classList.add("menu-hidden");
  };

  // Toggle Menu
  const toggleMenu = () => {
    if (menuBar.classList.contains("menu-hidden")) {
      openMenu();
    } else {
      closeMenu();
    }
  };

  // Switch Menu Type
  const switchMenuType = (id) => {
    const openMenu = menuBar.querySelector(".menu-detail.open");

    root.classList.remove("menu-icon-only");
    menuBar.classList.remove("menu-icon-only");

    root.classList.remove("menu-wide");
    menuBar.classList.remove("menu-wide");
    deactivateWide();

    root.classList.remove("menu-hidden");
    menuBar.classList.remove("menu-hidden");

    switch (id) {
      case "icon-only":
        root.classList.add("menu-icon-only");
        menuBar.classList.add("menu-icon-only");
        localStorage.setItem("menuType", "menu-icon-only");

        if (openMenu) {
          showBackdrop(true);
        }

        break;
      case "wide":
        root.classList.add("menu-wide");
        menuBar.classList.add("menu-wide");
        localStorage.setItem("menuType", "menu-wide");

        activateWide();

        if (openMenu) {
          hideBackdrop();
        }

        break;
      case "hidden":
        root.classList.add("menu-hidden");
        menuBar.classList.add("menu-hidden");
        localStorage.setItem("menuType", "menu-hidden");

        hideMenuDetail();

        break;
      default:
        localStorage.removeItem("menuType");

        if (openMenu) {
          showBackdrop(true);
        }
    }
  };

  // Activate Wide
  const activateWide = () => {
    menuBar.querySelector(".menu-header").classList.remove("hidden");

    menuBar.querySelectorAll(".menu-items .link").forEach((menuLink) => {
      const target = menuLink.dataset.target;

      const selectedMenu = menuBar.querySelector(".menu-detail" + target);
      if (selectedMenu) {
        selectedMenu.classList.add("collapse");
        menuLink.setAttribute("data-toggle", "collapse");
        menuLink.after(selectedMenu);
      }
    });
  };

  // Deactivate Wide
  const deactivateWide = () => {
    root.classList.remove("menu-wide");
    menuBar.classList.remove("menu-wide");

    menuBar.querySelector(".menu-header").classList.add("hidden");

    menuBar.querySelectorAll(".menu-items .link").forEach((menuLink) => {
      const target = menuLink.dataset.target;

      const selectedMenu = menuBar.querySelector(".menu-detail" + target);
      if (selectedMenu) {
        selectedMenu.classList.remove("collapse");
        menuLink.removeAttribute("data-toggle", "collapse");
        menuItems.after(selectedMenu);
      }
    });
  };

  // Watch the viewport width
  const watchWidth = () => {
    const sm = 640;
    const md = 768;
    const lg = 1024;
    const xl = 1280;

    const viewportWidth =
      window.innerWidth || document.documentElement.clientWidth;

    if (viewportWidth < sm) {
      const openMenu = menuBar.querySelector(".menu-detail.open");

      if (!openMenu) {
        closeMenu();
      }
    }

    if (viewportWidth > sm) {
      openMenu();
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

  // Auto-activate Wide
  if (menuBar.classList.contains("menu-wide")) {
    activateWide();
  }

  // Hide Menu - When Clicked Elsewhere
  document.addEventListener("click", (event) => {
    if (
      !event.target.closest(".menu-bar") &&
      !menuBar.classList.contains("menu-wide")
    ) {
      hideMenuDetail();
    }
  });

  on(".top-bar", "click", "[data-toggle='menu']", (event) => {
    toggleMenu(event);
  });

  on(".menu-items", "click", ".link", (event) => {
    openMenuDetail(event);
  });

  on(".menu-bar", "click", "[data-toggle='menu-type']", (event) => {
    const id = event.target.closest("[data-toggle='menu-type']").dataset.value;
    switchMenuType(id);
  });
};

menu();

// Show Active Page
const showActivePage = () => {
  const pageUrl = window.location.href.split(/[?#]/)[0];

  const pageLinkSelector = ".menu-bar a";

  const pageLinks = document.querySelectorAll(pageLinkSelector);

  if (!pageLinks) return;

  pageLinks.forEach((pageLink) => {
    if (pageLink.href === pageUrl) {
      pageLink.classList.add("active");

      const mainMenuTrigger = pageLink.closest(".menu-detail");

      if (!mainMenuTrigger) return;

      const mainMenu = document.querySelector(
        '.menu-items .link[data-target="[data-menu=' +
          mainMenuTrigger.dataset.menu +
          ']"]'
      );

      mainMenu.classList.add("active");
    }
  });
};

showActivePage();
