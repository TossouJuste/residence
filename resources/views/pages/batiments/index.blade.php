<x-default-layout>

@section('title')
    Bâtiments
@endsection

<div class="card">
    <!--begin::Card header-->
    <div class="card-header border-0 pt-6">
        <!--begin::Card title-->
        <div class="card-title">
            <!--begin::Search-->
            <div class="d-flex align-items-center position-relative my-1">
                {!! getIcon('magnifier', 'fs-3 position-absolute ms-5') !!}
                <input type="text" id="mySearchInput" class="form-control form-control-solid w-250px ps-13" placeholder="Search bâtiment"/>
            </div>
            <!--end::Search-->
        </div>
        <!--end::Card title-->

        <!--begin::Card toolbar-->
        <div class="card-toolbar">
            <!--begin::Toolbar-->
            <div class="d-flex justify-content-end">
                <!--begin::Add bâtiment-->
                <a href="{{ route('batiments.create') }}" class="btn btn-success">
                    {!! getIcon('plus', 'fs-2', '', 'i') !!}
                    Ajouter un Bâtiment
                </a>
                <!--end::Add bâtiment-->
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
                        <th>Cité</th>
                        <th>Nom</th>
                        <th>Nombre de Cabines</th>
                        <th>Sexe</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($batiments as $batiment)
                        <tr>
                             <td>{{ $batiment->city->nom ?? 'Non assigné' }}</td> <!-- Affiche le nom de la cité -->
                            <td>{{ $batiment->nom }}</td>
                            <td>{{ $batiment->nbr_cabine }}</td>
                            <td>{{ $batiment->sexe }}</td>
                            <td>{{ $batiment->description }}</td>
                              <td>
                                <!-- Dropdown -->
                                <div class="dropdown">
                                    <button class="btn btn-light btn-active-light-success btn-flex btn-center btn-sm" type="button" id="dropdownMenuButton{{ $batiment->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                        Actions
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $batiment->id }}">
                                        <li><a class="dropdown-item" href="{{ route('batiments.show', $batiment->id) }}">
                                            <i class="fas fa-eye"></i> View
                                        </a></li>
                                        <li><a class="dropdown-item" href="{{ route('batiments.edit', $batiment->id) }}">
                                            <i class="fas fa-edit"></i> Edit
                                        </a></li>
                                        <li>
                                            <form action="{{ route('batiments.destroy', $batiment->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Etes-vous vraiment sûr de vouloir supprimer ce bâtiment ?');">
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
            {{ $batiments->links('pagination::bootstrap-4') }}
        </div>
        <!--end::Pagination-->
    </div>
    <!--end::Card body-->
</div>

@push('scripts')
    <script>
        // Filtrage des bâtiments par la recherche
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
