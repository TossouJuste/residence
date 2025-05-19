<div class="modal fade" id="kt_modal_add_user" tabindex="-1" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header" id="kt_modal_add_user_header">
                <h2 class="fw-bold">{{ $edit_mode ? 'Modifier un utilisateur' : 'Ajouter un utilisateur' }}</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" aria-label="Close">
                    {!! getIcon('cross','fs-1') !!}
                </div>
            </div>

            <div class="modal-body px-5 my-7">
                <form wire:submit.prevent="submit" class="form" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" wire:model="user_id" />

                    <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-offset="300px">

                        {{-- Avatar --}}
                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">Avatar</label>
                            <input type="file" wire:model="avatar" class="form-control form-control-solid" />
                            @error('avatar') <span class="text-danger">{{ $message }}</span> @enderror

                            @if($edit_mode && isset($saved_avatar))
                                <img src="{{ $saved_avatar }}" class="mt-2 rounded" width="80" />
                            @endif
                        </div>

                        {{-- Nom & Prénom --}}
                        <div class="fv-row mb-7">
                            <label class="required fw-semibold fs-6 mb-2">Nom & Prénom</label>
                            <input type="text" wire:model.defer="name" class="form-control form-control-solid" placeholder="Nom complet" required/>
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        {{-- Email --}}
                        <div class="fv-row mb-7">
                            <label class="required fw-semibold fs-6 mb-2">Email</label>
                            <input type="email" wire:model.defer="email" class="form-control form-control-solid" placeholder="exemple@domaine.com" required/>
                            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>


                        {{-- Role avec SELECT --}}
                        <div class="fv-row mb-7">
                            <label class="required fw-semibold fs-6 mb-2">Rôle</label>
                            <select wire:model.defer="role" class="form-select form-select-solid" required>
                                <option value="">Sélectionner un rôle</option>
                                <option value="admin">Admin</option>
                                <option value="intendant">Intendant</option>
                                <option value="caissiere">Caissière</option>
                                <option value="chef_cite">Chef cité</option>
                                <option value="chef_batiment">Chef bâtiment</option>
                            </select>
                            @error('role') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="text-center pt-15">
                        <div class="d-grid mb-10">
                            <button type="submit" class="btn btn-success">
                                @include('partials.general._button-indicator', ['label' => $edit_mode ? 'Mettre à jour' : 'Enregistrer'])
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
