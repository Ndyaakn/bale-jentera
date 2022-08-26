@extends('layouts.index')

@section('title', 'Laporan keuangan')

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
        <h3 class="content-header-title mb-0 d-inline-block">Laporan keuangan</h3>
        <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Laporan keuangan
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
                <h4 class="card-title">List laporan keuangan</h4>
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
                                <th>Tanggal</th>
                                <th>Jumlah pemasukan</th>
                                <th>Jumlah pengeluaran</th>
                                <th>Jumlah saldo</th>
                                <th width="10%">Aksi</th>                                
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @foreach($financial as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td style="white-space: nowrap;">
                                        <span class="d-none">
                                            {{ date("Y-m-d", strtotime($item->date)) }}
                                        </span> 
                                        {{ date("d-m-Y", strtotime($item->date)) }}
                                    </td>
                                    <td style="white-space: nowrap;">Rp. {{ number_format($item->total_debit, 2, ",", ".") }}</td>
                                    <td style="white-space: nowrap;">Rp. {{ number_format($item->total_credit, 2, ",", ".") }}</td>
                                    <td style="white-space: nowrap;">Rp. {{ number_format($item->total_saldo, 2, ",", ".") }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn color-primary dropdown-toggle" type="button" data-toggle="dropdown">
                                                <i class="la la-cog"></i>
                                            </button>
                                            <div class="dropdown-menu" style="min-width: 9rem !important">
                                                <a class="dropdown-item" href="/laporan-keuangan/{{ $item->id }}">
                                                    <i class="la la-info"></i> Detail
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfooter>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Jumlah pemasukan</th>
                                <th>Jumlah pengeluaran</th>
                                <th>Jumlah saldo</th>
                                <th width="10%">Aksi</th>                                
                            </tr>
                        </tfooter>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    
@endsection
