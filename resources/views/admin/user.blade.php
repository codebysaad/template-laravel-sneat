@extends('layouts.app')

@section('main')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">User /</span> Daftar User</h4>

        <!-- Basic Bootstrap Table -->
        <div class="card">
            <div class="d-grid gap-2 col-1 ms-4 mt-3">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAdd">Tambah</button>
            </div>
            <h5 class="card-header">Table User</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($user as $i => $u)
                            <tr>
                                <td>{{ $user->firstItem() + $i }}</td>
                                <td>{{ $u->name }}</td>
                                <td>{{ $u->email }}</td>
                                <td><span class="badge bg-label-primary me-1">{{ $u->role }}</span></td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#modalEdit" data-bs-id="{{ $u->id }}"
                                                data-bs-name="{{ $u->name }}" data-bs-email="{{ $u->email }}"
                                                data-bs-role="{{ $u->role }}">
                                                <i class="bx bx-edit-alt me-1"></i>
                                                Edit
                                            </button>
                                            <button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#modalDelete" data-bs-id="{{ $u->id }}">
                                                <i class="bx bx-trash me-1"></i>
                                                Delete
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="container text-center">
                    <div class="row">
                        <div class="col text-start">
                            <div class="col ml-2">
                            </div>
                        </div>
                        <div class="col-md-auto text-end">
                            {{ $user->appends(request()->except('page'))->links('vendor.pagination.bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Basic Bootstrap Table -->
    </div>

    <!--Modal Area-->
    <!--Modal Add-->
    <div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalAddLabel">Tambah Data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.user.create') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="col-form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="col-form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Pilih Role</label>
                            <input class="form-control" list="datalistOptions" name="role" id="role"
                                placeholder="Type to search..." required>
                            <datalist id="datalistOptions">
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </datalist>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="col-form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!--Modal Edit-->
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalEditLabel">New message</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.user.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="id" id="id" class="form-control" required hidden>
                        <div class="mb-3">
                            <label for="name" class="col-form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="col-form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Pilih Role</label>
                            <input class="form-control" list="datalistOptions" name="role" id="role"
                                placeholder="Type to search..." required>
                            <datalist id="datalistOptions">
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </datalist>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="col-form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning">Update</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!--Modal Edit-->
    <div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="text-center">Apakah anda yakin menghapus data ini?
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <form action="{{ route('admin.user.delete') }}" method="POST">
                        @csrf
                        @method('POST')
                        <input type="text" name="id" id="id" required hidden>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Batal</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!--End Modal Area-->

    <!-- / Content -->
@endsection
@push('scripts')
    <script>
        //Modal Edit
        const modalEdit = document.getElementById('modalEdit')
        modalEdit.addEventListener('show.bs.modal', event => {
            // Button that triggered the modal
            const button = event.relatedTarget
            // Extract info from data-bs-* attributes
            const id = button.getAttribute('data-bs-id')
            const name = button.getAttribute('data-bs-name')
            const email = button.getAttribute('data-bs-email')
            const role = button.getAttribute('data-bs-role')

            const modalTitle = modalEdit.querySelector('#modalEditLabel')
            const modalBodyInput = modalEdit.querySelector('.modal-body input')
            const idInput = modalEdit.querySelector('.modal-body #id')
            const nameInput = modalEdit.querySelector('.modal-body #name')
            const emailInput = modalEdit.querySelector('.modal-body #email')
            const roleInput = modalEdit.querySelector('.modal-body #role')

            modalTitle.textContent = `Update data ${name}`
            idInput.value = id
            nameInput.value = name
            emailInput.value = email
            roleInput.value = role
        })

        //Modal Delete
        const modalDelete = document.getElementById('modalDelete')
        modalDelete.addEventListener('show.bs.modal', event => {
            // Button that triggered the modal
            const button = event.relatedTarget
            // Extract info from data-bs-* attributes
            const id = button.getAttribute('data-bs-id')

            const idInput = modalDelete.querySelector('.modal-footer #id')

            idInput.value = id
        })
    </script>
@endpush
