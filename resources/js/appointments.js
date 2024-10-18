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
    buttonEl.innerHTML = `Cancel Appointment
            <svg aria-hidden="true" class="ml-1 w-4 h-4 text-white animate-spin fill-red-700"
           viewBox="0 0 100 101" xmlns="http://www.w3.org/2000/svg">
           <path
               d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
               fill="currentColor" />
           <path
               d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
               fill="currentFill" />
       </svg>`;
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
