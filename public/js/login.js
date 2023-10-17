/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*******************************!*\
  !*** ./resources/js/login.js ***!
  \*******************************/
var form = document.querySelector('form');
var emailInput = document.getElementById('email');
var emailError = document.getElementById('emailError');
var passwordInput = document.getElementById('password');
var passwordError = document.getElementById('passwordError'); // Agregar evento blur a los campos de entrada

emailInput.addEventListener('blur', function () {
  validateEmail();
});
passwordInput.addEventListener('blur', function () {
  validatePassword();
}); // Agregar evento de envío al formulario

form.addEventListener('submit', function (event) {
  // Evitar que el formulario se envíe de forma predeterminada
  event.preventDefault(); // Validar campos de entrada

  var isEmailValid = validateEmail();
  var isPasswordValid = validatePassword(); // Si todos los campos son válidos, mostrar una alerta de validación y enviar formulario

  if (isEmailValid && isPasswordValid) {
    form.submit();
  }
}); // Funciones de validación para cada campo de entrada

function validateEmail() {
  var emailValue = emailInput.value.trim();

  if (emailValue === '') {
    setErrorFor(emailInput, emailError, 'Por favor, introduce tu correo electrónico.');
    return false;
  } else if (!isValidEmail(emailValue)) {
    setErrorFor(emailInput, emailError, 'Por favor, introduce un correo electrónico válido.');
    return false;
  } else {
    setSuccessFor(emailInput, emailError);
    return true;
  }
}

function validatePassword() {
  var passwordValue = passwordInput.value.trim();

  if (passwordValue === '') {
    setErrorFor(passwordInput, passwordError, 'Por favor, introduce tu contraseña.');
    return false;
  } else {
    setSuccessFor(passwordInput, passwordError);
    return true;
  }
} // Funciones de ayuda para mostrar errores o éxito en los campos de entrada


function setErrorFor(input, errorElement, errorMessage) {
  input.classList.remove('border-success');
  input.classList.add('border-danger');
  errorElement.innerText = errorMessage;
  errorElement.style.display = 'block';
}

function setSuccessFor(input, errorElement) {
  input.classList.remove('border-danger');
  input.classList.add('border-success');
  errorElement.style.display = 'none';
}

function isValidEmail(email) {
  var emailRegex = /^[^\s@]+@[^\s@]+.[^\s@]+$/;
  return emailRegex.test(email);
}
/******/ })()
;