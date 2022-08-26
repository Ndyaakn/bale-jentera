@extends('layouts.index')

@section('title', 'Manajemen kategori pelanggan')

@section('content')
<div class="container-fluid">
    <div class="card card-page" style="padding: 35px;">
        <div class="row" style="margin-bottom: 10px;">
            <div class="col-lg-6 col-md-6 col-sm-8 title-page" style="padding-right: 0px;">
                <h4>List kategori pelanggan</h4>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-4 col-add justify-content-end d-flex" >
                <button class="btn add-btn" id="add-category-costumer" data-bs-toggle="modal">Tambah</button>
                <!-- form modal -->
                <form class="modal-part" id="form-input-category-costumer">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fa-solid fa-users-line"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control" placeholder="Kategori pelanggan" name="No. meja">
                        </div>
                    </div>
                </form>
            </div>
        </div>                       
                
        <div class="card-body p-0" style="margin-top: 30px;">
            <!-- Table -->
            <div class="row" style="margin-top: 10px;">
                <div class="col-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-md">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kategori pelanggan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Karyawan kantor</td>
                                    <td>
                                    <button class="btn add-btn" id="add-category-costumer" data-bs-toggle="modal">Edit</button>
                                    <button class="btn  btn-delete" data-confirm="Realy?|Do you want to continue?" data-confirm-yes="alert('Deleted :)');" >Hapus</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>                
@endsection      


