@extends('index')

@section('title','User')
@section('breadcrumb','Master')

@section('content')
    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="datatables-user table border-top" id="list-data">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>

        <!-- Offcanvas to add new user -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddUser" aria-labelledby="offcanvasAddUserLabel">
            <div class="offcanvas-header">
                <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Tambah Data</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
                <form class="tambah-user pt-0" id="addNewUserForm"
                    zonsubmit="return false">
                    <div class="mb-3">
                        <label class="form-label" for="add-user-name">User Name</label>
                        <input type="text" class="form-control dt-username" placeholder="John Doe" name="userName"
                            aria-label="John Doe" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="add-user-fullname">Full Name</label>
                        <input type="text" class="form-control dt-fullname"  placeholder="123456789" name="fullName"
                            aria-label="123456789" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="user-email">Email</label>
                        <input type="text" class="form-control dt-email"  placeholder="email@domain.com" name="email"
                            aria-label="123456789" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="add-user-role">Role</label>
                        <select id="opt-role" class="form-select dt-role">
                            <option value="1">User</option>
                            <option value="2">Admin</option>
                            <option value="3">Super Admin</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary me-sm-3 me-1 btn-simpan" name="submitButton">Simpan</button>
                    <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Batal</button>
                </form>
            </div>
        </div>
    </div>
@endsection



@section('js')
    @include('master.user.js');
@endsection
