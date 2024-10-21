import { cancelAppointment } from "./appointments";
import { filterDialog } from "./filter-dialog-script";
import { toggleMenuSidebar } from "./toggle-sidebar-script";

/**
 * Main entry point of all the scripts
 */
function main() {
    document.addEventListener("DOMContentLoaded", function () {
        toggleMenuSidebar();
        filterDialog();
        cancelAppointment();
    });
}

main();
