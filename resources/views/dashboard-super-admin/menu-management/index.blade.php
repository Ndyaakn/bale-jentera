@extends('layouts.index')

@section('title', 'Manajemen menu')

@section('content-header')
    <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
        <h3 class="content-header-title mb-0 d-inline-block">Manajemen menu</h3>
        <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Manajemen menu
                    </li>t
                </ol>
            </div>
        </div>
    </div>
    <div class="content-header-right col-md-6 col-12">
        <div class="btn-group float-md-right">
            <button class="btn color-primary rounded-0 mb-1" id="createMenuButton" type="button">Tambah</button>
        </div>
    </div>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">List menu</h4>
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
                                <th>Index</th>
                                <th>Bahan menu</th>
                                <th>Kategori menu</th>
                                <th>Kategori pesanan</th>
                                <th>Gambar</th>
                                <th>Name</th>
                                <th>Deskripsi</th>
                                <th>Informasi</th>
                                <th>Harga dine in</th>
                                <th>Harga go food</th>
                                <th>Harga go food2</th>
                                <th>Harga shopee</th>
                                <th>Harga grab food</th>
                                <th>Potongan harga</th>
                                <th>Potongan harga GoFood</th>
                                <th>Potongan harga GoFood2</th>
                                <th>Potongan harga Shopee</th>
                                <th>Potongan harga GrabFood</th>
                                <th width="10%">Aksi</th>                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($menu as $item)
                                <tr>
                                    <td class="text-capitalize">{{ $item->index }}</td>
                                    <td class="text-capitalize" style="white-space: nowrap;">
                                        @if(count($item->material_menus) > 0)
                                            @foreach($item->material_menus as $item_2)
                                                {{ $item_2->material->material }} | Stok - {{ $item_2->stock_required }} <br>
                                            @endforeach
                                        @else
                                            Bahan belum ditentukan
                                        @endif
                                    </td>
                                    <td class="text-capitalize" style="white-space: nowrap;">{{ $item->category_menu->category }}</td>
                                    <td class="text-capitalize" style="white-space: nowrap;">{{ $item->category_order ?? '-' }}</td>
                                    <td>
                                        <a target="_blank" class="text-info" href="{{ $item->image }}">
                                            <img src="{{ $item->image }}" width="75px" height="75px">
                                        </a>
                                    </td>
                                    <td class="text-capitalize" style="white-space: nowrap;">{{ $item->name }}</td>
                                    <td>
                                        <div style="overflow-y: scroll; height: 75px; width: 200px;">
                                            {{ $item->description }}
                                        </div>
                                    </td>
                                    <td>
                                        {{ $item->additional_information ?? '-' }}
                                    </td>
                                    <td style="white-space: nowrap;">Rp. {{ number_format($item->price, 2, ",", ".") }}
                                    </td>
                                    <td style="white-space: nowrap;">Rp. {{ number_format($item->price_gofood, 2, ",", ".") }}
                                    </td>
                                    <td style="white-space: nowrap;">Rp. {{ number_format($item->price_gofood2, 2, ",", ".") }}
                                    </td>
                                    <td style="white-space: nowrap;">Rp. {{ number_format($item->price_shopee, 2, ",", ".") }}
                                    </td>
                                    <td style="white-space: nowrap;">Rp. {{ number_format($item->price_grabfood, 2, ",", ".") }}
                                    </td>
                                    <td>
                                        {{ $item->discount ?? 0 }} %
                                    </td>
                                    <td>
                                        {{ $item->discount_gofood ?? 0 }} %
                                    </td>
                                    <td>
                                        {{ $item->discount_gofood2 ?? 0 }} %
                                    </td>
                                    <td>
                                        {{ $item->discount_shopee ?? 0 }} %
                                    </td>
                                    <td>
                                        {{ $item->discount_grabfood ?? 0 }} %
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn color-primary dropdown-toggle" type="button" data-toggle="dropdown">
                                                <i class="la la-cog"></i>
                                            </button>
                                            <div class="dropdown-menu" style="min-width: 9rem !important">
                                                <a class="dropdown-item" href="/bahan-menu/{{ $item->id }}">
                                                    <i class="la la-info"></i> Lihat bahan
                                                </a>
                                                <button class="dropdown-item editMenuButton" value="{{ $item->id }}">
                                                    <i class="la la-edit"></i> Ubah
                                                </button>
                                                <button class="dropdown-item deleteMenuButton" value="{{ $item->id }}">
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
                                <th>Index</th>
                                <th>Bahan menu</th>
                                <th>Kategori menu</th>
                                <th>Kategori pesanan</th>
                                <th>Gambar</th>
                                <th>Name</th>
                                <th>Deskripsi</th>
                                <th>Informasi</th>
                                <th>Harga dine in</th>
                                <th>Harga go food</th>
                                <th>Harga go food2</th>
                                <th>Harga shopee</th>
                                <th>Harga grab food</th>
                                <th>Potongan harga</th>
                                <th>Potongan harga GoFood</th>
                                <th>Potongan harga GoFood2</th>
                                <th>Potongan harga Shopee</th>
                                <th>Potongan harga GrabFood</th>
                                <th width="10%">Aksi</th>                                
                            </tr>
                        </tfooter>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="createMenuModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header color-primary white">
                <h4 class="modal-title white">Tambah menu</h4>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{ route('manajemen-menu.store') }}" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label>Gambar</label>
                        <img id="createPicture" class="text-center"
                            src="https://kravmaganewcastle.com.au/wp-content/uploads/2017/04/default-image-800x600.jpg"
                            alt="foto diri" style="display: block; width: 300px; height:auto;" />
                    </div>
                    <div class="form-group">
                        <input type="file" name="image" class="form-control-file" id="createPictureChange"
                            data-show-upload="false" data-show-caption="true" data-show-preview="true"
                            accept="image/*" required>
                    </div>
                    <div class="form-group">
                        <label for="">Kategori menu</label>
                        <select name="category_menu_id" class="form-control select2" style="width: 100%;" required>
                            <option value="" hidden>Pilih</option>
                            @foreach($category_menu as $item)
                                <option value="{{ $item->id }}" class="text-capitalize">{{ $item->category }}</option>    
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Kategori pesanan</label>
                        <select name="category_order[]" class="form-control select2-tags" style="width: 100%;" multiple required>
                            <option value="dinein" selected>Dine in</option>
                            <option value="gofood">Go Food</option>
                            <option value="grabfood">Grab Food</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Index</label>
                        <input type="text" name="index" placeholder="Masukkan index" class="form-control" required 
                        onkeydown="return ( event.ctrlKey || event.altKey 
                            || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) 
                            || (95<event.keyCode && event.keyCode<106)
                            || (event.keyCode==8) || (event.keyCode==9) 
                            || (event.keyCode>34 && event.keyCode<40) 
                            || (event.keyCode==46) )">
                    </div>
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" name="name" placeholder="Masukkan nama" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Deskripsi</label>
                        <textarea name="description" placeholder="Masukkan deskripsi" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Informasi</label>
                        <textarea name="additional_information" placeholder="Masukkan informasi" class="form-control" ></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Harga dine in</label>
                        <input type="text" name="price" placeholder="Masukkan harga dine in" class="form-control" required 
                        onkeydown="return ( event.ctrlKey || event.altKey 
                            || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) 
                            || (95<event.keyCode && event.keyCode<106)
                            || (event.keyCode==8) || (event.keyCode==9) 
                            || (event.keyCode>34 && event.keyCode<40) 
                            || (event.keyCode==46) )">
                    </div>
                    <div class="form-group">
                        <label for="">Harga Gofood</label>
                        <input type="text" name="price_gofood" placeholder="Masukkan harga go food" class="form-control" required 
                        onkeydown="return ( event.ctrlKey || event.altKey 
                            || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) 
                            || (95<event.keyCode && event.keyCode<106)
                            || (event.keyCode==8) || (event.keyCode==9) 
                            || (event.keyCode>34 && event.keyCode<40) 
                            || (event.keyCode==46) )">
                    </div>
                    <div class="form-group">
                        <label for="">Harga Gofood2</label>
                        <input type="text" name="price_gofood2" placeholder="Masukkan harga go food2" class="form-control" required 
                        onkeydown="return ( event.ctrlKey || event.altKey 
                            || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) 
                            || (95<event.keyCode && event.keyCode<106)
                            || (event.keyCode==8) || (event.keyCode==9) 
                            || (event.keyCode>34 && event.keyCode<40) 
                            || (event.keyCode==46) )">
                    </div>
                    <div class="form-group">
                        <label for="">Harga Shopee</label>
                        <input type="text" name="price_shopee" placeholder="Masukkan harga Shopee" class="form-control" required 
                        onkeydown="return ( event.ctrlKey || event.altKey 
                            || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) 
                            || (95<event.keyCode && event.keyCode<106)
                            || (event.keyCode==8) || (event.keyCode==9) 
                            || (event.keyCode>34 && event.keyCode<40) 
                            || (event.keyCode==46) )">
                    </div>
                    <div class="form-group">
                        <label for="">Harga Grabfood</label>
                        <input type="text" name="price_grabfood" placeholder="Masukkan harga grab food" class="form-control" required 
                        onkeydown="return ( event.ctrlKey || event.altKey 
                            || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) 
                            || (95<event.keyCode && event.keyCode<106)
                            || (event.keyCode==8) || (event.keyCode==9) 
                            || (event.keyCode>34 && event.keyCode<40) 
                            || (event.keyCode==46) )">
                    </div>
                    <div class="form-group">
                        <label for="">Diskon Dine In</label>
                        <input type="number" name="discount" placeholder="Masukkan potongan harga" min="1" max="100" class="form-control">
                    </div>
                    <!--<div class="form-group">-->
                    <!--    <label for="">Diskon Take Away</label>-->
                    <!--    <input type="number" name="discount_takeaway" placeholder="Masukkan potongan harga takeaway" min="1" max="100" class="form-control">-->
                    <!--</div>-->
                    <div class="form-group">
                        <label for="">Diskon GoFood</label>
                        <input type="number" name="discount_gofood" placeholder="Masukkan potongan harga gofood" min="1" max="100" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Diskon GoFood2</label>
                        <input type="number" name="discount_gofood2" placeholder="Masukkan potongan harga gofood2" min="1" max="100" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Diskon Shopee</label>
                        <input type="number" name="discount_shopee" placeholder="Masukkan potongan harga Shopee" min="1" max="100" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Diskon GrabFood</label>
                        <input type="number" name="discount_grabfood" placeholder="Masukkan potongan harga grabfood" min="1" max="100" class="form-control">
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

