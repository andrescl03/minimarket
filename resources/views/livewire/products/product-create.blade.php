<div>
    @section('titulo')
    <h2>Registro de nuevo producto</h2>
    @endsection
    <div x-data="data()" class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Form-->
            <form id="kt_ecommerce_add_product_form" wire:submit.prevent="submit"
                class="form d-flex flex-column flex-lg-row">
                <!--begin::Aside column-->
                <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                    <!--begin::Thumbnail settings-->
                    <div class="card card-flush py-4">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2>Imagen del producto</h2>
                            </div>
                            <!--end::Card title-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body text-center pt-0">
                            <!--begin::Image input-->
                            <!--begin::Image input placeholder-->
                            <style>
                                .image-input-placeholder {
                                    background-image: url('/assets/metronic/media/svg/files/blank-image.svg');
                                }

                                [data-theme="dark"] .image-input-placeholder {
                                    background-image: url('/assets/metronic/media/svg/files/blank-image-dark.svg');
                                }
                            </style>
                            <!--end::Image input placeholder-->
                            <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3">
                                <!--begin::Preview existing avatar-->
                                <div class="image-input-wrapper w-150px h-150px"
                                    style="background-image: url({{ $photo ? $photo->temporaryUrl() : '' }});">
                                </div>
                                <!--end::Preview existing avatar-->
                                <!--begin::Label-->
                                <label
                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Cambiar imagen">
                                    <i class="bi bi-pencil-fill fs-7"></i>
                                    <!--begin::Inputs-->
                                    <input wire:model.defer="photo" type="file" name="avatar"
                                        accept=".png, .jpg, .jpeg" />
                                    <input type="hidden" name="avatar_remove" />
                                    <!--end::Inputs-->
                                </label>
                                <!--end::Label-->
                                <!--begin::Cancel-->
                                <span
                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                    <i class="bi bi-x fs-2"></i>
                                </span>
                                <!--end::Cancel-->
                                <!--begin::Remove-->
                                <span
                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                    <i class="bi bi-x fs-2"></i>
                                </span>
                                <!--end::Remove-->
                            </div>
                            <!--end::Image input-->
                            <!--begin::Description-->
                            <div class="text-muted fs-7">Establezca la imagen en miniatura del producto. Solo imagen
                                *.png, *.jpg y *.jpeg</div>
                            @error('photo')
                            <span class="error text-danger">{{ $message }}</span>
                            @enderror
                            <!--end::Description-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Thumbnail settings-->
                    <!--begin::Status-->
                    <div class="card card-flush py-4">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2>Estado</h2>
                            </div>
                            <!--end::Card title-->
                            <!--begin::Card toolbar-->
                            <div class="card-toolbar">
                                <div class="rounded-circle bg-success w-15px h-15px"
                                    id="kt_ecommerce_add_product_status">
                                </div>
                            </div>
                            <!--begin::Card toolbar-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <!--begin::Select2-->
                            <select class="form-select mb-2" data-control="select2" data-hide-search="true"
                                data-placeholder="Seleccione una opción" id="kt_ecommerce_add_product_status_select"
                                wire:model.defer="state">
                                @foreach ($states as $state)
                                <option value="{{ $state->id }}">{{ $state->name }}</option>
                                @endforeach
                            </select>
                            <!--end::Select2-->
                            <!--begin::Description-->
                            <div class="text-muted fs-7">Establezca el estado del producto.</div>
                            <!--end::Description-->
                            @error('state')
                            <span class="error text-danger">{{ $message }}</span>
                            @enderror

                            <!--begin::Datepicker-->
                            <div class="d-none mt-10">
                                <label for="kt_ecommerce_add_product_status_datepicker" class="form-label">Select
                                    publishing date and time</label>
                                <input class="form-control" id="kt_ecommerce_add_product_status_datepicker"
                                    placeholder="Pick date & time" />
                            </div>
                            <!--end::Datepicker-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Status-->
                    <!--begin::Category & tags-->
                    <div class="card card-flush py-4">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2>Detalle del producto</h2>
                            </div>
                            <!--end::Card title-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <!--begin::Input group-->
                            <!--begin::Label-->
                            <label class="form-label">Categoría</label>
                            <!--end::Label-->
                            <!--begin::Select2-->
                            <select class="form-select mb-2" wire:model.defer="category" data-control="select2"
                                data-placeholder="Seleccione una categoría">
                                <option></option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category')
                            <span class="error text-danger">{{ $message }}</span>
                            @enderror
                            <!--end::Select2-->
                            <!--begin::Description-->
                            <div class="text-muted fs-7 mb-7">Añadir producto a una categoría.</div>
                            <!--end::Description-->
                            <!--end::Input group-->
                            <!--begin::Button-->
                            <a href="{{ route('categories.index') }}" class="btn btn-light-primary btn-sm mb-10">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr087.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1"
                                            transform="rotate(-90 11 18)" fill="currentColor" />
                                        <rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->Ver módulo de categorías
                            </a>
                            <!--end::Button-->
                            <!--begin::Input group-->
                            <!--begin::Label-->
                            {{-- <label class="form-label d-block">Etiquetas</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input id="kt_ecommerce_add_product_tags" name="kt_ecommerce_add_product_tags"
                                class="form-control mb-2" />
                            <!--end::Input-->
                            <!--begin::Description-->
                            <div class="text-muted fs-7">Agregue etiquetas al producto.</div> --}}
                            <!--end::Description-->
                            <!--end::Input group-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Category & tags-->

                </div>
                <!--end::Aside column-->
                <!--begin::Main column-->
                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                    <!--begin:::Tabs-->
                    <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-n2">
                        <!--begin:::Tab item-->
                        <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab"
                                href="#kt_ecommerce_add_product_general">General</a>
                        </li>
                        <!--end:::Tab item-->
                        <!--begin:::Tab item-->
                        <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
                                href="#kt_ecommerce_add_product_advanced">Avanzado</a>
                        </li>
                        <!--end:::Tab item-->
                    </ul>
                    <!--end:::Tabs-->
                    <!--begin::Tab content-->
                    <div class="tab-content">
                        <!--begin::Tab pane-->
                        <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                            <div class="d-flex flex-column gap-7 gap-lg-10">
                                <!--begin::General options-->
                                <div class="card card-flush py-4">
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>General</h2>
                                        </div>
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-0">
                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="required form-label">Nombre del producto</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" name="product_name" class="form-control mb-2"
                                                placeholder="Nombre del producto" wire:model.defer="name" />
                                            <!--end::Input-->
                                            <!--begin::Description-->
                                            <div class="text-muted fs-7">Se requiere un nombre de producto y se
                                                recomienda que sea único.</div>
                                            <!--end::Description-->
                                            @error('name')
                                            <span class="error text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div>
                                            <!--begin::Label-->
                                            <label class="required form-label">Descripción del producto</label>
                                            <!--end::Label-->
                                            <!--begin::Editor-->
                                            <textarea type="text" name="description" class="form-control mb-2"
                                                placeholder="Descripción del producto"
                                                wire:model.defer="description"></textarea>
                                            <!--end::Editor-->
                                            <!--begin::Description-->
                                            <div class="text-muted fs-7">Establezca una descripción para el producto
                                                para una mejor visibilidad.</div>
                                            <!--end::Description-->
                                            @error('description')
                                            <span class="error text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <!--end::Card header-->
                                </div>
                                <!--end::General options-->
                                <!--begin::Media-->
                                <div class="card card-flush py-4">
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>Imágenes</h2>
                                        </div>
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-0">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-2">
                                            <input accept=".png, .jpg, .jpeg" type="file" class="form-control"
                                                wire:model.defer="files" multiple>
                                            <div wire:loading wire:target="files">
                                                <span class="text-success">Cargando
                                                    imágenes...</span>
                                            </div>

                                            <!--begin::Description-->
                                            <div class="text-muted fs-7">Configure la galería multimedia del producto.
                                            </div>
                                            @error('files.*')
                                            <span class="text-danger error">{{ $message }}</span>
                                            @enderror
                                            <!--end::Description-->
                                        </div>
                                        <!--end::Description-->
                                    </div>

                                    <div class="card-body pt-0">
                                        @foreach ($files as $file)
                                        <div
                                            class="image-input image-input-empty image-input-outline image-input-placeholder mb-3">
                                            <div class="image-input-wrapper w-150px h-150px "
                                                style="background-image: url({{ $file ? $file->temporaryUrl() : '' }});">
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>

                                    <!--end::Card header-->
                                </div>
                                <!--end::Media-->
                                <!--begin::Pricing-->
                                <div class="card card-flush py-4">
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>{{ Str::upper('Precio') }}</h2>
                                        </div>
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-0">
                                        <!--begin::Input group-->
                                        <div class="mb-8 fv-row">
                                            <!--begin::Label-->
                                            <label class="required form-label">Precio de compra</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input @click="calcularGanancia()" type="text" name="price"
                                                class="form-control mb-2" placeholder="Precio de compra"
                                                wire:model.defer="sale_suggested" />

                                            <!--end::Input-->
                                            <!--begin::Description-->
                                            <div class="text-muted fs-7">Establecer el precio de compra del producto.
                                            </div>
                                            <!--end::Description-->
                                            @error('purcharse')
                                            <span class="error text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <div class="mb-8 fv-row">
                                            <label class="required form-label">Precio de venta sugerido
                                                para el público</label>
                                            <input @keyup.page-down="calcularGanancia()" type="text" name="price"
                                                class="form-control mb-2" placeholder="Precio de venta sugerido"
                                                wire:model.defer="purcharse" />
                                            <div class="text-muted fs-7">Establecer el precio sugerido del producto.
                                            </div>
                                            @error('sale_suggested')
                                            <span class="error text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-8 fv-row">
                                            <!--begin::Label-->
                                            <label class="form-label">ganancia del producto</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" readonly class="form-control mb-2" />
                                            <!--end::Input-->
                                            <!--begin::Description-->
                                            <div class="text-muted fs-7">Calculo automático entre el precio de compra y
                                                precio de venta sugerido.
                                            </div>

                                            <!--end::Description-->
                                        </div>
                                        <!--end::Input group-->

                                    </div>
                                    <!--end::Card header-->
                                </div>
                                <!--end::Pricing-->
                            </div>
                        </div>
                        <!--end::Tab pane-->
                        <!--begin::Tab pane-->
                        <div class="tab-pane fade" id="kt_ecommerce_add_product_advanced" role="tab-panel">
                            <div class="d-flex flex-column gap-7 gap-lg-10">
                                <!--begin::Inventory-->
                                <div class="card card-flush py-4">
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>Inventario</h2>
                                        </div>
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-0">
                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="required form-label">SKU</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" name="sku" class="form-control mb-2"
                                                placeholder="SKU del producto" wire:model.defer="sku" />
                                            <!--end::Input-->
                                            <!--begin::Description-->
                                            <div class="text-muted fs-7">Ingrese el SKU del producto.</div>
                                            @error('sku')
                                            <span class="error text-danger">{{ $message }}</span>
                                            @enderror
                                            <!--end::Description-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="required form-label">Cantidad</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <div class="d-flex gap-3">
                                                <input type="number" name="shelf" class="form-control mb-2"
                                                    placeholder="En tienda" wire:model.defer="stock" />
                                                {{-- <input type="number" name="warehouse" class="form-control mb-2"
                                                    placeholder="In warehouse" /> --}}
                                            </div>
                                            <!--end::Input-->
                                            <!--begin::Description-->
                                            <div class="text-muted fs-7">Ingrese la cantidad del producto.</div>
                                            <!--end::Description-->
                                            @error('stock')
                                            <span class="error text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <!--end::Input group-->

                                    </div>
                                    <!--end::Card header-->
                                </div>
                                <!--end::Inventory-->
                                <!--begin::Variations-->
                                <div class="card card-flush py-4">
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>Variaciones</h2>
                                        </div>
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-0">
                                        <!--begin::Input group-->
                                        <div class="" data-kt-ecommerce-catalog-add-product="auto-options">
                                            <!--begin::Label-->
                                            <label class="form-label">Agregar variaciones del producto</label>
                                            <!--end::Label-->
                                            <!--begin::Repeater-->
                                            <div id="kt_ecommerce_add_product_options">
                                                <!--begin::Form group-->
                                                <div class="form-group">
                                                    <div data-repeater-list="kt_ecommerce_add_product_options"
                                                        class="d-flex flex-column gap-3">
                                                        <div data-repeater-item=""
                                                            class="form-group d-flex flex-wrap align-items-center gap-5">
                                                            <!--begin::Select2-->
                                                            <div class="w-100 w-md-200px">
                                                                <select class="form-select" name="product_option"
                                                                    data-placeholder="Seleccione una variación  "
                                                                    data-kt-ecommerce-catalog-add-product="product_option">
                                                                    <option></option>
                                                                    @foreach ($type_variations as $type_variation)
                                                                    <option value="{{ $type_variation->id }}">
                                                                        {{ $type_variation->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <!--end::Select2-->
                                                            <!--begin::Input-->
                                                            <input type="text" class="form-control mw-100 w-200px"
                                                                name="product_option_value" placeholder="Variación" />
                                                            <!--end::Input-->
                                                            <button type="button" data-repeater-delete=""
                                                                class="btn btn-sm btn-icon btn-light-danger">
                                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr088.svg-->
                                                                <span class="svg-icon svg-icon-1">
                                                                    <svg width="24" height="24" viewBox="0 0 24 24"
                                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <rect opacity="0.5" x="7.05025" y="15.5356"
                                                                            width="12" height="2" rx="1"
                                                                            transform="rotate(-45 7.05025 15.5356)"
                                                                            fill="currentColor" />
                                                                        <rect x="8.46447" y="7.05029" width="12"
                                                                            height="2" rx="1"
                                                                            transform="rotate(45 8.46447 7.05029)"
                                                                            fill="currentColor" />
                                                                    </svg>
                                                                </span>
                                                                <!--end::Svg Icon-->
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end::Form group-->
                                                <!--begin::Form group-->
                                                <div class="form-group mt-5">
                                                    <button {{-- @click="addSelectVariation()" --}} type="button"
                                                        data-repeater-create="" class="btn btn-sm btn-light-primary">
                                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr087.svg-->
                                                        <span class="svg-icon svg-icon-2">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <rect opacity="0.5" x="11" y="18" width="12" height="2"
                                                                    rx="1" transform="rotate(-90 11 18)"
                                                                    fill="currentColor" />
                                                                <rect x="6" y="11" width="12" height="2" rx="1"
                                                                    fill="currentColor" />
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->Agregar otra variación
                                                    </button>
                                                </div>
                                                <!--end::Form group-->
                                            </div>
                                            <!--end::Repeater-->
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <!--end::Card header-->
                                </div>
                                <!--end::Variations-->
                                <!--begin::Shipping-->


                                <div class="card card-flush py-4">
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>Envío a domicilio</h2>
                                        </div>
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-0">
                                        <!--begin::Input group-->
                                        <div class="fv-row">
                                            <!--begin::Input-->
                                            <div class="form-check form-check-custom form-check-solid mb-2">
                                                <input class="form-check-input" type="checkbox"
                                                    id="kt_ecommerce_add_product_shipping_checkbox" value="1"
                                                    wire:model.defer="delivery" />
                                                <label class="form-check-label">¿Este producto se envía a
                                                    domicilio?</label>
                                            </div>
                                            <!--end::Input-->
                                            <!--begin::Description-->
                                            <div class="text-muted fs-7">Envío a domicilio a través de RAPPI,
                                                PedidosYa, Etc.</div>
                                            @error('delivery')
                                            <span class="error text-danger">{{ $message }}</span>
                                            @enderror
                                            <!--end::Description-->
                                        </div>
                                        <!--end::Input group-->

                                    </div>
                                    <!--end::Card header-->
                                </div>
                                <!--end::Shipping-->

                            </div>
                        </div>
                        <!--end::Tab pane-->
                    </div>
                    <!--end::Tab content-->
                    <div class="d-flex justify-content-end">
                        <!--begin::Button-->
                        <a {{-- href="{{ route('products.index') }}" --}} wire:click="click"
                            id="kt_ecommerce_add_product_cancel" class="btn btn-light me-5">Cancelar</a>
                        <!--end::Button-->
                        <!--begin::Button-->
                        <button @click="addSelectVariation()" id="kt_ecommerce_add_product_submit" type="submit"
                            class="btn btn-primary">
                            <span class="indicator-label">Registrar</span>
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                        <!--end::Button-->
                    </div>
                </div>
                <!--end::Main column-->
            </form>
            <!--end::Form-->
        </div>
        <!--end::Container-->
    </div>
    @push('scripts')
    @vite('resources/js/products/create-product.js')
    <script>
        function data(){
                return {
                    calcularGanancia(){

                       
                    }
                    addSelectVariation() {
                        @this.set('type_variation', $('#kt_ecommerce_add_product_options').repeaterVal())
                    }
                }
            }
          
            window.addEventListener('show-notification', event => {

                Swal.fire({
                    title: event.detail.title,
                    text: '¿Desea registrar otro producto?',
                    icon: "success",
                    showCancelButton: true,
                    confirmButtonText: "Sí, continuar registrando otro producto",
                    cancelButtonText: "No, regresar a la lista de productos",
                    reverseButtons: true
                }).then(function(result) {
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
                        window.location.href = "{{ route('products.index') }}";
                    }
                });
            });
    </script>
    @endpush
</div>