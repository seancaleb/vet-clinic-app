/**
 * A function that is responsible for handling the AJAX request upon clicking the 'Cancel Appointment' button
 */

export function cancelAppointment() {
    const cancelAppointmentBtn = document.getElementById(
        "cancel-appointment-button"
    );

    if (cancelAppointmentBtn) {
        cancelAppointmentBtn.addEventListener("click", function () {
            const appointmentId = this.getAttribute("data-appointment-id");
            const csrfToken = document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content");

            // Update the button attributes for the 'Cancel Appointment' button
            updateButtonAttributes(cancelAppointmentBtn);

            // Make an AJAX request to change the 'status' of an appointment to 'cancelled'
            fetch(`/appointments/${appointmentId}`, {
                method: "PATCH",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken,
                },
                body: JSON.stringify({
                    status: "cancelled",
                }),
            })
                .then((response) => {
                    if (response.ok) return response.json();
                    throw new Error("Network response was not ok.");
                })
                .then(() => {
                    // Trigger the UI changes based on the 'cancelled' status of the appointment
                    handleUiUpdates();

                    // Remove the 'Cancel Appointment' button from the DOM afer all the UI changes
                    cancelAppointmentBtn.remove();
                })
                .catch((error) => {
                    console.error(
                        "Something went wrong with the fetch operation:",
                        error
                    );
                });
        });
    }
}

/**
 * A function that will initialize the 'loading' state of the 'Cancel Appointment' button
 */
function updateButtonAttributes(buttonEl) {
    buttonEl.disabled = true;
    buttonEl.classList.add("pointer-events-none");
    buttonEl.innerHTML = `Cancelling Appointment`;
}

/**
 * A function that will perform any UI changes on the DOM after completing a successful response from the AJAX call
 */
function handleUiUpdates() {
    const statusBadgeText = document.querySelector(
        '[data-badge-status-text="badge-status-text"]'
    );
    const statusBadge = document.querySelector(
        '[data-badge-status="badge-status"]'
    );
    const editAppointmentBtnWrapper = document.getElementById(
        "edit-appointment-button-wrapper"
    );
    const deleteAppointmentBtn = document.getElementById(
        "delete-appointment-button"
    );

    const classesToRemove = [
        "bg-yellow-500/10",
        "text-yellow-500",
        "bg-green-500/10",
        "text-green-500",
    ];

    const classesToAdd = ["text-red-600", "bg-red-500/10"];

    statusBadgeText.innerHTML = ` <svg
            xmlns="http://www.w3.org/2000/svg"
            class="w-4 h-4 text-red-600"
            viewBox="0 0 24 24"
        >
            <path
                fill="currentColor"
                d="M5 22q-.825 0-1.412-.587T3 20V6q0-.825.588-1.412T5 4h1V3q0-.425.288-.712T7 2t.713.288T8 3v1h8V3q0-.425.288-.712T17 2t.713.288T18 3v1h1q.825 0 1.413.588T21 6v14q0 .825-.587 1.413T19 22zm0-2h14V10H5z"
            />
        </svg> Appointment is cancelled`;

    statusBadge.textContent = "CANCELLED";

    statusBadgeText.classList.remove(...classesToRemove);
    statusBadge.classList.remove(...classesToRemove);
    statusBadgeText.classList.add(...classesToAdd);
    statusBadge.classList.add(...classesToAdd);

    if (editAppointmentBtnWrapper) {
        editAppointmentBtnWrapper.classList.add("hidden");
    }

    if (deleteAppointmentBtn) {
        deleteAppointmentBtn.classList.remove("hidden");
        deleteAppointmentBtn.classList.add("flex");
    }
}
