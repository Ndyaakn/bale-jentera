@extends('layouts.index')

@section('title', 'Jurnal')

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
                    <li class="breadcrumb-item active">Jurnal
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
                <h4 class="card-title">Filter Data</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <form action="/export">
                        <div class="row">
                           <div class="col-md-6 mb-1">
                                <div class="form-body">
                                    <label>Date Form</label>
                                    <input type="date" class="form-control input-date-from" name="date_from" required>
                                </div>
                           </div>
                           <div class="col-md-6 mb-1">
                                <div class="form-body">
                                    <label>Date To</label>
                                    <input type="date" class="form-control" id="input-date-to" name="date_to" disabled="false" required>
                                </div>
                           </div>
                        </div>
                        <div class="float-right">
                            <button type="reset" class="btn btn-warning rounded-0 mb-1 mr-1">Reset</button>
                            <button type="submit" id="button-download" class="btn color-primary rounded-0 mb-1">Download</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">List jurnal</h4>
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
                                <th>Waktu</th>
                                <th width="10%">Aksi</th>                             
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @foreach($journal as $item)
                                <tr>
                                    <td class="text-capitalize">{{ $no++ }}</td>
                                    <td style="white-space: nowrap;">{{ $item->date }}</td>
                                    <td>
                                        
                                        <div class="dropdown">
                                            <button class="btn color-primary dropdown-toggle" type="button" data-toggle="dropdown">
                                                <i class="la la-cog"></i>
                                            </button>
                                            <div class="dropdown-menu" style="min-width: 9rem !important">
                                                <a href="/jurnal/{{ $item->id }}" class="dropdown-item">
                                                    <i class="la la-info"></i> Detail jurnal
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
                                <th>Waktu</th>
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
<script>
    $(document).on("change", ".input-date-from", function(){
            $('#input-date-to').prop('disabled', false);
        });
        
        $(document).on("click", "#button-download", function(){
            var dateFrom = $('.input-date-from').val();
            var dateTo = $('#input-date-to').val();
            if(dateTo < dateFrom){
               alert("don't set the date to below the date from");
               $('#input-date-to').val("");
               $('#input-date-to').css("border", "1px solid #f00");
               return false;
            }
        });
</script>
@endsection
