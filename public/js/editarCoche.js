/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*************************************!*\
  !*** ./resources/js/editarCoche.js ***!
  \*************************************/
var matriculaInput = document.getElementById('matricula');
var matriculaError = document.getElementById('matricula-error');
var modeloInput = document.getElementById('modelo');
var modeloError = document.getElementById('modelo-error');
var colorInput = document.getElementById('color');
var colorError = document.getElementById('color-error');
var motorInput = document.getElementById('motor');
var motorError = document.getElementById('motor-error'); // Expresión regular para validar la matrícula

var matriculaRegex = /^[0-9]{4}[a-zA-Z]{3}$/; // Función de validación de la matrícula

function validarMatricula() {
  if (!matriculaRegex.test(matriculaInput.value)) {
    setErrorFor(matriculaInput, matriculaError, 'La matrícula debe tener el formato 1234ABC.');
    return false;
  } else {
    setSuccessFor(matriculaInput, matriculaError);
    return true;
  }
} // Función de validación del modelo


function validarModelo() {
  if (modeloInput.value === '') {
    setErrorFor(modeloInput, modeloError, 'Este campo es obligatorio');
    return false;
  } else {
    setSuccessFor(modeloInput, modeloError);
    return true;
  }
} // Función de validación del color


function validarColor() {
  if (colorInput.value === '') {
    setErrorFor(colorInput, colorError, 'Este campo es obligatorio');
    return false;
  } else {
    setSuccessFor(colorInput, colorError);
    return true;
  }
} // Función de validación del motor


function validarMotor() {
  if (motorInput.value === '') {
    setErrorFor(motorInput, motorError, 'Este campo es obligatorio');
    return false;
  } else {
    setSuccessFor(motorInput, motorError);
    return true;
  }
}

; // Asignar las funciones de validación al evento blur de cada campo de entrada

matriculaInput.addEventListener('blur', validarMatricula);
modeloInput.addEventListener('blur', validarModelo);
colorInput.addEventListener('blur', validarColor);
motorInput.addEventListener('blur', validarMotor);
/******/
// Funciones de ayuda para mostrar errores o éxito en los campos de entrada

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