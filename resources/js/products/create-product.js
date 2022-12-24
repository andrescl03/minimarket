"use strict";

// Class definition


var KTAppEcommerceSaveProduct = function () {


    // Private functions

    // Init quill editor
    const initQuill = () => {
        // Define all elements for quill editor
        const elements = [
            '#kt_ecommerce_add_product_description',
            '#kt_ecommerce_add_product_meta_description'
        ];

        // Loop all elements
        elements.forEach(element => {
            // Get quill element
            let quill = document.querySelector(element);

            // Break if element not found
            if (!quill) {
                return;
            }

            // Init quill --- more info: https://quilljs.com/docs/quickstart/
            quill = new Quill(element, {
                modules: {
                    toolbar: [
                        [{
                            header: [1, 2, false]
                        }],
                        ['bold', 'italic', 'underline'],
                        ['image', 'code-block']
                    ]
                },
                placeholder: 'Type your text here...',
                theme: 'snow' // or 'bubble'
            });
        });
    }

    // Init tagify
    const initTagify = () => {
        // Define all elements for tagify
        const elements = [
            '#kt_ecommerce_add_product_category',
            '#kt_ecommerce_add_product_tags'
        ];

        // Loop all elements
        elements.forEach(element => {
            // Get tagify element
            const tagify = document.querySelector(element);

            // Break if element not found
            if (!tagify) {
                return;
            }

            // Init tagify --- more info: https://yaireo.github.io/tagify/
            new Tagify(tagify, {
                whitelist: ["new", "trending", "sale", "discounted", "selling fast", "last 10"],
                dropdown: {
                    maxItems: 20,           // <- mixumum allowed rendered suggestions
                    classname: "tagify__inline__suggestions", // <- custom classname for this dropdown, so it could be targeted
                    enabled: 0,             // <- show suggestions on focus
                    closeOnSelect: false    // <- do not hide the suggestions dropdown once an item has been selected
                }
            });
        });
    }

    // Init form repeater --- more info: https://github.com/DubFriend/jquery.repeater
    const initFormRepeater = () => {

        $('#kt_ecommerce_add_product_options').repeater({
            initEmpty: false,
            defaultValues: {
                'text-input': 'foo'
            },

            show: function () {
                $(this).slideDown();

                // Init select2 on new repeated items
                initConditionsSelect2();
            },
            hide: function (deleteElement) {
                console.log(deleteElement);
                $(this).slideUp(deleteElement);
            }
        });
    }

    // Init condition select2
    const initConditionsSelect2 = () => {
        // Tnit new repeating condition types 

        const allConditionTypes = document.querySelectorAll('[data-kt-ecommerce-catalog-add-product="product_option"]');

        console.log(allConditionTypes);

        allConditionTypes.forEach(type => {
            if ($(type).hasClass("select2-hidden-accessible")) {

                return;
            } else {
                $(type).select2({
                    minimumResultsForSearch: -1
                });
            }
        });
    }


    // Category status handler
    const handleStatus = () => {
        const target = document.getElementById('kt_ecommerce_add_product_status');
        const select = document.getElementById('kt_ecommerce_add_product_status_select');
        const statusClasses = ['bg-success', 'bg-warning', 'bg-danger'];

        $(select).on('change', function (e) {
            const value = e.target.value;

            switch (value) {
                case "1": {
                    target.classList.remove(...statusClasses);
                    target.classList.add('bg-success');
                    hideDatepicker();
                    break;
                }
                case "2": {
                    target.classList.remove(...statusClasses);
                    target.classList.add('bg-primary');
                    hideDatepicker();
                    break;
                }
                case "3": {
                    target.classList.remove(...statusClasses);
                    target.classList.add('bg-warning');
                    showDatepicker();
                    break;
                }
                case "4": {
                    target.classList.remove(...statusClasses);
                    target.classList.add('bg-danger');
                    hideDatepicker();
                    break;
                }

                default:
                    break;
            }
        });


        // Handle datepicker
        const datepicker = document.getElementById('kt_ecommerce_add_product_status_datepicker');

        // Init flatpickr --- more info: https://flatpickr.js.org/
        $('#kt_ecommerce_add_product_status_datepicker').flatpickr({
            enableTime: true,
            dateFormat: "Y-m-d H:i",
        });

        const showDatepicker = () => {
            datepicker.parentNode.classList.remove('d-none');
        }

        const hideDatepicker = () => {
            datepicker.parentNode.classList.add('d-none');
        }
    }


    // Public methods
    return {
        init: function () {
            // Init forms
            initQuill();
            initTagify();
            initFormRepeater();
            initConditionsSelect2();
            // Handle forms
            handleStatus();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTAppEcommerceSaveProduct.init();


});


window.addEventListener('show-notification', event => {
    Swal.fire({
        title: event.detail.title,
        text: '¿Desea registrar otro producto?',
        icon: "success",
        showCancelButton: true,
        confirmButtonText: "Sí, continuar registrando otro producto",
        cancelButtonText: "No, regresar a la lista de productos",
        reverseButtons: true
    }).then(function (result) {
        if (result.value) {
            Swal.fire(
                "IMPORTANTE",
                "Por favor, ingrese nuevamente los campos solicitados para registrar.",
                "success"
            )
        } else if (result.dismiss === "cancel") {
            Swal.fire(
                "saliendo...",
                "Regresando al listado de productos",
                "warning"
            )
            window.location.href = route('products.index');
        }
    });
});

window.addEventListener('show-message', event => {

    Swal.fire({
        buttonsStyling: false,
        confirmButtonText: "Ok, Continuar!",
        title: "ERROR",
        html: "Lo sentimos, parece que se han detectado algunos errores, inténtalo de nuevo. <br/><br/>Tenga en cuenta que puede haber errores en las pestañas <strong>General</strong> o <strong>Avanzado</strong>",
        icon: "error",
        customClass: {
            confirmButton: "btn btn-primary"
        }
    });

});



