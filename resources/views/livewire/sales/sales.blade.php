<div>
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Layout-->
            <div class="d-flex flex-column flex-xl-row">
                <!--begin::Content-->
                <div class="d-flex flex-row-fluid me-xl-9 mb-10 mb-xl-0">
                    <!--begin::Pos food-->
                    <div class="card card-flush card-p-0 bg-transparent border-0">
                        <!--begin::Body-->
                        <div class="card-body">
                            <!--begin::Nav-->
                            <ul class="nav nav-pills d-flex justify-content-between nav-pills-custom gap-3 mb-6">
                                <!--begin::Item-->

                                @foreach ( $categories as $category )

                                <li class="nav-item mb-3 me-0">
                                    <!--begin::Nav link-->
                                    <a class="nav-link nav-link-border-solid btn btn-outline btn-flex btn-active-color-primary flex-column flex-stack pt-9 pb-7 page-bg "
                                        data-bs-toggle="pill" href="#kt_pos_food_content_{{$category->id}}"
                                        style="width: 138px;height: 180px">
                                        <!--begin::Icon-->
                                        <div class="nav-icon mb-3">
                                            <!--begin::Food icon-->
                                            @forelse ($category->files as $file)
                                            @if ($loop->last)
                                            <img src="{{ asset('storage') }}/{{ $file->url }}" alt="{{ $file->name }}"
                                                class="w-50px" />
                                            @endif
                                            @empty
                                            <div class="symbol-label fs-3   text-primary">
                                                {{ Str::upper(substr($category->name, 0, 1)) }}
                                            </div>
                                            @endforelse

                                            <!--end::Food icon-->
                                        </div>
                                        <!--end::Icon-->
                                        <!--begin::Info-->
                                        <div>
                                            <span class="text-gray-800 fw-bold fs-2 d-block">{{$category->name}}</span>
                                            <span
                                                class="text-gray-400 fw-semibold fs-7">{{$category->products()->count()
                                                . ' ' . $category->name}}</span>
                                        </div>
                                        <!--end::Info-->
                                    </a>
                                    <!--end::Nav link-->
                                </li>
                                @endforeach

                            </ul>
                            <!--end::Nav-->
                            <!--begin::Tab Content-->
                            <div class="tab-content">
                                <!--begin::Tap pane-->

                                @foreach( $categories as $category )

                                <div class="tab-pane fade {{-- show active --}}"
                                    id="kt_pos_food_content_{{$category->id}}">
                                    <!--begin::Wrapper-->
                                    <div class="d-flex flex-wrap d-grid gap-5 gap-xxl-9">
                                        @foreach ($category->products as $product )
                                        <!--begin::Card-->

                                        <div class="card card-flush flex-row-fluid p-6 pb-5 mw-100">
                                            <!--begin::Body-->

                                            <form wire:submit.prevent="submit({{$product->id}})">

                                                <div class="card-body text-center">
                                                    <!--begin::Food img-->
                                                    <img src="{{ asset('storage') }}/{{ $product->photo }}"
                                                        alt="{{ $product->name }}"
                                                        class="rounded-3 mb-4 w-150px h-150px w-xxl-200px h-xxl-200px" />
                                                    <!--end::Food img-->
                                                    <!--begin::Info-->
                                                    <div class="mb-2">
                                                        <!--begin::Title-->
                                                        <div class="text-center">
                                                            <span
                                                                class="fw-bold text-gray-800 cursor-pointer text-hover-primary fs-3 fs-xl-1">{{$product->name}}</span>
                                                            <span
                                                                class="text-gray-400 fw-semibold d-block fs-6 mt-n1">{{$product->stock}}
                                                                cantidades disponibles</span>
                                                        </div>
                                                        <!--end::Title-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Total-->
                                                    <span class="text-success text-end fw-bold fs-1">S/.
                                                        {{$product->sale_suggested}}</span>
                                                    <button type="submit" class="btn btn-sm btn-info w-100 py-4">agregar
                                                        al
                                                        carrito</button>
                                                    <!--end::Total-->
                                                </div>
                                                <!--end::Body-->
                                            </form>

                                        </div>
                                        <!--end::Card-->
                                        @endforeach
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                @endforeach
                                <!--end::Tap pane-->
                            </div>
                            <!--end::Tab Content-->
                        </div>
                        <!--end: Card Body-->
                    </div>
                    <!--end::Pos food-->
                </div>
                <!--end::Content-->
                <!--begin::Sidebar-->
                <div class="flex-row-auto w-xl-425px">
                    <!--begin::Pos order-->
                    <div class="card card-flush bg-body" id="kt_pos_form">
                        <!--begin::Header-->
                        <div class="card-header pt-5">
                            <h3 class="card-title fw-bold text-gray-800 fs-2qx">Orden actual</h3>
                            <!--begin::Toolbar-->
                            <div class="card-toolbar">
                                <a href="#" class="btn btn-light-primary fs-4 fw-bold py-4">Limpiar todo</a>
                            </div>
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body pt-0">
                            <!--begin::Table container-->
                            <div class="table-responsive mb-8">
                                <!--begin::Table-->
                                <table class="table align-middle gs-0 gy-4 my-0">
                                    <!--begin::Table head-->
                                    <thead>
                                        <tr>
                                            <th class="min-w-175px"></th>
                                            <th class="w-125px"></th>
                                            <th class="w-60px"></th>
                                        </tr>
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody>

                                        @foreach ( $productsCart as $productCart )
                                        <tr data-kt-pos-element="item" data-kt-pos-item-price="33">
                                            <td class="pe-0">
                                                <div class="d-flex align-items-center">
                                                    <img src="/assets/metronic/media/stock/food/img-2.jpg"
                                                        class="w-50px h-50px rounded-3 me-3" alt="" />
                                                    <span
                                                        class="fw-bold text-gray-800 cursor-pointer text-hover-primary fs-6 me-1">{{$productCart->name}}</span>
                                                </div>
                                            </td>
                                            <td class="pe-0">
                                                <!--begin::Dialer-->
                                                <div class="position-relative d-flex align-items-center"
                                                    data-kt-dialer="true" data-kt-dialer-min="1" data-kt-dialer-max="10"
                                                    data-kt-dialer-step="1" data-kt-dialer-decimals="0">
                                                    <!--begin::Decrease control-->
                                                    <button type="button"
                                                        class="btn btn-icon btn-sm btn-light btn-icon-gray-400"
                                                        data-kt-dialer-control="decrease">
                                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr089.svg-->
                                                        <span class="svg-icon svg-icon-3x">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <rect x="6" y="11" width="12" height="2" rx="1"
                                                                    fill="currentColor" />
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->
                                                    </button>
                                                    <!--end::Decrease control-->
                                                    <!--begin::Input control-->
                                                    <input type="text"
                                                        class="form-control border-0 text-center px-0 fs-3 fw-bold text-gray-800 w-30px"
                                                        data-kt-dialer-control="input" placeholder="Amount"
                                                        name="manageBudget" readonly="readonly" value="2" />
                                                    <!--end::Input control-->
                                                    <!--begin::Increase control-->
                                                    <button type="button"
                                                        class="btn btn-icon btn-sm btn-light btn-icon-gray-400"
                                                        data-kt-dialer-control="increase">
                                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr087.svg-->
                                                        <span class="svg-icon svg-icon-3x">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <rect opacity="0.5" x="11" y="18" width="12" height="2"
                                                                    rx="1" transform="rotate(-90 11 18)"
                                                                    fill="currentColor" />
                                                                <rect x="6" y="11" width="12" height="2" rx="1"
                                                                    fill="currentColor" />
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->
                                                    </button>
                                                    <!--end::Increase control-->
                                                </div>
                                                <!--end::Dialer-->
                                            </td>
                                            <td class="text-end">
                                                <span class="fw-bold text-primary fs-2"
                                                    data-kt-pos-element="item-total">$66.00</span>
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                    <!--end::Table body-->
                                </table>
                                <!--end::Table-->
                            </div>
                            <!--end::Table container-->
                            <!--begin::Summary-->
                            <div class="d-flex flex-stack bg-success rounded-3 p-6 mb-11">
                                <!--begin::Content-->
                                <div class="fs-6 fw-bold text-white">
                                    <span class="d-block lh-1 mb-2">Subtotal</span>
                                    <span class="d-block mb-2">Discounts</span>
                                    <span class="d-block mb-9">Tax(12%)</span>
                                    <span class="d-block fs-2qx lh-1">Total</span>
                                </div>
                                <!--end::Content-->
                                <!--begin::Content-->
                                <div class="fs-6 fw-bold text-white text-end">
                                    <span class="d-block lh-1 mb-2" data-kt-pos-element="total">$100.50</span>
                                    <span class="d-block mb-2" data-kt-pos-element="discount">-$8.00</span>
                                    <span class="d-block mb-9" data-kt-pos-element="tax">$11.20</span>
                                    <span class="d-block fs-2qx lh-1" data-kt-pos-element="grant-total">$93.46</span>
                                </div>
                                <!--end::Content-->
                            </div>
                            <!--end::Summary-->
                            <!--begin::Payment Method-->
                            <div class="m-0">
                                <!--begin::Title-->
                                <h1 class="fw-bold text-gray-800 mb-5">Método de pago</h1>
                                <!--end::Title-->
                                <!--begin::Radio group-->
                                <div class="d-flex flex-equal gap-5 gap-xxl-9 px-0 mb-12" data-kt-buttons="true"
                                    data-kt-buttons-target="[data-kt-button]">
                                    <!--begin::Radio-->
                                    <label
                                        class="btn bg-light btn-color-gray-600 btn-active-text-gray-800 border border-3 border-gray-100 border-active-primary btn-active-light-primary w-100 px-4"
                                        data-kt-button="true">
                                        <!--begin::Input-->
                                        <input class="btn-check" type="radio" name="method" value="0" />
                                        <!--end::Input-->
                                        <!--begin::Icon-->
                                        <i class="fonticon-cash-payment fs-2hx mb-2 pe-0"></i>
                                        <!--end::Icon-->
                                        <!--begin::Title-->
                                        <span class="fs-7 fw-bold d-block">Efectivo</span>
                                        <!--end::Title-->
                                    </label>
                                    <!--end::Radio-->
                                    <!--begin::Radio-->
                                    {{-- <label
                                        class="btn bg-light btn-color-gray-600 btn-active-text-gray-800 border border-3 border-gray-100 border-active-primary btn-active-light-primary w-100 px-4 active"
                                        data-kt-button="true">
                                        <!--begin::Input-->
                                        <input class="btn-check" type="radio" name="method" value="1" />
                                        <!--end::Input-->
                                        <!--begin::Icon-->
                                        <i class="fonticon-card fs-2hx mb-2 pe-0"></i>
                                        <!--end::Icon-->
                                        <!--begin::Title-->
                                        <span class="fs-7 fw-bold d-block">Card</span>
                                        <!--end::Title-->
                                    </label> --}}
                                    <!--end::Radio-->
                                    <!--begin::Radio-->
                                    <label
                                        class="btn bg-light btn-color-gray-600 btn-active-text-gray-800 border border-3 border-gray-100 border-active-primary btn-active-light-primary w-100 px-4"
                                        data-kt-button="true">
                                        <!--begin::Input-->
                                        <input class="btn-check" type="radio" name="method" value="2" />
                                        <!--end::Input-->
                                        <!--begin::Icon-->
                                        <i class="fonticon-mobile-payment fs-2hx mb-2 pe-0"></i>
                                        <!--end::Icon-->
                                        <!--begin::Title-->
                                        <span class="fs-7 fw-bold d-block">Yape</span>
                                        <!--end::Title-->
                                    </label>
                                    <!--end::Radio-->
                                </div>
                                <!--end::Radio group-->
                                <!--begin::Actions-->
                                <button wire:click="continuar" class="btn btn-primary fs-1 w-100 py-4">Vender</button>
                                <!--end::Actions-->
                            </div>
                            <!--end::Payment Method-->
                        </div>
                        <!--end: Card Body-->
                    </div>
                    <!--end::Pos order-->
                </div>
                <!--end::Sidebar-->
            </div>
            <!--end::Layout-->
        </div>
    </div>


    <script>
        window.addEventListener('show-notification', event => {
                Swal.fire("INFORMACIÓN", event.detail.title, "success");
            });

            
    </script>
</div>