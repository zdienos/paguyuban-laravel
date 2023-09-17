@extends('index')

@section('title','Guru')
@section('breadcrumb','Master')

@section('content')
    <div class="card">
        {{-- <div class="card-header border-bottom">
                    <h5 class="card-title">Data Guru</h5>
                </div> --}}

        <div class="card-datatable table-responsive">
            <table class="datatables-guru table border-top" id="list-data">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIP/NIK</th>
                        <th>JK</th>
                        <th>Bidang Studi</th>
                        <th>Alamat</th>
                        <th>Telepon</th>
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
                <form class="tambah-guru pt-0" id="addNewUserForm"
                    zonsubmit="return false">
                    <div class="mb-3">
                        <label class="form-label" for="add-guru-nama">Nama Lengkap</label>
                        <input type="text" class="form-control dt-nama-lengkap" placeholder="John Doe" name="namaGuru"
                            aria-label="John Doe" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="add-guru-nik">NIK/NIP</label>
                        <input type="text" class="form-control dt-nik"  placeholder="123456789" name="nikGuru"
                            aria-label="123456789" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="guru-kelamin">Jenis Kelamin</label>
                        <select id="guru-kelamin" class="form-select dt-kelamin">
                            <option value="l">Laki-laki</option>
                            <option value="p">Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="add-guru-studi">Bidang Studi</label>
                        <input type="text" class="form-control dt-bidang-studi"  placeholder="Bidang Studi"
                            name="studiGuru" aria-label="Bidang Studi" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="add-guru-alamat">Alamat</label>
                        <input type="text" class="form-control dt-alamat" placeholder="Alamat"
                            name="alamatGuru" aria-label="Alamat" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="add-guru-handphone">No Handphone</label>
                        <input type="text" class="form-control dt-handphone"
                            placeholder="Handphone" aria-label="Handphone" name="userHandphone" />
                    </div>
                    <button type="submit" class="btn btn-primary me-sm-3 me-1 btn-simpan" name="xxxxxsubmitButton">Simpan</button>
                    <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Batal</button>
                </form>
            </div>
        </div>
    </div>
@endsection



@section('js')
    @include('master.guru.js');
@endsection
