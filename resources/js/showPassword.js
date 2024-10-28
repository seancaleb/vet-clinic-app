/**
 * A function that will toggle the visibility of password
 */

function showPassword(passwordInput, checkboxInput) {
    if (checkboxInput.checked) {
        passwordInput.type = "text";
    } else {
        passwordInput.type = "password";
    }

    if (checkboxInput) {
        checkboxInput.addEventListener("click", function () {
            if (checkboxInput.checked) {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        });
    }
}

function main() {
    document.addEventListener("DOMContentLoaded", function () {
        const passwordInput = document.getElementById("password");
        const showPasswordCheckbox = document.getElementById("show_password");
        const passwordConfirmationInput = document.getElementById(
            "password_confirmation"
        );
        const showConfirmPasswordCheckbox = document.getElementById(
            "show_confirm_password"
        );

        if (passwordInput) {
            showPassword(passwordInput, showPasswordCheckbox);
        }

        if (passwordConfirmationInput) {
            showPassword(
                passwordConfirmationInput,
                showConfirmPasswordCheckbox
            );
        }
    });
}

main();