<div class="modal fade" id="editMenuModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header color-primary white">
                <h4 class="modal-title white">Ubah menu</h4>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" >
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="" id="editMenuForm" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    @method("PUT")
                    <div class="form-group">
                        <label>Gambar</label>
                        <img id="editPicture" class="text-center" alt="gambar" style="display: block; width: 300px; height:auto;" />
                    </div>
                    <div class="form-group">
                        <input type="file" name="image" class="form-control-file" id="editPictureChange"
                            data-show-upload="false" data-show-caption="true" data-show-preview="true"
                            accept="image/*">
                    </div>
                    <div class="form-group">
                        <label for="">Kategori menu</label>
                        <select name="category_menu_id" class="form-control select2" id="editCategoryMenu" style="width: 100%;" required>
                            <option value="" hidden>Pilih</option>
                            @foreach($category_menu as $item)
                                <option value="{{ $item->id }}" class="text-capitalize">{{ $item->category }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Kategori pesanan</label>
                        <select name="category_order[]" id="editCategoryOrder" class="form-control select2-tags" style="width: 100%;" multiple required>
                            <option value="dinein">Dine in</option>
                            <option value="gofood">Go Food</option>
                            <option value="grabfood">Grab Food</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Index</label>
                        <input type="text" name="index" id="editIndex" placeholder="Masukkan index" class="form-control" required 
                        onkeydown="return ( event.ctrlKey || event.altKey 
                            || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) 
                            || (95<event.keyCode && event.keyCode<106)
                            || (event.keyCode==8) || (event.keyCode==9) 
                            || (event.keyCode>34 && event.keyCode<40) 
                            || (event.keyCode==46) )">
                    </div>
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" name="name" id="editName" placeholder="Masukkan nama" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Deskripsi</label>
                        <textarea name="description" id="editDescription" placeholder="Masukkan deskripsi" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Informasi</label>
                        <textarea name="additional_information" id="editInformation" placeholder="Masukkan informasi" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Harga dine in</label>
                        <input type="text" name="price" id="editPrice" placeholder="Masukkan harga dine in" class="form-control" required 
                        onkeydown="return ( event.ctrlKey || event.altKey 
                            || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) 
                            || (95<event.keyCode && event.keyCode<106)
                            || (event.keyCode==8) || (event.keyCode==9) 
                            || (event.keyCode>34 && event.keyCode<40) 
                            || (event.keyCode==46) )">
                    </div>
                    <div class="form-group">
                        <label for="">Harga Gofood</label>
                        <input type="text" name="price_gofood" id="editPriceGoFood" placeholder="Masukkan harga go food" class="form-control" required 
                        onkeydown="return ( event.ctrlKey || event.altKey 
                            || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) 
                            || (95<event.keyCode && event.keyCode<106)
                            || (event.keyCode==8) || (event.keyCode==9) 
                            || (event.keyCode>34 && event.keyCode<40) 
                            || (event.keyCode==46) )">
                    </div>
                    <div class="form-group">
                        <label for="">Harga Gofood2</label>
                        <input type="text" name="price_gofood2" id="editPriceGoFood2" placeholder="Masukkan harga go food2" class="form-control" required 
                        onkeydown="return ( event.ctrlKey || event.altKey 
                            || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) 
                            || (95<event.keyCode && event.keyCode<106)
                            || (event.keyCode==8) || (event.keyCode==9) 
                            || (event.keyCode>34 && event.keyCode<40) 
                            || (event.keyCode==46) )">
                    </div>
                    <div class="form-group">
                        <label for="">Harga Shopee</label>
                        <input type="text" name="price_shopee" id="editPriceShopee" placeholder="Masukkan harga go food" class="form-control" required 
                        onkeydown="return ( event.ctrlKey || event.altKey 
                            || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) 
                            || (95<event.keyCode && event.keyCode<106)
                            || (event.keyCode==8) || (event.keyCode==9) 
                            || (event.keyCode>34 && event.keyCode<40) 
                            || (event.keyCode==46) )">
                    </div>
                    <div class="form-group">
                        <label for="">Harga Grabfood</label>
                        <input type="text" name="price_grabfood" id="editPriceGrabFood" placeholder="Masukkan harga grab food" class="form-control" required 
                        onkeydown="return ( event.ctrlKey || event.altKey 
                            || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) 
                            || (95<event.keyCode && event.keyCode<106)
                            || (event.keyCode==8) || (event.keyCode==9) 
                            || (event.keyCode>34 && event.keyCode<40) 
                            || (event.keyCode==46) )">
                    </div>
                    <div class="form-group">
                        <label for="">Diskon Dine In</label>
                        <input type="number" name="discount" id="editDiscount" placeholder="Masukkan potongan harga" min="1" max="100" class="form-control">
                    </div>
                    <!--<div class="form-group">-->
                    <!--    <label for="">Take Away</label>-->
                    <!--    <input type="number" name="discount_takeaway" id="editDiscountTakeaway" placeholder="Masukkan potongan harga takeaway" min="1" max="100" class="form-control">-->
                    <!--</div>-->
                    <div class="form-group">
                        <label for="">Diskon GoFood</label>
                        <input type="number" name="discount_gofood" id="editDiscountGofood" placeholder="Masukkan potongan harga gofood" min="1" max="100" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Diskon GoFood2</label>
                        <input type="number" name="discount_gofood2"  id="editDiscountGofood2" placeholder="Masukkan potongan harga gofood2" min="1" max="100" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Diskon Shopee</label>
                        <input type="number" name="discount_shopee"  id="editDiscountShopee" placeholder="Masukkan potongan harga gofood2" min="1" max="100" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Diskon GrabFood</label>
                        <input type="number" name="discount_grabfood" id="editDiscountGrabfood" placeholder="Masukkan potongan harga grabfood" min="1" max="100" class="form-control">
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

