const inputPasswords = document.querySelectorAll(
    ".target-toggle-multiple-password"
);
const togglePassword = document.querySelector(".toggle-multiple-password");

if (togglePassword) {
    togglePassword.addEventListener("click", function (e) {
        const isChecked = e.target.checked;

        e.target.nextElementSibling.innerHTML = isChecked
            ? "Hide Password"
            : "Show Password";

        inputPasswords.forEach((input) => {
            input.setAttribute("type", isChecked ? "text" : "password");
        });
    });
}

function makeUsername(element, target) {
    let value = element.value;
    value = value.toLowerCase().split(" ").join("");

    document.querySelector(target).value = value;
}

function loadingAction(target) {
    const btn = document.querySelector(target);
    btn.disabled = true;
    btn.innerHTML = "Loading...";
}

function previewImage(e, target) {
    const targetElements = document.querySelectorAll(target);

    const [file] = e.target.files;
    if (file) {
        targetElements.forEach((el) => (el.src = URL.createObjectURL(file)));
        const hiddenParent = document.querySelector(".parent-preview");
        const parentInput = document.querySelector(".parent-input");
        if (hiddenParent && parentInput) {
            hiddenParent.classList.remove("d-none");
            parentInput.classList.remove("col-12");
            parentInput.classList.add("col-8");
        }
    }
}
