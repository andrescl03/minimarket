<div>
    <div wire:ignore.self class="modal fade" id="modal_user" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <div class="modal-header" id="kt_modal_user_header">
                    <h2 class="fw-bold">{{ $title_modal }}</h2>
                    <div class="btn btn-icon btn-sm btn-active-icon-primary"  data-bs-dismiss="modal">
                        <span class="svg-icon svg-icon-1">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2"
                                    rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                    transform="rotate(45 7.41422 6)" fill="currentColor" />
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                    <form wire:submit.prevent="submit" id="kt_modal_add_user_form" class="form">
                        <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll"
                            data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                            data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_user_header"
                            data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Nombres</label>
                                <input type="text" class="form-control form-control-solid mb-3 mb-lg-0"
                                    value="{{ old('name') }}" wire:model.defer="name" />
                                @error('name')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Apellidos</label>
                                <input type="text" value="{{ old('lastname') }}"
                                    class="form-control form-control-solid mb-3 mb-lg-0" wire:model.defer="lastname"
                                    required />
                                @error('lastname')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Email</label>
                                <input type="email" value="{{ old('email') }}"
                                    class="form-control form-control-solid mb-3 mb-lg-0" wire:model.defer="email"
                                    required />
                                @error('email')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="fv-row mb-7 " data-kt-password-meter="true">
                                <label for="password" class="required fw-semibold fs-6 mb-2">Contraseña</label>


                                <div class="position-relative mb-3">
                                    <input id="password" type="password"
                                        class="form-control form-control-solid mb-3 mb-lg-0" name="password" required
                                        autocomplete="new-password" wire:model.defer="password">

                                    <span
                                        class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                        data-kt-password-meter-control="visibility">
                                        <i class="bi bi-eye-slash fs-2"></i>

                                        <i class="bi bi-eye fs-2 d-none"></i>
                                    </span>
                                </div>

                                @error('password')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-7">
                                <label class="required fw-semibold fs-6 mb-5">Roles Disponibles</label>
                                @foreach ($rols as $rol)
                                    <div class="d-flex fv-row">
                                        <div class="form-check form-check-custom form-check-solid">
                                            <input class="form-check-input me-3" name="user_role" type="radio"
                                                value="{{ $rol->id }}"
                                                id="kt_modal_update_role_option_{{ $rol->id }}"
                                                wire:model.defer="rol" />
                                            <label class="form-check-label"
                                                for="kt_modal_update_role_option_{{ $rol->id }}">
                                                <div class="fw-bold text-gray-800">{{ $rol->name }}
                                                </div>
                                                <div class="text-gray-600">Usuario {{ $rol->name }}
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                    <div class='separator separator-dashed my-5'></div>
                                @endforeach
                                @error('rol')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="text-end pt-15">
                            <button type="reset" class="btn btn-danger me-3"
                                data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
                                <span class="indicator-label">Registrar</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


</div>
