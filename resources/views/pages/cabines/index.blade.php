<x-default-layout>
    @section('title', 'Cabines')

    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1">
                    {!! getIcon('magnifier', 'fs-3 position-absolute ms-5') !!}
                    <input type="text" id="mySearchInput" class="form-control form-control-solid w-250px ps-13" placeholder="Search cabine"/>
                </div>
                <!--end::Search-->
            </div>
            <!--end::Card title-->

            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end">
                    <!--begin::Add cabine-->
                    <a href="{{ route('cabines.create') }}" class="btn btn-primary">
                        {!! getIcon('plus', 'fs-2', '', 'i') !!}
                        Ajouter une Cabine
                    </a>
                    <!--end::Add cabine-->
                </div>
                <!--end::Toolbar-->
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
                            <th>Batiment</th>
                            <th>Désignation de cabine</th>
                            <th>Places initiales</th>
                            <th>Places disponibles</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cabines as $cabine)
                            <tr>
                                <td>{{ $cabine->batiment->nom }}-{{ $cabine->batiment->city->nom }}</td>
                                <td>{{ $cabine->code }}</td>
                                <td>{{ $cabine->places_initiales }}</td>
                                <td>{{ $cabine->places_disponibles }}</td>
                                <td>
                                    <!-- Dropdown -->
                                    <div class="dropdown">
                                        <button class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm" type="button" id="dropdownMenuButton{{ $cabine->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                            Actions
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $cabine->id }}">
                                            <li><a class="dropdown-item" href="{{ route('cabines.show', $cabine->id) }}">
                                                <i class="fas fa-eye"></i> Voir
                                            </a></li>
                                            <li><a class="dropdown-item" href="{{ route('cabines.edit', $cabine->id) }}">
                                                <i class="fas fa-edit"></i> Modifier
                                            </a></li>
                                            <li>
                                                <form action="{{ route('cabines.destroy', $cabine->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette cabine ?');">
                                                        <i class="fas fa-trash-alt"></i> Supprimer
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
                {{ $cabines->links('pagination::bootstrap-4') }}
            </div>
            <!--end::Pagination-->
        </div>
        <!--end::Card body-->
    </div>

    @push('scripts')
        <script>
            // Filtrage des cabines par la recherche
            document.getElementById('mySearchInput').addEventListener('keyup', function () {
                let filter = this.value.toLowerCase();
                let rows = document.querySelectorAll('.table tbody tr');

                rows.forEach(row => {
                    let cells = row.querySelectorAll('td');
                    let match = Array.from(cells).some(cell => cell.textContent.toLowerCase().includes(filter));
                    row.style.display = match ? '' : 'none';
                });
            });
        </script>
    @endpush
</x-default-layout>
