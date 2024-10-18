/**
 * A function that will handle the click events and attribute modifications for the dialog component
 */

export function filterDialog() {
    const btn = document.getElementById("dialog-button");
    const overlay = document.getElementById("filter-dialog-overlay");
    const content = document.getElementById("filter-dialog-content");
    const closeBtn = document.getElementById("filter-dialog-close-button");
    const cancelBtn = document.getElementById("filter-dialog-cancel-button");
    const applyFiltersBtn = document.getElementById(
        "filter-dialog-apply-button"
    );

    const btns = [closeBtn, cancelBtn, applyFiltersBtn];

    document.addEventListener("click", function (event) {
        if (event.target.closest("#filter-dialog-content")) {
            return;
        }

        if (event.target.closest("#filter-dialog-overlay")) {
            overlay.setAttribute("data-state", "closed");
            content.setAttribute("data-state", "closed");
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
            content.setAttribute("data-state", "closed");
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

    btns.forEach((btn) => {
        if (btn) {
            btn.addEventListener("click", function () {
                overlay.setAttribute("data-state", "closed");
                content.setAttribute("data-state", "closed");
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
        }
    });

    if (btn) {
        btn.addEventListener("click", function () {
            if (overlay.getAttribute("data-state") === "closed") {
                overlay.classList.remove("hidden");
                overlay.classList.add("block");
                overlay.setAttribute("data-state", "open");
                content.setAttribute("data-state", "open");
            } else {
                overlay.setAttribute("data-state", "closed");
                content.setAttribute("data-state", "closed");
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
}
