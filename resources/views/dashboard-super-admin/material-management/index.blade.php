@extends('layouts.index')

@section('title', 'Manajemen bahan')

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
        <h3 class="content-header-title mb-0 d-inline-block">Manajemen bahan</h3>
        <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Manajemen bahan
                    </li>
                </ol>
            </div>
        </div>
    </div>
    <div class="content-header-right col-md-6 col-12">
        <div class="btn-group float-md-right">
            <button class="btn color-primary rounded-0 mb-1" id="createMaterialButton" type="button">Tambah</button>
        </div>
    </div>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">List bahan</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <table class="table table-striped table-responsive table-bordered zero-configuration datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama bahan</th>
                                <th>Stok</th>
                                <th>Satuan</th>
                                <th width="10%">Aksi</th>                                
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1 @endphp
                            @foreach ($material as $item)
                                <tr>
                                    <td class="text-capitalize">{{ $no++ }}</td>
                                    <td class="text-capitalize">{{ $item->material }}</td>
                                    <td class="text-capitalize">Stok - {{ $item->stock != '999999' ? $item->stock : 'Tidak terbatas'}}</td>
                                    <td>{{ $item->satuan ?? 'Tidak ada satuan' }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn dropdown-toggle color-primary" type="button" data-toggle="dropdown">
                                                <i class="la la-cog"></i>
                                            </button>
                                            <div class="dropdown-menu" style="min-width: 9rem !important">
                                                    <button class="dropdown-item editMaterialButton" value="{{ $item->id }}">
                                                        <i class="la la-edit"></i> Ubah
                                                    </button>
                                                    <button class="dropdown-item deleteMaterialButton" value="{{ $item->id }}">
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
                                <th>Nama bahan</th>
                                <th>Stok</th>
                                <th>Satuan</th>
                                <th width="10%">Aksi</th>                                
                            </tr>
                        </tfooter>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="createMaterialModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header color-primary white">
                <h4 class="modal-title white">Tambah bahan</h4>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{ route('manajemen-bahan.store') }}" method="post">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label>Nama bahan</label>
                        <input type="text" name="material" placeholder="Masukkan nama bahan" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Jumlah stok</label>
                        <input type="number" step="0.1" name="stock" value="0" class="form-control" placeholder="Masukkan jumlah stok" required 
                        >
                    </div>
                    <div class="checkbox mb-1">
                        <label><input type="checkbox" name="infinity_stock"> Stok tidak terbatas</label>
                    </div>
                    <div class="form-group">
                        <label>Satuan</label>
                        <input type="text" name="satuan" class="form-control" placeholder="Masukkan satuan" required>
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

<div class="modal fade" id="editMaterialModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header color-primary white">
                <h4 class="modal-title white">Ubah bahan</h4>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="" id="editMaterialForm" method="post">
                <div class="modal-body">
                    @csrf
                    @method("PUT")
                    <div class="form-group">
                        <label for="">Nama bahan</label>
                        <input type="text" name="material" class="form-control" placeholder="Masukkan nama bahan" id="editMaterial" required>
                    </div>
                    <div class="form-group">
                        <label for="">Stok bahan</label>
                        <input type="number" step="0.1" name="stock" id="editStock" placeholder="Masukkan stok" class="form-control" required>
                    </div>
                    <div class="checkbox mb-1">
                        <label><input type="checkbox" id="editCheckbox" name="infinity_stock"> Stok tidak terbatas</label>
                    </div>
                    <div class="form-group">
                        <label for="">Satuan</label>
                        <input type="text" name="satuan" class="form-control" placeholder="Masukkan satuan" id="editSatuan" required>
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

<div class="modal fade" id="deleteMaterialModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header color-primary white">
                <h4 class="modal-title white">Apa anda yakin ingin menghapus data ini?</h4>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="" id="deleteMaterialForm" method="post">
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
        $(document).on("click", "#createMaterialButton", function ()
        {
            $("#createMaterialModal").modal();
        });
        
        $(document).on("click", ".editMaterialButton", function()
        {
            let id = $(this).val();
            $.ajax(
            {
                method: "GET",
                url: "{{ route('manajemen-bahan.index') }}/" + id + "/edit"
            }).done(function (response)
            {
                console.log(response);
                $("#editMaterial").val(response.material);
                $("#editStock").val(response.stock);
                if(response.stock == 'Tidak terbatas')
                {
                    $("#editCheckbox").attr("checked", true);
                } else {
                    $("#editCheckbox").attr("checked", false);
                }
                $("#editSatuan").val(response.satuan);
                $("#editMaterialForm").attr("action", "{{ route('manajemen-bahan.index') }}/" + id)
                $("#editMaterialModal").modal();
            })
        });
        $(document).on("click", ".deleteMaterialButton", function()
        {
            let id = $(this).val();
            $("#deleteMaterialForm").attr("action", "{{ route('manajemen-bahan.index') }}/" + id)
            $("#deleteMaterialModal").modal();
        });
    </script>
@endsection