@extends('layouts.index')

@section('title', 'Detail Laporan keuangan')

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
        <h3 class="content-header-title mb-0 d-inline-block">Detail Laporan keuangan</h3>
        <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a>
                    </li>
                    <li class="breadcrumb-item"><a href="/laporan-keuangan">Laporan keuangan</a>
                    </li>
                    <li class="breadcrumb-item active">Detail
                    </li>
                </ol>
            </div>
        </div>
    </div>
    <div class="content-header-right col-md-6 col-12">
        <div class="btn-group float-md-right">
            <div class="btn-group float-md-right">
                <button class="btn color-primary rounded-0 mb-1 mr-1" id="createFinancialButton" type="button">Tambah pengeluaran</button>
            </div>
            <button class="btn btn-success rounded-0 mb-1 mr-1" id="createFinancialStockButton" type="button">Tambah stok</button>
            
            <button class="btn btn-warning rounded-0 mb-1" id="createFinancialStockDecreaseButton" type="button">Kurang stok</button>
        </div>
    </div>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">List detail laporan keuangan</h4>
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
                    <table class="table table-striped table-bordered zero-configuration table-responsive datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Pemasukan</th>
                                <th>Pengeluaran</th>
                                <th>Keterangan</th>
                                <th width="10%">Aksi</th>                                
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @foreach($financial as $item)
                                <tr>
                                    <td class="text-capitalize">{{ $no++ }}</td>
                                    <td style="white-space: nowrap;">Rp. {{ number_format($item->debit, 2, ",", ".") }}</td>
                                    <td style="white-space: nowrap;">Rp. {{ number_format($item->credit, 2, ",", ".") }}</td>
                                    <td>
                                        {!! $item->description !!}
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn color-primary dropdown-toggle" type="button" data-toggle="dropdown">
                                                <i class="la la-cog"></i>
                                            </button>
                                            <div class="dropdown-menu" style="min-width: 9rem !important">
                                                <button class="dropdown-item deleteFinancialButton" value="{{ $item->id }}">
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
                                <th>Pemasukan</th>
                                <th>Pengeluaran</th>
                                <th>Keterangan</th>
                                <th width="10%">Aksi</th>                                
                            </tr>
                        </tfooter>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="createFinancialStockModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header color-primary white">
                <h4 class="modal-title white">Tambah stok</h4>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{ route('laporan-keuangan.store') }}" method="post">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="financial_statement_id" value="{{ $id }}">
                    <div class="form-group">
                        <label for="">Nama bahan</label>
                        <select class="form-control select2" style="width: 100%;" name="material_id">
                            <option value="" hidden>Pilih</option>
                            @foreach($material as $item)
                                <option value="{{ $item->id }}">{{ $item->material }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Jumlah stok yang dibeli</label>
                        <input type="text" name="stock" placeholder="Masukkan stok" class="form-control" required 
                        onkeydown="return ( event.ctrlKey || event.altKey 
                            || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) 
                            || (95<event.keyCode && event.keyCode<106)
                            || (event.keyCode==8) || (event.keyCode==9) 
                            || (event.keyCode>34 && event.keyCode<40) 
                            || (event.keyCode==46) )">
                    </div>
                    <div class="form-group">
                        <label for="">Nominal pengeluaran</label>
                        <input type="text" name="credit" placeholder="Masukkan nominal pengeluaran" class="form-control" required 
                        onkeydown="return ( event.ctrlKey || event.altKey 
                            || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) 
                            || (95<event.keyCode && event.keyCode<106)
                            || (event.keyCode==8) || (event.keyCode==9) 
                            || (event.keyCode>34 && event.keyCode<40) 
                            || (event.keyCode==46) )">
                    </div>
                    <div class="form-group">
                        <label for="">Alasan</label>
                        <textarea type="text" name="reason" placeholder="Masukkan alasan" class="form-control" required></textarea>
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

<div class="modal fade" id="createFinancialStockDecreaseModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header color-primary white">
                <h4 class="modal-title white">Kurang stok</h4>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="/kurang-stok" method="post">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="financial_statement_id" value="{{ $id }}">
                    <div class="form-group">
                        <label for="">Nama bahan</label>
                        <select class="form-control select2" style="width: 100%;" name="material_id">
                            <option value="" hidden>Pilih</option>
                            @foreach($material as $item)
                                <option value="{{ $item->id }}">{{ $item->material }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Jumlah stok yang ingin dikurangi</label>
                        <input type="text" name="stock" placeholder="Masukkan stok" class="form-control" required 
                        onkeydown="return ( event.ctrlKey || event.altKey 
                            || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) 
                            || (95<event.keyCode && event.keyCode<106)
                            || (event.keyCode==8) || (event.keyCode==9) 
                            || (event.keyCode>34 && event.keyCode<40) 
                            || (event.keyCode==46) )">
                    </div>
                    <div class="form-group">
                        <label for="">Alasan</label>
                        <textarea type="text" name="reason" placeholder="Masukkan alasan" class="form-control" required></textarea>
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

