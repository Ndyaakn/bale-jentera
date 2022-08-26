@extends('layouts.index')

@section('title', 'Manajemen kategori menu')


@section('content')
<div class="container-fluid">
  <div class="card card-page" style="padding: 35px;">
    <div class="row" style="margin-bottom: 10px;">
      <div class="col-lg-6 col-md-6 col-sm-8 title-page" style="padding-right: 0px;">
        <h4>List kategori menu</h4>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-4 col-add justify-content-end d-flex" >
        <button class="btn add-btn" data-bs-toggle="modal" id="createCategoryMenuButton">Tambah</button>
         

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
                <th>Kategori menu</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @php $no = 1; @endphp
              @foreach ($category_menu as $item)
                <tr>
                  <td>{{ $item->index }}</td>
                  <td>{{ $item->category }}</td>
                  <td>
                    <button class="btn btn-edit editCategoryMenuButton" id="editCategoryMenuButton" value="{{ $item->id }}" >Edit</button>
                    <button class="btn btn-delete deleteCategoryMenuButton" value="{{ $item->id }}" id="deleteCategoryMenuButton">Hapus</button>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>  
  <!-- end table -->
</div>

<!-- form modal -->
<form class="modal-part" id="createCategoryMenuForm" action="{{ route('manajemen-kategori-menu.store') }}" method="post">
            @csrf
            <div class="input-group">
              <label for="">Index</label>
              <input type="number" class="form-control index_list" placeholder="Nama kategori menu" name="index[]" required>
            </div>
            <div class="input-group">
              <label for="">Nama kategori</label>
              <input type="text" class="form-control category_list" placeholder="Nama kategori menu" name="category[]" required>
            </div>
          </form>
          <!-- editCategoryMenuModal -->
          <form class="modal-part" id="editCategoryMenuForm"  method="post">
            @csrf
            @method("PUT")
            <div class="input-group">
              <label for="">Index</label>
              <input type="number" class="form-control" name="index" placeholder="index" id="editIndex" value="{{ old('index') }}" required>
            </div>
            <div class="input-group">
              <label for="">Nama kategori</label>
              <input type="text" class="form-control " placeholder="Nama kategori menu" name="category" id="editCategory" value="{{ old('category') }}" required>
            </div>
          </form>
          <!-- deleteCategoryMenuModal -->
          <form class="modal-part" id="deleteCategoryMenuForm" method="post">
            @csrf
            @method("DELETE")
            <h5>Apakah anda yakin untuk menghapus kategori menu ini?</h5>
          </form>
@endsection
