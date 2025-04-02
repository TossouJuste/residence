<x-default-layout>

    @section('title')
        Cités
    @endsection

    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1">
                    {!! getIcon('magnifier', 'fs-3 position-absolute ms-5') !!}
                    <input type="text" id="mySearchInput" class="form-control form-control-solid w-250px ps-13" placeholder="Search cité"/>
                </div>
                <!--end::Search-->
            </div>
            <!--end::Card title-->

            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end">
    <!--begin::Add cité-->
    <a href="{{ route('cities.create') }}" class="btn btn-primary">
        {!! getIcon('plus', 'fs-2', '', 'i') !!}
        Ajouter une Cité
    </a>
    <!--end::Add cité-->
</div>

                <!--end::Toolbar-->

                <!--begin::Modal-->
                <livewire:cité.add-cité-modal></livewire:cité.add-cité-modal>
                <!--end::Modal-->
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->

        <!--begin::Card body-->
        <div class="card-body py-4">
            <!--begin::Table-->
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Nombre de Bâtiment</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cities as $city)
                            <tr>
                                <td>{{ $city->nom }}</td>
                                <td>{{ $city->nbr_batiment }}</td>
                                <td>{{ $city->description }}</td>
                                <td>
                                    <!-- Dropdown -->
                                    <div class="dropdown">
                                        <button class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm" type="button" id="dropdownMenuButton{{ $city->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                            Actions
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $city->id }}">
                                            <li><a class="dropdown-item" href=" {{ route('cities.show', $city->id) }}">
                                                <i class="fas fa-eye"></i> View
                                            </a></li>
                                            <li><a class="dropdown-item" href="{{ route('cities.edit', $city->id) }}">
                                                <i class="fas fa-edit"></i> Edit
                                            </a></li>
                                            <li>
                                                <form action="{{ route('cities.destroy', $city->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Etes-vous vraiment sur de vouloir supprimé cette cité ?');">
                                                        <i class="fas fa-trash-alt"></i> Delete
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- End Dropdown -->
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!--end::Table-->

            <!--begin::Pagination-->
            <div class="d-flex justify-content-center mt-4">
                {{ $cities->links('pagination::bootstrap-4') }}
            </div>
            <!--end::Pagination-->
        </div>
        <!--end::Card body-->
    </div>

    @push('scripts')
        <script>
            // Filtrage des cités par la recherche
            document.getElementById('mySearchInput').addEventListener('keyup', function () {
                let filter = this.value.toLowerCase();
                let rows = document.querySelectorAll('.table tbody tr');

                rows.forEach(row => {
                    let cells = row.querySelectorAll('td');
                    let match = Array.from(cells).some(cell => cell.textContent.toLowerCase().includes(filter));
                    row.style.display = match ? '' : 'none';
                });
            });

            // Événement Livewire pour masquer le modal et recharger les données
            document.addEventListener('livewire:init', function () {
                Livewire.on('success', function () {
                    $('#kt_modal_add_cité').modal('hide');
                    // Optionnel: Vous pouvez ajouter une méthode pour rafraîchir les données
                });
            });

            // Réinitialiser les données lorsqu'un modal est caché
            $('#kt_modal_add_cité').on('hidden.bs.modal', function () {
                Livewire.dispatch('new_cité');
            });
        </script>
    @endpush


</x-default-layout>
