/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************************!*\
  !*** ./resources/js/registro.js ***!
  \**********************************/
var form = document.getElementById('form');
var nameInput = document.getElementById('name');
var nameError = document.getElementById('name-error');
var ageInput = document.getElementById('age');
var ageError = document.getElementById('age-error');
var nifInput = document.getElementById('nif');
var nifError = document.getElementById('nif-error');
var emailInput = document.getElementById('email');
var emailError = document.getElementById('email-error');
var passwordInput = document.getElementById('password');
var passwordError = document.getElementById('password-error');
var repasswordInput = document.getElementById('repassword');
var tokenCsrf = $('#token-csrf').attr('content');
var validatedEmail; // Agregar evento blur a los campos de entrada

nameInput.addEventListener('blur', function () {
  validateName();
});
ageInput.addEventListener('blur', function () {
  validateAge();
});
nifInput.addEventListener('blur', function () {
  validarNif();
});

function validateEmail() {
  // Obtener el valor del campo de correo electrónico
  var email = $(emailInput).val(); // Realizar la solicitud AJAX para verificar si el correo electrónico ya existe en la base de datos

  $.ajax({
    url: "/check-email",
    type: "POST",
    headers: {
      'X-CSRF-TOKEN': tokenCsrf
    },
    data: {
      correoElectronico: email
    },
    dataType: 'json',
    success: function success(response) {
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
    error: function error(_error) {
      // Manejar errores de la solicitud AJAX
      console.log(_error);
    }
  });
} // Escuchar el evento blur en el campo de correo electrónico


emailInput.addEventListener('blur', function () {
  validateEmail();
});
passwordInput.addEventListener('blur', function () {
  validatePassword();
}); // Agregar evento de envío al formulario

form.addEventListener('submit', function (event) {
  // Evitar que el formulario se envíe de forma predeterminada
  event.preventDefault(); // Validar campos de entrada

  var isNameValid = validateName();
  var isAgeValid = validateAge();
  var isNifValid = validarNif();
  var isEmailValid = validatedEmail;
  var isPasswordValid = validatePassword();
  console.log(isNameValid + " " + isAgeValid + " " + isNifValid + " " + isEmailValid + " " + isPasswordValid); // Si todos los campos son válidos, mostrar una alerta de validación y enviar formulario

  if (isNameValid && isAgeValid && isNifValid && isEmailValid && isPasswordValid) {
    console.log("ENVIAR");
    form.submit();
  }
}); // Funciones de validación para cada campo de entrada

function validateName() {
  var nameValue = nameInput.value.trim();

  if (nameValue === '') {
    setErrorFor(nameInput, nameError, 'Por favor, introduce tu nombre completo.');
    return false;
  } else {
    setSuccessFor(nameInput, nameError);
    return true;
  }
}

function validateAge() {
  var ageValue = ageInput.value.trim();

  if (ageValue === '' || isNaN(ageValue) || ageValue < 18) {
    setErrorFor(ageInput, ageError, 'Por favor, introduce una edad válida.');
    return false;
  } else {
    setSuccessFor(ageInput, ageError);
    return true;
  }
}

var nifRegExp = /^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKE]$/i;

function validarNif() {
  var nifValue = nifInput.value.trim();

  if (nifRegExp.test(nifValue)) {
    setSuccessFor(nifInput, nifError);
    return true;
  } else {
    setErrorFor(nifInput, nifError, 'Por favor, introduce un NIF válido.');
    return false;
  }
}

function validatePassword() {
  var passwordValue = passwordInput.value.trim();
  var repasswordValue = repasswordInput.value.trim();

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
} // Función para establecer un mensaje de error y estilo para los campos de entrada


function setErrorFor(input, errorElement, errorMessage) {
  input.classList.remove('border-success');
  input.classList.add('border-danger');
  errorElement.innerText = errorMessage;
  errorElement.style.display = 'block';
} // Función para establecer un estilo de éxito para los campos de entrada


function setSuccessFor(input, errorElement) {
  input.classList.remove('border-danger');
  input.classList.add('border-success');
  errorElement.style.display = 'none';
} // Función para validar una dirección de correo electrónico


function isValidEmail(email) {
  return /^[^\s@]+@[^\s@]+.[^\s@]+$/.test(email);
}
/******/ })()
;