/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************************************!*\
  !*** ./resources/js/modules/shoppingcart.js ***!
  \**********************************************/
(function () {
  window.addEventListener('load', function () {
    Livewire.on('cleanCartWarning', function () {
      Swal.fire({
        html: '<h2 class="popUpTitle">¿Estás seguro de que quieres limpiar tu carrito?</h2>',
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: 'No',
        confirmButtonText: 'Sí',
        buttonsStyling: false,
        customClass: {
          cancelButton: 'negativeAnswer',
          confirmButton: 'positiveAnswer',
          actions: 'buttonsModalContainer'
        }
      }).then(function (result) {
        if (result.isConfirmed) {
          Livewire.emit('cleanCartConfirmation');
        }
      });
    });
    Livewire.on('confirmPurchase', function (htmlSummary, total) {
      Swal.fire({
        html: '<h2 class="popUpTitle">Confirma tu pago</h2>' + '<div class="swal2-html-container" id="swal2-html-container" style="display: block;">' + '<h3 class="popUpSubtitle">Resumen de la compra</h3>' + htmlSummary + '<h3 class="popUpSubtitle">Total</h3>' + '<p class="popUpDescription bold">$' + total + 'mxn</p>' + '</div>',
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Confirmar compra',
        buttonsStyling: false,
        customClass: {
          cancelButton: 'negativeAnswer',
          confirmButton: 'positiveAnswer',
          actions: 'buttonsModalContainer'
        }
      }).then(function (result) {
        if (result.isConfirmed) {
          Livewire.emit('purchaseConfirmation');
          Livewire.emit('redirectToPurchases');
        }
      });
    });
    Livewire.on('noPaymentMethod', function () {
      Swal.fire({
        html: '<h2 class="popUpTitle">No cuentas con ningún método de pago</h2>' + '<div class="swal2-html-container" id="swal2-html-container" style="display: block;">' + '<p class="popUpDescription">¿Deseas agregar alguno?</p>' + '</div>',
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: 'No',
        confirmButtonText: 'Agregar',
        buttonsStyling: false,
        customClass: {
          cancelButton: 'negativeAnswer',
          confirmButton: 'positiveAnswer',
          actions: 'buttonsModalContainer'
        }
      }).then(function (result) {
        if (result.isConfirmed) {
          Livewire.emit('redirectToPaymentMethods');
        }
      });
    });
    Livewire.on('noCartProducts', function () {
      Swal.fire({
        html: '<h2 class="popUpTitle">No hay ningún producto en tu carrito</h2>' + '<div class="swal2-html-container" id="swal2-html-container" style="display: block;">' + '<p class="popUpDescription">¿Deseas agregar productos?</p>' + '</div>',
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: 'No',
        confirmButtonText: 'Agregar',
        buttonsStyling: false,
        customClass: {
          cancelButton: 'negativeAnswer',
          confirmButton: 'positiveAnswer',
          actions: 'buttonsModalContainer'
        }
      }).then(function (result) {
        if (result.isConfirmed) {
          Livewire.emit('redirectToProducts');
        }
      });
    });
    Livewire.on('noAddress', function () {
      Swal.fire({
        html: '<h2>No cuentas con ningúna ubicación a la cual enviar tus productos</h2>' + '<div class="swal2-html-container" id="swal2-html-container" style="display: block;">' + '<p class="description">¿Deseas agregar alguna?</p>' + '</div>',
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: 'No',
        confirmButtonText: 'Agregar',
        buttonsStyling: false,
        customClass: {
          cancelButton: 'negativeAnswer',
          confirmButton: 'positiveAnswer',
          actions: 'buttonsModalContainer'
        }
      }).then(function (result) {
        if (result.isConfirmed) {
          Livewire.emit('redirectToConfiguration');
        }
      });
    });
  });
})();
/******/ })()
;