<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="http://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <title>Warung Pojok | Menu</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-xs-3" style="padding-top: 15px;">
                <img src="http://conferences.uconn.edu/wp-content/uploads/sites/666/2015/02/Housing_Icon.jpg" alt="Logo" height="100px">
            </div>
            <div class="col-xs-1"></div>
            <div class="col-xs-8" style="padding-top: 35px;">
                <h3>Daftar Menu Warung Pojok</h3>
            </div>
        </div>
        <div class="row" style="padding-top: 25px;padding-bottom: 25px;">
            <div class="col-xs-12">
                <button class="btn btn-primary">Ikan</button>
                <button class="btn btn-success">Ayam</button>
                <button class="btn btn-info">Bebek</button>
                <button class="btn btn-danger">Sapi</button>
            </div>
        </div>
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner">

                <div class="item active">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/ec/Gurame_bakar_kecap_2.JPG/1200px-Gurame_bakar_kecap_2.JPG" alt="Ikan Bakar" style="width:100%;">
                    <div class="carousel-caption">
                        <h3>Ikan Bakar</h3>
                        <p>Rp. 50.000</p>
                    </div>
                </div>
                <div class="item">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/ec/Gurame_bakar_kecap_2.JPG/1200px-Gurame_bakar_kecap_2.JPG" alt="Ikan Bakar" style="width:100%;">
                    <div class="carousel-caption">
                        <h3>Ikan Bakar</h3>
                        <p>Rp. 50.000</p>
                    </div>
                </div>
                <div class="item">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/ec/Gurame_bakar_kecap_2.JPG/1200px-Gurame_bakar_kecap_2.JPG" alt="Ikan Bakar" style="width:100%;">
                    <div class="carousel-caption">
                        <h3>Ikan Bakar</h3>
                        <p>Rp. 50.000</p>
                    </div>
                </div>

                <!-- Left and right controls -->
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
</body>

</html>