<div class="modal fade" id="deleteMenuModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header color-primary white">
                <h4 class="modal-title white">Apa anda yakin ingin menghapus data ini?</h4>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="" id="deleteMenuForm" method="post">
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
        $(document).on("click", "#createMenuButton", function ()
        {
            $("#createMenuModal").modal();
        });

        $(document).on("click", ".editMenuButton", function()
        {
            let id = $(this).val();
            $.ajax(
            {
                method: "GET",
                url: "{{ route('manajemen-menu.index') }}/" + id + "/edit"
            }).done(function (response)
            {
                console.log(response);
                $("#editPicture").attr("src", response.image)
                $("#editIndex").val(response.index);
                $("#editName").val(response.name);
                $("#editDescription").text(response.description);
                $("#editPrice").val(response.price);
                $("#editPriceGoFood").val(response.price_gofood);
                $("#editPriceGoFood2").val(response.price_gofood2);
                $("#editPriceShopee").val(response.price_shopee);
                $("#editPriceGrabFood").val(response.price_grabfood);
                $("#editDiscount").val(response.discount);
                // $("#editDiscountTakeaway").val(response.discount_takeaway);
                $("#editDiscountGofood").val(response.discount_gofood);
                $("#editDiscountGofood2").val(response.discount_gofood2);
                $("#editDiscountShopee").val(response.discount_shopee);
                $("#editDiscountGrabfood").val(response.discount_grabfood);
                $("#editInformation").text(response.additional_information);
                $("#editCategoryMenu option[value=\"" + response.category_menu_id + "\"]").attr("selected", true).trigger('change.select2');
                if(response.category_order != null){
                    var category_orders = response.category_order.split(",");
                    category_orders.forEach(category_order => {
                        $("#editCategoryOrder option[value=\"" + category_order + "\"]").attr("selected", true).trigger('change');
                    });   
                }
                $("#editMenuForm").attr("action", "{{ route('manajemen-menu.index') }}/" + id)
                $("#editMenuModal").modal();
            })
        });

        $(document).on("click", ".deleteMenuButton", function()
        {
            let id = $(this).val();

            $("#deleteMenuForm").attr("action", "{{ route('manajemen-menu.index') }}/" + id)
            $("#deleteMenuModal").modal();
        });
        
        function createPicture(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
    
                reader.onload = function (e) {
                    $('#createPicture').attr('src', e.target.result);
                }
    
                reader.readAsDataURL(input.files[0]);
            }
        }
    
        $("#createPictureChange").change(function () {
            createPicture(this);
        });
        
        function editPicture(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
    
                reader.onload = function (e) {
                    $('#editPicture').attr('src', e.target.result);
                }
    
                reader.readAsDataURL(input.files[0]);
            }
        }
    
        $("#editPictureChange").change(function () {
            editPicture(this);
        });
    </script>
@endsection
