<!doctype html>
<html class="no-js" lang="zxx">
<head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Batera - List menu</title>
        <meta name="description" content="">
        <meta name="robots" content="noindex, follow" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="assets-list-menu/img/logo.png">
		
		<!-- Style -->
		<style>
            div.scrollmenu {
              overflow: auto;
              white-space: nowrap;
            }
            
            div.scrollmenu a {
              display: inline-block;
              color: black;
              text-align: center;
              padding: 14px;
              text-decoration: none;
            }
            
            div.scrollmenu a:hover {
              background-color: #777;
            }
            
            h3{
              color: white;
            }
            
            #input {
                padding-left: 25px !important;
                padding-right: 25px !important;
            }
        </style>
		
		<!-- all css here -->
        <link rel="stylesheet" href="assets-list-menu/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <link rel="stylesheet" href="assets-list-menu/css/icons.css">
        <link rel="stylesheet" href="assets-list-menu/css/plugins.css">
        <link rel="stylesheet" href="assets-list-menu/css/style.css">
        <link rel="stylesheet" href="assets-list-menu/css/responsive.css">
        <script src="assets-list-menu/js/vendor/modernizr-2.8.3.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </head>
    <body oncontextmenu="return false;" style="background: url('assets-list-menu/img/warungpojok.png');   background-repeat: no-repeat;
  background-attachment: fixed;
  background-size:cover;
  background-position: center;">
        <!-- header start -->
        <!--<div class="breadcrumb-area bg-img ptb-80" style="background-image:url('https://source.unsplash.com/1600x900/?food, drink');filter: blur(8px); -webkit-filter: blur(8px);">-->
        <!--</div>-->
        <img class="breadcrumb-area bg-img" src="assets-list-menu/img/background/<?php echo(rand(1,3));?>.jpg" width="100%" height="300px" style="filter: blur(2px); -webkit-filter: blur(2px);object-fit: cover">
        <div class="container" style="margin-top: -270px; margin-bottom: 50px">
            <div class="breadcrumb-content text-center">
                <div style="background-color: white; width:160px; height:160px;border-radius: 100%; display: block; margin-left: auto; margin-right: auto;">
                    <img src="assets-list-menu/img/logo.png" height="150px" style="margin-top:10px;margin-left: 10px">
                </div>
                <br>
                <h3>Batera</h3>
            </div>
        </div>
        <div class="container breadcrumb-content" style="margin-top: -20px;">
            <!-- Search form -->
            <form action="/" method="get" class="form-inline d-flex justify-content-center md-form form-sm">
              <input class="form-control mr-3 px-2 shadow" id="input" style="border-radius: 50px; height: 48px; width: 80%" type="text" name="name" placeholder="Search" aria-label="Search">
                <button class="btn btn-lg bg-white border rounded-circle shadow" type="submit" style="height: 48px; width: 48px;">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </button>
            </form>
        </div>
        <div class="container" style="margin-top: -20px;">
            <div class="scrollmenu mt-25">
                <a href="?category_menu_id=0" style="line-height: 1.2; color: white"><small><span class="badge badge-primary rounded-circle py-1 pull-right" style="width: 16px !important; margin-right: -8px !important">{{ count($menu) }}</span></small> <br> Semua kategori</a>
                @foreach($category_menu as $item)
                    <a href="?category_menu_id={{ $item->id }}" style="line-height: 1.2; color: white"><small><span class="badge badge-primary rounded-circle py-1 pull-right" style="width: 16px !important; margin-right: -8px !important">{{ count($item->menus) }}</span></small> <br> {{ $item->category }}</a>
                @endforeach
            </div>
        </div>
        <div class="blog-area pt-100" style="padding-top: 10px !important;">
            <div class="container">
                <div class="row">
                    @foreach($list_menu as $item)
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="card single-blog mb-30" style="background-color: #3b3b3b;">
                                <div class="blog-img bg-black">
                                    <a href="{{ $item->image }}" target="_blank">
                                        <img alt="image" class="" style="height: 400px; width:100%; object-fit: cover;" src="{{ $item->image }}">
                                    </a>
                                    @if($item->discount != 0)
                                        <span class="blogpost-time-date">
                                            <span class="date">{{ $item->discount }}%</span>
                                            <span class="month">Off</span>
                                        </span>
                                    @endif
                                </div>
                                <div class="card-body blogpost-desc">
                                    @php
                                        $name = $item->name;
                                        $description = $item->description;
                                        if($item->discount != 0){
                                            $harga_discount = ($item->price * $item->discount/100);
                                            $harga_discount = $item->price - $harga_discount;
                                        }
                                    @endphp
                                    <div class="row">
                                        <div class="col-12">
                                            <h3 class="card-title" style="color: white">
                                                {{ $name }}
                                            </h3>
                                        </div>
                                    </div>
                                    
                                    <p class="card-text" style="margin-top: 0px; color: white; white-space: pre-wrap;">{{ $description}}</p>
                                    <div class="col-12">
                                        @if($item->discount != 0)
                                        <div class="row">
                                            <div class="col-12">
                                                <p style="color: white; float:right" class="card-text"><b>Rp. {{ number_format($harga_discount, 2, ",", ".") }}</b></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="btn btn-warning">
                                                    <p>Potongan {{ $item->discount }}% </p>
                                                </div>
                                                <p style="color: white; font-size:12px; float:right" class="card-text"><strike>Rp. {{ number_format($item->price, 2, ",", ".") }}</strike></p>
                                            </div>
                                        </div>
                                        
                                        @endif
                                        @if($item->discount == 0)
                                        <p style="color: white;" class="pull-right card-text"><b>Rp. {{ number_format($item->price, 2, ",", ".") }}</b></p>
                                        @endif
                                    </div>
                                </div>
                                <div class="card-footer" style="border: 0px;">
                                    
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="mb-5 text-center" style="overflow-x: scroll;">{{ $list_menu->links() }}</div>
                </div>
            </div>
        </div>
		
		<!-- all js here -->
        <script src="assets-list-menu/js/vendor/jquery-1.12.0.min.js"></script>
        <script src="assets-list-menu/js/popper.js"></script>
        <script src="assets-list-menu/js/bootstrap.min.js"></script>
        <script src="assets-list-menu/js/ajax-mail.js"></script>
        <script src="assets-list-menu/js/plugins.js"></script>
        <script src="assets-list-menu/js/main.js"></script>
</html>
