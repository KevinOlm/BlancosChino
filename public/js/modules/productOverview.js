/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*************************************************!*\
  !*** ./resources/js/modules/productOverview.js ***!
  \*************************************************/
(function () {
  window.addEventListener('load', function () {
    Livewire.on('confirmPurchase', function (name, price, quantity, amount) {
      Swal.fire({
        html: '<h2>Confirma tu pago</h2>' + '<div class="swal2-html-container" id="swal2-html-container" style="display: block;">' + '<p class="description"><span class="bold">Producto: </span>' + name + '</p>' + '<p class="description"><span class="bold">Precio individual: </span>' + price + '</p>' + '<p class="description"><span class="bold">Cantidad: </span>' + quantity + '</p>' + '<p class="description"><span class="bold">Total: </span>' + amount + '</p>' + '</div>',
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Confirmar compra',
        buttonsStyling: false,
        customClass: {
          cancelButton: 'addToCart',
          confirmButton: 'purchaseNow',
          actions: 'buttonsModalContainer'
        }
      }).then(function (result) {
        if (result.isConfirmed) {
          Livewire.emit('purchaseConfirmation');
          Swal.fire({
            html: '<h2>Compra realizada con éxito</h2>' + '<div class="swal2-html-container" id="swal2-html-container" style="display: block;">' + '<p class="description">' + 'Podrás ver sus transacciones en el apartado "Compras", dentro de su perfil' + '</p>' + '</div>',
            icon: 'success',
            showCancelButton: true,
            cancelButtonText: 'Seguir comprando',
            confirmButtonText: 'Ir a "Compras"',
            buttonsStyling: false,
            customClass: {
              cancelButton: 'addToCart',
              confirmButton: 'purchaseNow',
              actions: 'buttonsModalContainer'
            }
          }).then(function (result) {
            if (result.isConfirmed) {
              Livewire.emit('redirectToPurchases');
            }
          });
        }
      });
    });
    Livewire.on('noPaymentMethod', function () {
      Swal.fire({
        html: '<h2>No cuentas con ningún método de pago</h2>' + '<div class="swal2-html-container" id="swal2-html-container" style="display: block;">' + '<p class="description">¿Deseas agregar alguno?</p>' + '</div>',
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: 'No',
        confirmButtonText: 'Agregar',
        buttonsStyling: false,
        customClass: {
          cancelButton: 'addToCart',
          confirmButton: 'purchaseNow',
          actions: 'buttonsModalContainer'
        }
      }).then(function (result) {
        if (result.isConfirmed) {
          Livewire.emit('redirectToPaymentMethods');
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
          cancelButton: 'addToCart',
          confirmButton: 'purchaseNow',
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