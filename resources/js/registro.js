const form = document.getElementById('form');
const nameInput = document.getElementById('name');
const nameError = document.getElementById('name-error');
const ageInput = document.getElementById('age');
const ageError = document.getElementById('age-error');
const nifInput = document.getElementById('nif');
const nifError = document.getElementById('nif-error');
const emailInput = document.getElementById('email');
const emailError = document.getElementById('email-error');
const passwordInput = document.getElementById('password');
const passwordError = document.getElementById('password-error');
const repasswordInput = document.getElementById('repassword');
const tokenCsrf = $('#token-csrf').attr('content');
var validatedEmail;

// Agregar evento blur a los campos de entrada
nameInput.addEventListener('blur', () => {
    validateName();
});

ageInput.addEventListener('blur', () => {
    validateAge();
});

nifInput.addEventListener('blur', () => {
    validarNif();
});

function validateEmail() {

    // Obtener el valor del campo de correo electrónico
    var email = $(emailInput).val();

    // Realizar la solicitud AJAX para verificar si el correo electrónico ya existe en la base de datos
    $.ajax({
        url: "/check-email",
        type: "POST",
        headers: { 'X-CSRF-TOKEN': tokenCsrf },
        data: { correoElectronico: email },
        dataType: 'json',
        success: function (response) {
            // Si el correo electrónico ya existe, mostrar un mensaje de error
            if (response) {
                console.log('false');
                setErrorFor(emailInput, emailError, 'Por favor, introduce un correo no registrado.');
                validatedEmail = false;
            } else {
                // Si el correo electrónico no existe, eliminar cualquier mensaje de error existente
                console.log('true');
                setSuccessFor(emailInput, emailError);
                validatedEmail = true;
            }
        },
        error: function (error) {
            // Manejar errores de la solicitud AJAX
            console.log(error);
        }
    });
}

// Escuchar el evento blur en el campo de correo electrónico
emailInput.addEventListener('blur', () => {
    validateEmail();
});


passwordInput.addEventListener('blur', () => {
    validatePassword();
});

// Agregar evento de envío al formulario
form.addEventListener('submit', (event) => {
    // Evitar que el formulario se envíe de forma predeterminada
    event.preventDefault();

    // Validar campos de entrada
    const isNameValid = validateName();
    const isAgeValid = validateAge();
    const isNifValid = validarNif();
    const isEmailValid = validatedEmail;
    const isPasswordValid = validatePassword();
    console.log(isNameValid + " " +isAgeValid + " " +isNifValid + " " +isEmailValid + " " +isPasswordValid);

    // Si todos los campos son válidos, mostrar una alerta de validación y enviar formulario
    if (isNameValid && isAgeValid && isNifValid && isEmailValid && isPasswordValid) {
        console.log("ENVIAR");
        form.submit();
    }
});

// Funciones de validación para cada campo de entrada
function validateName() {
    const nameValue = nameInput.value.trim();

    if (nameValue === '') {
        setErrorFor(nameInput, nameError, 'Por favor, introduce tu nombre completo.');
        return false;
    } else {
        setSuccessFor(nameInput, nameError);
        return true;
    }
}

function validateAge() {
    const ageValue = ageInput.value.trim();

    if (ageValue === '' || isNaN(ageValue) || ageValue < 18) {
        setErrorFor(ageInput, ageError, 'Por favor, introduce una edad válida.');
        return false;
    } else {
        setSuccessFor(ageInput, ageError);
        return true;
    }
}

const nifRegExp = /^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKE]$/i;

function validarNif() {
    const nifValue = nifInput.value.trim();

    if (nifRegExp.test(nifValue)) {
        setSuccessFor(nifInput, nifError);
        return true;
    } else {
        setErrorFor(nifInput, nifError, 'Por favor, introduce un NIF válido.');
        return false;
    }
}

function validatePassword() {
    const passwordValue = passwordInput.value.trim();
    const repasswordValue = repasswordInput.value.trim();

    if (passwordValue === '' || passwordValue.length < 3 || passwordValue.length > 12) {
        setErrorFor(passwordInput, passwordError, 'Por favor, introduce una contraseña válida (entre 3 y 12 caracteres');
        return false;
    } else if (passwordValue != repasswordValue) {
        setErrorFor(passwordInput, passwordError, 'Las contraseñas no coinciden');
        return false;
    } else {
        setSuccessFor(passwordInput, passwordError);
        return true;
    }
}

// Función para establecer un mensaje de error y estilo para los campos de entrada
function setErrorFor(input, errorElement, errorMessage) {
    input.classList.remove('border-success');
    input.classList.add('border-danger');
    errorElement.innerText = errorMessage;
    errorElement.style.display = 'block';
}

// Función para establecer un estilo de éxito para los campos de entrada
function setSuccessFor(input, errorElement) {
    input.classList.remove('border-danger');
    input.classList.add('border-success');
    errorElement.style.display = 'none';
}

// Función para validar una dirección de correo electrónico
function isValidEmail(email) {
    return /^[^\s@]+@[^\s@]+.[^\s@]+$/.test(email);
}
