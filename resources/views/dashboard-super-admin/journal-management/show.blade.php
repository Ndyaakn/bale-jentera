@extends('layouts.index')

@section('title', 'Detail jurnal')

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
        <h3 class="content-header-title mb-0 d-inline-block">Jurnal</h3>
        <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a>
                    </li>
                    <li class="breadcrumb-item"><a href="/jurnal">Jurnal</a>
                    </li>
                    <li class="breadcrumb-item active">Detail jurnal
                    </li>
                </ol>
            </div>
        </div>
    </div>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">List detail jurnal</h4>
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
                                <th>ID</th>
                                <th>Nomor meja</th>
                                <th>Nama pelanggan</th>
                                <th>Informasi</th>
                                <th>Metode Pembayaran</th>
                                <th>Kategori pesanan</th>
                                <th>Pesanan</th>
                                <th>Jumlah harga</th>
                                <th>Diskon</th>
                                <th width="10%">Aksi</th>                             
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($journal as $item)
                                <tr>
                                    <td class="text-capitalize">{{ $item->id }}</td>
                                    <td class="text-capitalize">
                                        @if($item->order_category == 'dine in' && $item->table != '')
                                            Nomor - {{ $item->table->number }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="text-capitalize">{{ $item->customer_name }}</td>
                                    <td class="text-capitalize">{{ $item->information ?? '-' }}</td>
                                    <td class="text-capitalize">{{ $item->pembayaran ?? '-' }}</td>
                                    <td class="text-capitalize">{{ $item->order_category }}</td>
                                    <td class="text-capitalize">
                                        @foreach($item->order_menus as $order_menu)
                                            <p style="white-space: nowrap;">{{ $order_menu->menu->name }} | Jumlah : {{ $order_menu->amount }}</p>
                                        @endforeach
                                    </td>
                                    <td style="white-space: nowrap;">
                                        Rp. {{ number_format($item->total_payment, 2, ",", ".") }}
                                    </td>
                                    <td class="text-capitalize">{{ $item->discount_order ?? 0 }} %</td>
                                    <td>
                                        
                                        <div class="dropdown">
                                            <button class="btn color-primary dropdown-toggle" type="button" data-toggle="dropdown">
                                                <i class="la la-cog"></i>
                                            </button>
                                            <div class="dropdown-menu" style="min-width: 9rem !important">
                                                <button class="dropdown-item deleteOrderButton" value="{{ $item->id }}">
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
                                <th>ID</th>
                                <th>Nomor meja</th>
                                <th>Nama pelanggan</th>
                                <th>Informasi</th>
                                <th>Metode Pembayaran</th>
                                <th>Kategori pesanan</th>
                                <th>Pesanan</th>
                                <th>Jumlah harga</th>
                                <th>Diskon</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </tfooter>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteOrderModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header color-primary white">
                <h4 class="modal-title white">Apa anda yakin ingin menghapus data ini?</h4>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="" id="deleteOrderForm" method="post">
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
        $(document).on("click", ".deleteOrderButton", function()
        {
            let id = $(this).val();

            $("#deleteOrderForm").attr("action", "{{ route('detail-jurnal.index') }}/" + id)
            $("#deleteOrderModal").modal();
        });
    </script>
@endsection
