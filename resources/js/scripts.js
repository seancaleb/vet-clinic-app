import { cancelAppointment } from "./appointments";
import { filterDialog } from "./filter-dialog-script";
import { toggleMenuSidebar } from "./toggle-sidebar-script";

function main() {
    document.addEventListener("DOMContentLoaded", function () {
        toggleMenuSidebar();
        filterDialog();
        cancelAppointment();
    });
}

main();
