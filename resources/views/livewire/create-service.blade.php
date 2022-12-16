<div>
    <form wire:submit.prevent="submit" id="kt_modal_add_user_form2" class="form" action="#">

        <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true"
            data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
            data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll"
            data-kt-scroll-offset="300px">
            <div class="fv-row mb-7">
                <label class="required fw-semibold fs-6 mb-2">Nombre</label>
                <input type="text" name="name" class="form-control form-control-solid mb-3 mb-lg-0"
                     value="{{ old('name') }}" wire:model="name" />
                @error('name')
                    <span class="error text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="text-center pt-15">
            <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">
                <span class="indicator-label">Registrar</span>
            </button>
        </div>

    </form>
    
</div>
