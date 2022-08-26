@extends('layouts.index')

@section('title', 'Manajemen meja')

@section('content')
    <div class="container-fluid">
        <div class="card card-page" style="padding: 35px;">        
            <div class="row" style="margin-bottom: 10px;">
                <div class="col-lg-6 col-md-6 col-sm-8 title-page" style="padding-right: 0px;">
                    <h4>List meja</h4>
                </div>
                
                <div class="col-lg-6 col-md-6 col-sm-4 col-add justify-content-end d-flex" >
                    <button class="btn add-btn createTableButton" id="createTableButton" data-bs-toggle="modal" type="button">Tambah</button>
                    <!-- form modal -->

                    <!-- createTable -->
                    <form id="createTableModal"  action="{{ route('manajemen-meja.store') }}" class="modal-part" method="post">
                        @csrf
                        <div class="form-group">
                            <label>No. meja</label>
                            <div class="input-group" >
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fa-solid fa-chair"></i>
                                    </div>
                                </div>
                                <input type="number" class="form-control number_list"  placeholder="Nomor meja" name="number[]" required/>
                            </div>
                        </div>
                    </form>
                    <!-- editTable -->
                    <form id="editTableModal" class="modal-part"  method="post">
                        @csrf
                        @method("PUT")
                        <div class="form-group">
                            <label>No. meja</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fa-solid fa-chair"></i>
                                    </div>  
                                </div>
                                <input type="number" id="editNumber"
                                class="form-control" placeholder="No. meja" name="number">
                            </div>
                        </div>
                    </form>  
                    <!-- deleteTable -->
                    <form class="modal-part" id="deleteTableModal" method="post">
                        @csrf
                        @method("DELETE")
                        <div class="form-group">
                            <h5>Apakah anda yakin ingin menghapus data ini?</h5>
                            <!-- <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Kembali</button> -->
                        </div>
                    </form>
                        
                </div>
            </div>
            <div class="card-body p-0" style="margin-top: 30px;">
                <!-- Table -->
                <div class="row" style="margin-top: 10px;">
                    <div class="col-12 col-lg-12 col-md-12 col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-md zero-configuration datatable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nomor Meja</th>
                                        <!-- <th>Gambar</th> -->
                                        <!-- <th>Kapasitas</th> -->
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php $no = 1; @endphp
                                @foreach ($table as $item)  
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->number }}</td>
                                        <!-- <td style="width: 50%;"><img src="https://img.iproperty.com.my/angel-legacy/1110x624-crop/static/2019/06/Desain-Meja-Kerja-Minimalis-Agar-Kreatif-di-Rumah-Foto-Utama.jpg" alt="" style="width: 30%;"></td>
                                        <td>5 orang</td> -->
                                        <td>
                                            <a href="#" class="btn btn-edit" id="editTableButton" value="{{ $item->id }}">Edit</a>
                                            <button class="btn btn-delete" value="{{ $item->id }}" id="deleteTableButton">Hapus</button>
                                        </td> 
                                        @endforeach  
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                 <!-- end table -->
            </div>
        </div>     
    </div> 
@endsection