<div class="modal fade" id="createFinancialModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header color-primary white">
                <h4 class="modal-title white">Tambah laporan keuangan</h4>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{ route('laporan-keuangan.store') }}" method="post">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="financial_statement_id" value="{{ $id }}">
                    <div class="form-group">
                        <label for="">Pengeluaran</label>
                        <input type="text" name="credit" placeholder="Masukkan pengeluaran" class="form-control" required 
                        onkeydown="return ( event.ctrlKey || event.altKey 
                            || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) 
                            || (95<event.keyCode && event.keyCode<106)
                            || (event.keyCode==8) || (event.keyCode==9) 
                            || (event.keyCode>34 && event.keyCode<40) 
                            || (event.keyCode==46) )">
                    </div>
                    <div class="form-group">
                        <label for="">Deskripsi</label>
                        <textarea type="text" name="description" placeholder="Masukkan deskripsi" class="form-control" required></textarea>
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

<div class="modal fade" id="editFinancialStockModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header color-primary white">
                <h4 class="modal-title white">Ubah laporan keuangan</h4>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" >
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="" id="editFinancialStockForm" method="post">
                <div class="modal-body">
                    @csrf
                    @method("PUT")
                    <input type="hidden" name="type" value="1">
                    <div class="form-group">
                        <label for="">Nama bahan</label>
                        <select class="form-control" id="editMaterial" name="material" required>
                            <option value="" hidden>Pilih</option>
                            @foreach($material as $item)
                                <option value="{{ $item->material }}">{{ $item->material }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Jumlah stok yang dibeli</label>
                        <input type="text" name="stock" id="editStock" placeholder="Masukkan stok" class="form-control" required 
                        onkeydown="return ( event.ctrlKey || event.altKey 
                            || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) 
                            || (95<event.keyCode && event.keyCode<106)
                            || (event.keyCode==8) || (event.keyCode==9) 
                            || (event.keyCode>34 && event.keyCode<40) 
                            || (event.keyCode==46) )">
                    </div>
                    <div class="form-group">
                        <label for="">Nominal pengeluaran</label>
                        <input type="text" name="credit" id="editCreditStock" placeholder="Masukkan nominal pengeluaran" class="form-control" required 
                        onkeydown="return ( event.ctrlKey || event.altKey 
                            || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) 
                            || (95<event.keyCode && event.keyCode<106)
                            || (event.keyCode==8) || (event.keyCode==9) 
                            || (event.keyCode>34 && event.keyCode<40) 
                            || (event.keyCode==46) )">
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

<div class="modal fade" id="editFinancialModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header color-primary white">
                <h4 class="modal-title white">Ubah laporan keuangan</h4>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" >
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="" id="editFinancialForm" method="post">
                <div class="modal-body">
                    @csrf
                    @method("PUT")
                    <input type="hidden" name="type" value="0">
                    <div class="form-group">
                        <label for="">Nominal pengeluaran</label>
                        <input type="text" name="credit" id="editCredit" placeholder="Masukkan nominal pengeluaran" class="form-control" required 
                        onkeydown="return ( event.ctrlKey || event.altKey 
                            || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) 
                            || (95<event.keyCode && event.keyCode<106)
                            || (event.keyCode==8) || (event.keyCode==9) 
                            || (event.keyCode>34 && event.keyCode<40) 
                            || (event.keyCode==46) )">
                    </div>
                    <div class="form-group">
                        <label for="">Deskripsi</label>
                        <textarea type="text" name="description" id="editDescription" class="form-control" required></textarea>
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

<div class="modal fade" id="deleteFinancialModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header color-primary white">
                <h4 class="modal-title white">Apa anda yakin ingin menghapus data ini?</h4>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="" id="deleteFinancialForm" method="post">
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
        $(document).on("click", "#createFinancialStockButton", function ()
        {
            $("#createFinancialStockModal").modal();
        });
        
        $(document).on("click", "#createFinancialStockDecreaseButton", function ()
        {
            $("#createFinancialStockDecreaseModal").modal();
        });
        
        $(document).on("click", "#createFinancialButton", function ()
        {
            $("#createFinancialModal").modal();
        });
        
        $(document).on("click", ".editFinancialButton", function()
        {
            let id = $(this).val();
            $.ajax(
            {
                method: "GET",
                url: "{{ route('laporan-keuangan.index') }}/" + id + "/edit"
            }).done(function (response)
            {
                console.log(response);
                $("#editCredit").val(response.credit);
                $("#editDescription").val(response.description);
                $("#editFinancialForm").attr("action", "{{ route('laporan-keuangan.index') }}/" + id)
                $("#editFinancialModal").modal();
            })
        });

        $(document).on("click", ".editFinancialStockButton", function()
        {
            let id = $(this).val();
            $.ajax(
            {
                method: "GET",
                url: "{{ route('laporan-keuangan.index') }}/" + id + "/edit"
            }).done(function (response)
            {
                console.log(response);
                $("#editCreditStock").val(response.credit);
                var get_description = response.description;
                var description = get_description.split(" | ");
                $("#editMaterial option[value=\"" + description[0] + "\"]").attr("selected", true);
                $("#editStock").val(description[1]);
                console.log(description);
                $("#editFinancialStockForm").attr("action", "{{ route('laporan-keuangan.index') }}/" + id)
                $("#editFinancialStockModal").modal();
            })
        });

        $(document).on("click", ".deleteFinancialButton", function()
        {
            let id = $(this).val();

            $("#deleteFinancialForm").attr("action", "{{ route('laporan-keuangan.index') }}/" + id)
            $("#deleteFinancialModal").modal();
        });
    </script>
@endsection
