<div x-data="data()">
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div id="kt_content_container" class="container-xxl">
            <div class="card">
                <div class="card-header border-0 pt-6">
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1">
                            <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                                        transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                    <path
                                        d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                        fill="currentColor" />
                                </svg>
                            </span>
                            <input type="text" data-kt-user-table-filter="search" wire:model="search"
                                class="form-control form-control-solid w-250px ps-14" placeholder="Buscar productos" />
                        </div>
                    </div>
                    <div class="card-toolbar">
                        <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                            <a href="{{ route('product.create') }}" type="button" class="btn btn-success">
                                <span class="svg-icon svg-icon-2">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1"
                                            transform="rotate(-90 11.364 20.364)" fill="currentColor" />
                                        <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor" />
                                    </svg>
                                </span>
                                Nuevo producto
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body py-4">
                    <div class="table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                            <thead>
                                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                    <th class="text-center min-w-100px">Nombre</th>
                                    <th class="text-center min-w-100px">Imagen</th>
                                    <th class="text-center min-w-100px">SKU</th>
                                    <th class="text-center min-w-100px">Precio de venta sugerido</th>
                                    <th class="text-center min-w-100px">Precio de compra</th>
                                    <th class="text-center min-w-100px">Cantidad disponible</th>
                                    <th class="text-center min-w-100px">Categoría</th>
                                    <th class="text-center min-w-100px">Fecha de registro</th>
                                    <th class="text-center min-w-100px">Fecha de actualización</th>
                                    <th class="text-center min-w-100px">Estado</th>
                                    <th class="text-center min-w-100px">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class=" text-center text-gray-600 fw-semibold">
                                @foreach ($products as $product)
                                <tr>
                                    <td>
                                        <span>{{ $product->name }}</span>
                                    </td>
                                    <td>
                                        @if($product->photo)
                                        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                            <a target="_blank" href="{{ asset('storage') }}/{{ $product->photo }}">
                                                <div class="symbol-label">
                                                    <img src="{{ asset('storage') }}/{{ $product->photo }}"
                                                        alt="{{ $product->name }}" class="w-100" />
                                                </div>
                                            </a>
                                        </div>
                                        @else
                                        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                            <a>
                                                <div class="symbol-label fs-3  bg-light-success text-primary">
                                                    {{ Str::upper(substr($product->name, 0, 1)) }}
                                                </div>
                                            </a>
                                        </div>
                                        @endif
                                    </td>
                                    <td>{{ $product->sku }}</td>
                                    <td>{{ $product->sale_suggested }}</td>
                                    <td>{{ $product->purcharse }}</td>
                                    @if ($product->stock <= 5) <td>
                                        <span class="badge badge-light-warning">Bajo stock</span>
                                        <span class="fw-bold text-warning ms-3">{{ $product->stock }}</span>
                                        </td>
                                        @elseif ($product->stock > 5)
                                        <td>
                                            <span class="fw-bold text-success ms-3">{{ $product->stock }}</span>
                                        </td>
                                        @else
                                        <td>
                                            <span class="badge badge-light-danger">Sin stock</span>
                                            <span class="fw-bold text-success ms-3">{{ $product->stock }}</span>
                                        </td>
                                        @endif
                                        <td>{{ $product->category->name }}</td>
                                        <td>
                                            <div class="badge badge-light fw-bold">
                                                {{ $product->created_at->diffForHumans() }}</div>
                                        </td>
                                        <td>
                                            <div class="badge badge-light fw-bold">
                                                {{ $product->updated_at->diffForHumans() }}</div>
                                        </td>
                                        <td>
                                            @if (Str::upper($product->state->name) == 'PUBLICADO')
                                            <div class="badge badge-light-success fw-bold">
                                                {{ $product->state->name }}</div>
                                            @elseif (Str::upper($product->state->name) == 'BORRADOR')
                                            <div class="badge badge-light-primary fw-bold">
                                                {{ $product->state->name }}</div>
                                            @elseif (Str::upper($product->state->name) == 'PROGRAMADA')
                                            <div class="badge badge-light-warning fw-bold">
                                                {{ $product->state->name }}</div>
                                            @else
                                            <div class="badge badge-light-danger fw-bold">
                                                {{ $product->state->name }}</div>
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            <a href="#" class="btn btn-light btn-active-light-primary btn-sm"
                                                data-kt-menu-trigger="click"
                                                data-kt-menu-placement="bottom-end">Acciones
                                                <span class="svg-icon svg-icon-5 m-0">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                                                            fill="currentColor" />
                                                    </svg>
                                                </span>
                                            </a>
                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                data-kt-menu="true">
                                                <div class="menu-item px-3">
                                                    <a href="{{route('product.edit', ['product' => $product->slug])}}"
                                                        class="menu-link px-3">Editar</a>
                                                </div>
                                                <div class="menu-item px-3">
                                                    <a @click="deleteConfirmation({{ $product->id }})"
                                                        class="menu-link px-3"
                                                        data-kt-users-table-filter="delete_row">eliminar</a>
                                                </div>
                                            </div>
                                        </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="my-10">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function data(){
                return {
                    deleteConfirmation: function (id){
                        Swal.fire({
                            title: "Eliminar",
                            text: "¿Está seguro que desea eliminar el usuario?",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonText: "Sí, eliminar!"
                            }).then(function(result) {
                                    if (result.value) {
                                 Livewire.emit('delete-product',id);
                                 }
                             });
                    },
                    
                 }
            }

            window.addEventListener('show-notification-destroy', event => {
                Swal.fire("INFORMACIÓN", event.detail.title, "success");
            });
    </script>
    @endpush

</div>