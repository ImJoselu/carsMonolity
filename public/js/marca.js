/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*******************************!*\
  !*** ./resources/js/marca.js ***!
  \*******************************/
var formulario = document.getElementById('formulario');
var nombre = document.getElementById('nombre');
var nombreError = document.getElementById('nombre-error');
formulario.addEventListener('submit', function (event) {
  event.preventDefault();

  if (nombre.value.trim() === '') {
    setErrorFor(nombre, nombreError, 'El nombre es requerido');
  } else {
    setSuccessFor(nombre, nombreError);
    formulario.submit();
  }
});

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
/******/ })()
;