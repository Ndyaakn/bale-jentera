@extends('layouts.index')

@section('title', 'Manajemen kategori pelanggan')

@section('content')
<!-- Main Content -->
<div class="container-fluid">
    <div class="card card-page" style="padding: 35px;">
        <div class="row" style="margin-bottom: 10px;">
            <div class="col-lg-6 col-md-6 col-sm-8 title-page" style="padding-right: 0px;">
                <h4>Data pelanggan</h4>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-4 col-add justify-content-end d-flex" >
                <button class="btn add-btn" id="add-data-costumer" data-bs-toggle="modal">Tambah</button>
                <!-- form modal -->
                <form class="modal-part" id="form-input-data-costumer">
                    <div class="form-group">
                        <label>Kategori pelanggan</label>
                        <select class="form-control">
                            <option>Karyawan kantor</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nama pelanggan</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Kode pelanggan</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>No. Hp</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Diskon</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Total kasbon</label>
                        <input type="text" class="form-control">
                    </div>
                </form>
            </div>
        </div>
        <!-- DATA -->
            <div class="card-body p-0" style="margin-top: 30px;">
                <div class="row">
                    <div class="col-lg-9 col-md-6 col-sm-6">
                        <div class="row">
                            <div class="col-lg-1 col-sm-3 pr-0 show-text">
                                <p>Show</p>
                            </div>
                            <div class="col-lg-1 col-sm-3 pl-0 drop-page-list">
                                <select class="form-select" style="padding-top: 5px;padding-bottom: 5px; padding-left: 10px; padding-right: 10px; border-radius: 8px;" aria-label="Default select example">
                                    <option selected>10</option>
                                    <option value="1">25</option>
                                    <option value="2">50</option>
                                    <option value="3">100</option>
                                </select>
                            </div>
                            <div class="col-lg-2 col-sm-3 entries-text pl-0" >
                                <p>entries</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 justify-content-end d-flex" style="margin-right: -30px;">
                        <div class="row">
                            <div class="col-sm-7 input-text-search">
                                <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="250">
                            </div>
                            <div class="col-sm-1 search-icon">
                                <button class="btn" type="submit"><i class="fas fa-search"></i> </button>
                            </div>
                        </div>
                  </div>
                </div>
                <!-- Table -->
                <div class="row" style="margin-top: 10px;">
                    <div class="col-12 col-lg-12 col-md-12 col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-md">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Kategori</th>
                                        <th>Kode pelanggan</th>
                                        <th>No. HP</th>
                                        <th>Discount</th>
                                        <th>Total kasbon</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Jundi</td>
                                        <td>Karyawan kantor</td>
                                        <td>JK</td>
                                        <td>0910928124</td>
                                        <td>10</td>
                                        <td>100.000</td>
                                        <td><a href="Data-kostumer.html" id="edit-data-costumer" class="btn btn-edit">Edit</a>
                                            <button class="btn btn-delete" data-confirm="Realy?|Do you want to continue?" data-confirm-yes="alert('Deleted :)');" >Hapus</button>
                                         </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                      
                        <!-- pagination -->
                        <div class="card-footer text-right">
                            <nav class="d-inline-block">
                                <ul class="pagination mb-0">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                                    </li>
                                    <li class="page-item active"><a class="page-link" href="#">1 <span class="sr-only">(current)</span></a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">2</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end table -->
        </div>
    </div>
</div> 


    <!-- form modal -->
      <form class="modal-part" id="form-edit-data-costumer">
        <div class="form-group">
          <label>Kategori pelanggan</label>
          <select class="form-control">
            <option>Karyawan kantor</option>
          </select>
        </div>
        <div class="form-group">
          <label>Nama pelanggan</label>
          <input type="text" class="form-control">
        </div>
        <div class="form-group">
          <label>Kode pelanggan</label>
          <input type="text" class="form-control">
        </div>
        <div class="form-group">
          <label>No. Hp</label>
          <input type="text" class="form-control">
        </div>
        <div class="form-group">
          <label>Diskon</label>
          <input type="text" class="form-control">
        </div>
        <div class="form-group">
          <label>Total kasbon</label>
          <input type="text" class="form-control">
        </div>
      </form>                
@endsection      


