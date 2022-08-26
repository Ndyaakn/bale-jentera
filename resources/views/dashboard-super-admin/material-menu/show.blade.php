@extends('layouts.index')

@section('title', 'Manajemen bahan menu')

@section('style')
<style>
  .page-item.active .page-link {
    color: #FFF !important;
    background-color: #92CB48 !important;
    border-color: #92CB48 !important;
  }
  .pagination .page-lin {
    color: blue !important;
  }
  
  .color-primary {
      background-color: #92CB48;
      color: white
  }
</style>
@endsection

@section('content-header')
    <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
        <h3 class="content-header-title mb-0 d-inline-block">Manajemen menu</h3>
        <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a>
                    </li>
                    <li class="breadcrumb-item"><a href="/manajemen-menu">Menu</a>
                    </li>
                    <li class="breadcrumb-item active">Manajemen bahan menu
                    </li>
                </ol>
            </div>
        </div>
    </div>
    <div class="content-header-right col-md-6 col-12">
        <div class="btn-group float-md-right">
            <button class="btn color-primary rounded-0 mb-1" id="createMaterialMenuButton" type="button">Tambah</button>
        </div>
    </div>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Menu</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Kategori menu</label>
                                <input type="text" value="{{ $menu->category_menu->category }}" class="form-control text-capitalize" readonly>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Nama menu</label>
                                <input type="text" value="{{ $menu->name }}" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">List bahan menu</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <table class="table table-striped table-responsive table-bordered zero-configuration datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Bahan yang digunakan</th>
                                <th>Stok yang dibutuhkan</th>
                                <th width="10%">Aksi</th>                                
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1 @endphp
                            @foreach ($material_menu as $item)
                                <tr>
                                    <td class="text-capitalize">{{ $no++ }}</td>
                                    <td class="text-capitalize">{{ $item->material->material }}</td>
                                    <td class="text-capitalize">Stok - {{ $item->stock_required }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn dropdown-toggle color-primary" type="button" data-toggle="dropdown">
                                                <i class="la la-cog"></i>
                                            </button>
                                            <div class="dropdown-menu" style="min-width: 9rem !important">
                                                    <button class="dropdown-item editMaterialMenuButton" value="{{ $item->id }}">
                                                        <i class="la la-edit"></i> Ubah
                                                    </button>
                                                    <button class="dropdown-item deleteMaterialMenuButton" value="{{ $item->id }}">
                                                        <i class="la la-trash"></i> Hapus
                                                    </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfooter>
                            <tr>
                                <th>No</th>
                                <th>Bahan yang digunakan</th>
                                <th>Stok yang dibutuhkan</th>
                                <th width="10%">Aksi</th>                                
                            </tr>
                        </tfooter>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="createMaterialMenuModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header color-primary white">
                <h4 class="modal-title white">Tambah bahan menu</h4>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{ route('bahan-menu.store') }}" method="post">
                <input type="hidden" name="menu_id" value="{{ $menu_id }}">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="">Bahan yang digunakan</label>
                        <label for="" style="margin-left: 55px;">Stok yang dibutuhkan</label>
                        <div id="create_dynamic_field">
                            <div class="row mb-1">
                                <div class="col-8 col-sm-5">
                                    <select class="form-control select2 material_list" style="width: 100% !important;" name="material_id[]" required>
                                        <option value="" hidden>Pilih</option>
                                        @foreach($material as $item)
                                            <option value="{{ $item->id }}">{{ $item->material }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-4">
                                    <input type="number" step="0.1" name="stock_required[]" value="0" placeholder="Masukkan stok" class="form-control stock_list" required 
                                    >
                                </div>
                                <div class="col-6 col-sm-2">
                                    <button type="button" name="add" id="create_add" class="btn btn-success">Tambah</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-outline-info">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editMaterialMenuModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header color-primary white">
                <h4 class="modal-title white">Ubah bahan menu</h4>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="" id="editMaterialMenuForm" method="post">
                <div class="modal-body">
                    @csrf
                    @method("PUT")
                    <div class="form-group">
                        <label for="">Bahan yang digunakan</label>
                        <select class="form-control select2" name="material_id" style="width: 100% !important;" id="editMaterial" required>
                            <option value="" hidden>Pilih</option>
                            @foreach($material as $item)
                                <option value="{{ $item->id }}">{{ $item->material }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Stok yang dibutuhkan</label>
                        <input type="number" step="0.1" name="stock_required" id="editStock" placeholder="Masukkan stok" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-outline-info">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteMaterialMenuModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header color-primary white">
                <h4 class="modal-title white">Apa anda yakin ingin menghapus data ini?</h4>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="" id="deleteMaterialMenuForm" method="post">
                <div class="modal-footer">
                    @csrf
                    @method("DELETE")
                    <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-outline-danger">Iya, Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        var i=1;
        $('#create_add').click(function()
        {
            i++;
            $('#create_dynamic_field').append('<div class="row mb-1 additional-material" id="row'+i+'"><div class="col-8 col-sm-5"><select class="form-control material_list" style="width: 100% !important;" name="material_id[]" required><option value="" hidden>Pilih</option>@foreach($material as $item)<option value="{{ $item->id }}">{{ $item->material }}</option>@endforeach</select></div><div class="col-4"><input type="number" step="0.1" name="stock_required[]" value="0" placeholder="Masukkan stok" class="form-control stock_list" required></div><div class="col-6 col-sm-2"><button type="button" name="remove" id="'+i+'" class="btn btn-danger block btn_remove">X</button></div></div>');
        });
        
        $(document).on('click', '.btn_remove', function()
        {
            var button_id = $(this).attr("id"); 
            $('#row'+button_id+'').remove();
        });
        
        $(document).on("click", "#createMaterialMenuButton", function ()
        {
            $("#createMaterialMenuModal").modal();
        });
        $(document).on("click", ".editMaterialMenuButton", function()
        {
            let id = $(this).val();
            $.ajax(
            {
                method: "GET",
                url: "{{ route('bahan-menu.index') }}/" + id + "/edit"
            }).done(function (response)
            {
                console.log(response);
                $("#editMaterial option[value=\"" + response.material_id + "\"]").attr("selected", true).trigger('change.select2');
                $("#editStock").val(response.stock_required);
                $("#editMaterialMenuForm").attr("action", "{{ route('bahan-menu.index') }}/" + id)
                $("#editMaterialMenuModal").modal();
            })
        });
        $(document).on("click", ".deleteMaterialMenuButton", function()
        {
            let id = $(this).val();
            $("#deleteMaterialMenuForm").attr("action", "{{ route('bahan-menu.index') }}/" + id)
            $("#deleteMaterialMenuModal").modal();
        });
    </script>
@endsection