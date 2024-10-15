/**
 * A function that will handle the click events and attribute modifications for the sidebar menu on mobile screens
 */
export function toggleMenuSidebar() {
    const menuBurgerBtn = document.getElementById("menu-burger-button");
    const menuSidebar = document.getElementById("menu-sidebar");
    const menuSidebarCloseBtn = document.getElementById(
        "menu-sidebar-close-button"
    );
    const overlay = document.getElementById("overlay");

    document.addEventListener("click", function (event) {
        if (event.target.closest("#menu-sidebar")) {
            return;
        }

        if (event.target.closest("#overlay")) {
            overlay.setAttribute("data-state", "closed");
            menuSidebar.setAttribute("data-state", "closed");
            overlay.addEventListener(
                "animationend",
                function () {
                    overlay.classList.remove("block");
                    overlay.classList.add("hidden");
                },
                {
                    once: true,
                }
            );
        }
    });

    document.addEventListener("keydown", (event) => {
        if (event.key === "Escape") {
            overlay.setAttribute("data-state", "closed");
            menuSidebar.setAttribute("data-state", "closed");
            overlay.addEventListener(
                "animationend",
                function () {
                    overlay.classList.remove("block");
                    overlay.classList.add("hidden");
                },
                {
                    once: true,
                }
            );
        }
    });

    menuSidebarCloseBtn.addEventListener("click", function () {
        overlay.setAttribute("data-state", "closed");
        menuSidebar.setAttribute("data-state", "closed");
        overlay.addEventListener(
            "animationend",
            function () {
                overlay.classList.remove("block");
                overlay.classList.add("hidden");
            },
            {
                once: true,
            }
        );
    });

    menuBurgerBtn.addEventListener("click", function () {
        if (overlay.getAttribute("data-state") === "closed") {
            overlay.classList.remove("hidden");
            overlay.classList.add("block");
            overlay.setAttribute("data-state", "open");
            menuSidebar.setAttribute("data-state", "open");
        } else {
            overlay.setAttribute("data-state", "closed");
            menuSidebar.setAttribute("data-state", "closed");
            overlay.classList.remove("block");
            overlay.addEventListener(
                "animationend",
                function () {
                    overlay.classList.add("hidden");
                },
                {
                    once: true,
                }
            );
        }
    });
}
