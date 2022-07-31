(() => {
    window.addEventListener('load', () => {

        /** Users */

        //Make admin alert
        Livewire.on('makeAdmin', (id) => {
            Swal.fire({
                title: 'Estás seguro de que quieres hacer administrador a este ususario?',
                text: "Ten cuidado a quién confiarle la administración de tu página, " +
                    "esta persona será capaz de modificar la página de la misma forma que tú. " +
                    "Podrás revertir esta acción en cualquier momento mientras seas administrador",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#17a2b8',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Confirmar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('makeAdminConfirmation', id);
                }
            })
        })

        //Block comments alert
        Livewire.on('blockComments', (id) => {
            Swal.fire({
                title: 'Estás seguro de que quieres prohibir la redacción de comentarios a este ususario?',
                text: 'Si este usuario era administrador de la página con anterioridad, ' +
                    'esta capacidad le será removida',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#17a2b8',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Confirmar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('blockCommentsConfirmation', id);
                }
            })
        })

        //Delete user alert
        Livewire.on('deleteUser', (id) => {
            Swal.fire({
                title: 'Estás seguro de que quieres eliminar a este ususario?',
                text: "Esta acción solo debe hacerse como último recurso, en caso de que un cliente " +
                    "acceda a su derecho de cancelación de sus datos. Bajo ninguna circunstancia " +
                    "elimine a un usuario que no se lo ha pedido. Esta acción es permanente y no se " +
                    "puede revertir.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#17a2b8',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Confirmo que quiero eliminar a este usuario',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('deleteUserConfirmation', id);
                }
            })
        })

        /** Products */

        //Eliminate product alert
        Livewire.on('deleteProduct', (id) => {
            Swal.fire({
                title: '¿Estás seguro de que quieres eliminar este producto?',
                text: "Esta acción es irreversible. Los productos desaparecerán de los carritos de los usuarios, " +
                    "sin embargo, el producto quedará registrado en las compras realizadas, y aún tendrás que entregarlo.",
                showCancelButton: true,
                confirmButtonColor: '#17a2b8',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('deleteProductConfirmation', id);
                }
            })
        })

        /** Comments */

        //Edit comment alert
        Livewire.on('editComment', (id, comment) => {
            Swal.fire({
                title: 'Edición del comentario',
                text: "Haz esto solo en caso de que necesites regular la actividad de un usuario",
                input: 'textarea',
                inputValue: comment,
                showCancelButton: true,
                confirmButtonColor: '#17a2b8',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Guardar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('editCommentConfirmation', id, result.value);
                }
            })
        })

        //Eliminate comment alert
        Livewire.on('eliminateComment', (id) => {
            Swal.fire({
                title: '¿Estás seguro de que quieres eliminar esta reseña?',
                text: "Haz esto solo en caso de que necesites regular la actividad de un usuario",
                showCancelButton: true,
                confirmButtonColor: '#17a2b8',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('eliminateCommentConfrimation', id);
                }
            })
        })

        /** Purchases */

        //Update purchase state alert
        Livewire.on('updateState', (id, message) => {
            Swal.fire({
                title: 'Seleccione el estado actual de la compra',
                text: message,
                input: 'select',
                inputOptions: {
                    'Procesando pago': 'Procesando pago',
                    'Enviando': 'Enviando',
                    'Entregado': 'Entregado',
                    'Procesando devolución': 'Procesando devolución',
                    'Devolviendo': 'Devolviendo',
                    'Devuelto': 'Devuelto',
                    'Devolución rechazada': 'Devolución rechazada',
                },
                showCancelButton: true,
                confirmButtonColor: '#17a2b8',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Actualizar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('updateStateConfirmation', id, result.value);
                }
            })
        })

        //Shows the user address and phones
        Livewire.on('showAddress', (address, phones) => {
            let phoneNumbers = '';
            phones.forEach((element, index) => {
                phoneNumbers += '<p><b>Teléfono ' + (index+1) + ': </b>' + element.phone_number + '</p>'
            });
            Swal.fire({
                title: 'Ubicación del usuario',
                html: '<p><b>Estado: </b>' + address.state + '</p>' +
                    '<p><b>Ciudad: </b>' + address.city + '</p>' +
                    '<p><b>Calle y número: </b>' + address.street + '</p>' +
                    '<p><b>Código Postal: </b>' + address.postal_code + '</p>' +
                    phoneNumbers,
                confirmButtonColor: '#17a2b8',
                confirmButtonText: 'Cerrar',
            })
        })

        //Shows the user got no address
        Livewire.on('noAddress', () => {
            Swal.fire({
                title: 'Este usuario no cuenta con ubicación, posiblemente haya sido borrada o aún no fue creada',
                confirmButtonColor: '#17a2b8',
                confirmButtonText: 'Cerrar',
            })
        })

        /** Categories */

        //Create category alert
        Livewire.on('createCategory', () => {
            Swal.fire({
                title: 'Creación de una nueva categoría',
                text: 'La longitud de la categoría debe estar entre 1 y 50 caracteres, de lo ' +
                    'contrario, los cambios serán ignorados',
                input: 'text',
                showCancelButton: true,
                confirmButtonColor: '#17a2b8',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Crear',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('createCategoryConfirmation', result.value);
                }
            })
        })

        //Update category alert
        Livewire.on('updateCategory', (id, category) => {
            Swal.fire({
                title: 'Edición de la categoría',
                text: 'La longitud de la categoría debe estar entre 1 y 50 caracteres, de lo ' +
                    'contrario, los cambios serán ignorados',
                input: 'text',
                inputValue: category,
                showCancelButton: true,
                confirmButtonColor: '#17a2b8',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Guardar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('updateCategoryConfirmation', id, result.value);
                }
            })
        })

        //Delete category alert
        Livewire.on('deleteCategory', (id) => {
            Swal.fire({
                title: '¿Estás seguro de que quieres eliminar esta categoría?',
                text: "Todos los productos que formen parte de esta categoría pasaran a estar sin categoría",
                showCancelButton: true,
                confirmButtonColor: '#17a2b8',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('deleteCategoryConfirmation', id);
                }
            })
        })

        /** Sizes */

        //Create size alert
        Livewire.on('createSize', () => {
            Swal.fire({
                title: 'Creación de un nuevo tamaño',
                text: 'La longitud del tamaño debe estar entre 1 y 50 caracteres, de lo ' +
                    'contrario, los cambios serán ignorados',
                input: 'text',
                showCancelButton: true,
                confirmButtonColor: '#17a2b8',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Crear',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('createSizeConfirmation', result.value);
                }
            })
        })

        //Update size alert
        Livewire.on('updateSize', (id, size) => {
            Swal.fire({
                title: 'Edición del tamaño',
                text: 'La longitud del tamaño debe estar entre 1 y 50 caracteres, de lo ' +
                    'contrario, los cambios serán ignorados',
                input: 'text',
                inputValue: size,
                showCancelButton: true,
                confirmButtonColor: '#17a2b8',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Guardar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('updateSizeConfirmation', id, result.value);
                }
            })
        })

        //Delete size alert
        Livewire.on('deleteSize', (id) => {
            Swal.fire({
                title: '¿Estás seguro de que quieres eliminar este tamaño?',
                text: "Todos los productos que formen parte de este tamaño pasaran a estar sin tamaño",
                showCancelButton: true,
                confirmButtonColor: '#17a2b8',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('deleteSizeConfirmation', id);
                }
            })
        })
    });
})();