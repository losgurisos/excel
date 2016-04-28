<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="windows-1252">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    </head>
    <body>
        <script>

            $(document).ready(function () {

            });

        </script>
        <style>
            @font-face {
                font-family: HelveticaLight;
                src: url("fonts/Helvetica Light.ttf");
            }
            @font-face {
                font-family: HelveticaNeueLTStd;
                src: url("fonts/HelveticaNeueLTStd-BdIt.otf");
            }

            .body{
                font-family: Helvetica;
            }
            .container {
                width: 100%;
            }
            .item-apply-on {
                font-family: HelveticaLight;
                color: #b81d2c;
                margin: 2px;
                margin-top: 5px;
                width: 245px;
                font-weight: bold;
                line-height: 12px;
                font-size: 11px;
                overflow: hidden;
            }
            .sidebar{
                padding: 0;
                height: 650px;
                background: #850308;           
                position: fixed;
                height:100%;
                z-index: 999;
            }
            .sidebar .top{
                height:422px;background: #b81d2c;
            }
            .sidebar .top p.title {
                color: white;
                font-weight: bold;
                font-size: 24px;
                text-align: center;
                margin: 0 auto;
                width: 60%;
                line-height: 20px;
                padding-top: 25px;
            }
            .sidebar .beneficios {
                line-height: 55px;
                height: 55px;
                background: #fdc600;
                color: white;
                font-size: 25px;
                font-weight: bold;
                text-align: center;
            }
            .sidebar .bottom{

            }
            .center{
                height: 650px; box-sizing: content-box;
                padding-left: 25%;
            }
            .item-col{
                height: 650px;
            }
            .item {
                background: #ebebeb;
                height: 180px;
                padding: 15px;
                box-sizing: border-box;
                margin: 20px 5px;
                border-radius: 10px;
            }
            ul.item-list {
                list-style: none;
                padding: 30px;
            }
            .item .item-img{
                width: 150px;
                background: #4CAF50;
                height: 150px;float:left;}
            .item .item-img img{
                width: 100%;
                height: auto;
                overflow: hidden;
            }

            .item .item-data {
                float: left;
                margin-left: 15px;
            }
            .item .item-data .val{
                font-size: 80px; color:#b81d2c;
                line-height: 75px;
                font-weight: bold;
                font-style: italic;
                margin: 0;
                float: left;
            }
            .item-category-img img{

            }
            .item .item-data .item-disscount p.mini {
                float: left; color:#b81d2c;
                line-height: 30px;

                font-weight: bold;
                font-size: 35px;
                margin: 38px 0px 0px 5px;
            }
            .item .item-disscount {
                height: 75px;
                font-family: HelveticaNeueLTStd;
            }
            .item .item-category-img {
                position: absolute;
                right: 35px;
                width: 60px;
                background-size: 60px;
                height: 50px;
                background-image: url('img/icon_tecnologia_dark.png');
            }
            .item .item-category-img .tecnologia{
                background-image: url('img/icon_tecnologia_dark.png');
            }
            .item .item-category-img .moda{
                background-image: url('img/icon_moda_dark.png');
            }
            .item .item-category-img .ninos{
                background-image: url('img/icon_ninos_dark.png');
            }
            .item .item-category-img .hogar{
                background-image: url('img/icon_hogar_dark.png');
            }
            .item .item-category-img .otros{
                background-image: url('img/icon_otros_dark.png');
            }
            .item .item-category-img .vehiculos{
                background-image: url('img/icon_vehiculos_dark.png');
            }

            .item-address {font-family: HelveticaLight;
                           font-weight: bold;
                           position: relative;
                           margin-top: 10px;
                           width: 195px;
                           font-size: 11px;
                           line-height: 11px;
                           color: #5B5B5B;
                           padding-left: 50px;
            }

            .item-address::before {
                content: " ";
                height: 30px;
                width: 20px;
                display: block;
                left: 15px;
                position: absolute;
                background-image: url("img/location_pin.png");
            }

            .category-filter-container {
                margin: 15px 30px;
                height: 100%;
            }
            .category-filter-container .category-filter-item {
                height: 100%;
                margin-bottom: 50px;
            }
            .category-filter-container .category-filter-item .category-filter{
                height: 100px;
                width: 100%;
            }

            .category-filter-container .category-filter-item .tecnologia .cat-filter-icon{
                background: url('img/icon_tecnologia.png');
            }
            .category-filter-container .category-filter-item  .moda .cat-filter-icon{
                background: url('img/icon_moda.png');
            }
            .category-filter-container .category-filter-item  .ninos .cat-filter-icon{
                background: url('img/icon_ninos.png');
            }
            .category-filter-container .category-filter-item  .hogar .cat-filter-icon{
                background: url('img/icon_hogar.png');
            }
            .category-filter-container .category-filter-item  .otros .cat-filter-icon{
                background: url('img/icon_otros.png');
            }
            .category-filter-container .category-filter-item  .vehiculos .cat-filter-icon{
                background: url('img/icon_vehiculos.png');
            }
            .category-filter-container .category-filter-item .category-filter .cat-filter-icon {
                height: 70px;
                width: 70px;
                background-repeat: no-repeat;
                background-size: 100%;
                margin: 0 auto;
            }
            .category-filter-container .category-filter-item .category-filter .cat-filter-title {
                color: white;
                text-align: center;
            }
            .category-filter-container .category-filter-item .category-filter .cat-filter-checkbox-container {
                width: 15px;
                height: 15px;
                margin: 0 auto;
            }
            .category-filter-container .category-filter-item .category-filter .cat-filter-checkbox {
                width: 100%;
                height: 100%;
            }
            .category-filter-container .category-filter-item .category-filter div {
                margin-bottom: 15px;
            }
            .cities-filter-container {
                width: 100%;
            }
            .cities-filter-select-container {
                margin: 0 auto;
                width: 210px;
                height: 30px;
            }
            .cities-filter-select {
                height: 100%;
                width: 100%;
            }

            .container-beneficios {
                margin-top: 30px;overflow: hidden;height: 95px;
            }
            .beneficio.col-lg-3 {
                height: 70px;
                padding: 0;
            }
            .container-beneficios .checkbox-container{
                margin: 0 auto;
                width: 12px;
                margin-top: 15px;
            }
            .beneficio.col-lg-3 .beneficio_image {
                width: 60px;
                margin: 0 auto;
                background-position: 0px 0px;
                height: 55px;
                background-image: url("img/icons_beneficios.png");
            }
            .beneficio.col-lg-3.efectivo .beneficio_image {
                width: 60px;
                background-position: 0px 0px;
            }
            .beneficio.col-lg-3.movil .beneficio_image {
                background-position: 218px 0px;
            }
            .beneficio.col-lg-3.restaurantes .beneficio_image {
                width: 70px;
                background-position: 150px 0px;
            }
            .beneficio.col-lg-3.estaciones .beneficio_image {
                background-position: 60px 0px;
            }
            .beneficia{
                background-image: url("img/logo_beneficia.png");    height: 66px;
                width: 188px;
                margin: 0 auto;
                margin-top: 20px;
            }


            @media only screen and (max-width:1025px){
                .category-filter-container .category-filter-item .category-filter .cat-filter-icon {
                    height: 50px;
                    width: 50px;
                    background-repeat: no-repeat;
                    background-size: 100%;
                    margin: 0 auto;
                }
                .category-filter-container .category-filter-item .category-filter .cat-filter-title {

                    margin-bottom: 0;
                }
                .category-filter-container .category-filter-item {
                    height: 100%;
                    margin-bottom: 0px;
                }
                .sidebar .top p.title {
                    font-size: 17px;
                    line-height: 15px;
                }
            }
            @media only screen and (max-width:768px){
                .category-filter-container .category-filter-item .category-filter .cat-filter-icon {
                    height: 20px;
                    width: 20px;
                    background-repeat: no-repeat;
                    background-size: 100%;
                    margin: 0 auto;
                }.category-filter-container .category-filter-item .category-filter .cat-filter-title {
                    text-align: center;
                    font-size: 8px;
                    margin: 0;
                }
                .category-filter-container .category-filter-item {
                    height: 100%;
                    margin-bottom: 0px;
                    padding: 0;
                }
                .cities-filter-select-container {
                    margin: 0 auto;
                    width: 150px;
                    height: 30px;
                }
                .sidebar .top {
                    height: 340px;
                }
                .sidebar .beneficios {
                    font-size: 18px;
                }
                .beneficio.col-lg-3.efectivo .beneficio_image {
                    width: 30px;
                    background-repeat: no-repeat;
                    background-size: 155px;
                    background-position: 0px 0px;    height: 35px;
                }
                .beneficio.col-lg-3.movil .beneficio_image {
                    width: 30px;
                    background-repeat: no-repeat;
                    background-size: 155px;
                    background-position: -40px 0px;    height: 35px;
                }
                .beneficio.col-lg-3.restaurantes .beneficio_image {
                    width: 35px;
                    background-repeat: no-repeat;
                    background-size: 155px;
                    background-position: -77px 0px;    height: 35px;
                }
                .beneficio.col-lg-3.estaciones .beneficio_image {
                    width: 30px;
                    background-repeat: no-repeat;
                    background-size: 155px;
                    background-position: -130px 0px;    height: 35px;
                }
            }
            @media only screen and (max-width:425px){
                .sidebar .top {
                    height: 165px;
                }
                .sidebar .beneficios {
                    font-size: 18px;
                    height: 30px;
                    line-height: 30px;

                }
                .sidebar{
                    position: relative;
                }
                .category-filter-container .category-filter-item {
                    height: 60px;
                }
                .beneficio.col-lg-3 {
                    height: 40px;
                    padding: 0;
                }
                .container-beneficios {
                    margin-top: 10px;height: 45px;
                }
                .container-beneficios .checkbox-container {
                    margin-top: 0;
                }
                .container-beneficios .checkbox-container {
                    height: 30px;
                }
                .beneficio.col-lg-3.efectivo .beneficio_image,.beneficio.col-lg-3.restaurantes .beneficio_image,.beneficio.col-lg-3.estaciones .beneficio_image,.beneficio.col-lg-3.movil .beneficio_image {

                    height: 30px;
                }
                .beneficia {
                    height: 35px;
                    width: 100px;
                    margin: 0 auto;
                    margin-top: 20px;
                    background-size: 100px;
                    margin-bottom: 10px;
                }
                .center {
                    height: 650px;
                    box-sizing: content-box;
                    padding: 0;
                    padding-top: 315px;
                }
                ul.item-list {
                    list-style: none;
                    padding: 0;
                }
                .item .item-img {
                    width: 90px;
                    background: #850308;
                    height: 90px;
                    float: left;
                }
                .item .item-data .val {
                    font-size: 50px;
                    color: #b81d2c;
                    line-height: 55px;
                    font-weight: bold;
                    font-style: italic;
                    margin: 0;
                    float: left;
                }
                .item .item-data .item-disscount p.mini {
                    float: left;
                    color: #b81d2c;
                    line-height: 0px;
                    font-weight: bold;
                    font-size: 20px;
                    margin: 38px 0px 0px 5px;
                }
                .item .item-category-img {
                    position: absolute;
                    right: 35px;
                    width: 35px;
                    background-size: 35px;
                    background-repeat: no-repeat;
                    height: 35px;

                }
                .item .item-disscount {
                    height: 50px;
                    font-family: HelveticaNeueLTStd;
                }
                .item-apply-on {
                    font-family: HelveticaLight;
                    color: #b81d2c;
                    margin: 0;
                    width: 170px;
                    font-weight: bold;
                    line-height: 12px;
                    font-size: 9px;
                    overflow: hidden;
                }
                .item .item-data {
                    float: left;
                    margin-left: 5px;
                    width: 145px;
                }
                .item-address {
                    width: 145px;
                    font-size: 9px;
                    line-height: 9px;
                    padding-left: 50px;
                }
                .item {
                    background: #ebebeb;
                    height: 155px;
                    padding: 10px;
                    box-sizing: border-box;
                    margin: 15px 0px;
                    border-radius: 10px;
                }
            }
        </style>
        <div class="container">
            <!-- Example row of columns -->


            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12 sidebar">
                    <div class="top">
                        <p class="title">Descuentos en comercios amigos</p>
                        <div class="row">

                            <div class="category-filter-container">

                                <div class="category-filter-item col-xs-2 col-sm-4 col-lg-4 col-md-6">
                                    <div class="category-filter tecnologia">
                                        <div class="cat-filter-icon "></div>
                                        <div class="cat-filter-title">Tecnologia</div>
                                        <div class="cat-filter-checkbox-container">
                                            <input type="checkbox" class="cat-filter-checkbox"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="category-filter-item  col-xs-2 col-sm-4 col-lg-4 col-md-6">
                                    <div class="category-filter moda">
                                        <div class="cat-filter-icon"></div>
                                        <div class="cat-filter-title">Moda</div>
                                        <div class="cat-filter-checkbox-container">
                                            <input type="checkbox" class="cat-filter-checkbox"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="category-filter-item col-xs-2 col-sm-4 col-lg-4 col-md-6" >
                                    <div class="category-filter ninos">
                                        <div class="cat-filter-icon"></div>
                                        <div class="cat-filter-title">Niños</div>
                                        <div class="cat-filter-checkbox-container">
                                            <input type="checkbox" class="cat-filter-checkbox"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="category-filter-item  col-xs-2 col-sm-4 col-lg-4 col-md-6" >
                                    <div class="category-filter hogar">
                                        <div class="cat-filter-icon"></div>
                                        <div class="cat-filter-title">Hogar</div>
                                        <div class="cat-filter-checkbox-container">
                                            <input type="checkbox" class="cat-filter-checkbox"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="category-filter-item col-xs-2  col-sm-4 col-lg-4 col-md-6">
                                    <div class="category-filter vehiculos">
                                        <div class="cat-filter-icon"></div>
                                        <div class="cat-filter-title">Vehículos</div>
                                        <div class="cat-filter-checkbox-container">
                                            <input type="checkbox" class="cat-filter-checkbox"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="category-filter-item col-xs-2 col-sm-4  col-lg-4 col-md-6">
                                    <div class="category-filter otros">
                                        <div class="cat-filter-icon"></div>
                                        <div class="cat-filter-title">Otros</div>
                                        <div class="cat-filter-checkbox-container">
                                            <input type="checkbox" class="cat-filter-checkbox"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="cities-filter-container">
                            <div class="cities-filter-select-container">
                                <select class="cities-filter-select"></select>
                            </div>
                        </div>
                    </div>
                    <div class="beneficios">Beneficios Pranta!</div>
                    <div class="bottom">
                        <div class="container-beneficios">
                            <div class="beneficio col-lg-3 col-sm-3 col-xs-3 col-md-3 efectivo">
                                <div class="beneficio_image "></div>
                                <div  class="checkbox-container"><input type="checkbox"/></div>
                            </div>
                            <div class="beneficio col-lg-3 col-sm-3 col-md-3 col-xs-3  movil">
                                <div class="beneficio_image"></div>
                                <div class="checkbox-container"><input type="checkbox"/></div>
                            </div>
                            <div class="beneficio col-lg-3 col-sm-3 col-md-3 col-xs-3  restaurantes">
                                <div class="beneficio_image"></div>
                                <div  class="checkbox-container"><input type="checkbox"/></div>
                            </div>
                            <div class="beneficio col-lg-3 col-sm-3 col-md-3 col-xs-3  estaciones">
                                <div class="beneficio_image"></div>
                                <div  class="checkbox-container"><input type="checkbox"/></div>
                            </div>
                        </div>
                        <div class="beneficia">

                        </div>
                    </div>
                </div>
                <div class="col-md-9 center">
                    <ul class="item-list">
                        <li class="col-md-12 col-lg-6">
                            <div class="item">
                                <div class="item-img">
                                    <img src=""/>
                                </div>
                                <div class="item-data">
                                    <div class="item-category-img">

                                    </div>
                                    <div class="item-disscount">
                                        <p class="val">10%</p>
                                        <p class="mini">dto</p>
                                    </div>

                                    <div class="item-apply-on">
                                        En las marcas Phillips: minidomésticos y
                                        cuidado personal y GA.MA: Toda la línea
                                    </div>
                                    <div class="item-address">
                                        8 de Octubre
                                        8 de octubre
                                        8 de octubre
                                    </div></div>
                            </div>
                        </li>
                        <li class="col-md-12 col-lg-6">
                            <div class="item"></div>
                        </li>
                        <li class="col-md-12 col-lg-6">
                            <div class="item"></div>
                        </li>
                        <li class="col-md-12 col-lg-6">
                            <div class="item"></div>
                        </li>
                        <li class="col-md-12 col-lg-6">
                            <div class="item"></div>
                        </li>
                        <li class="col-md-12 col-lg-6">
                            <div class="item"></div>
                        </li>
                        <li class="col-md-12 col-lg-6">
                            <div class="item"></div>
                        </li>
                        <li class="col-md-12 col-lg-6">
                            <div class="item"></div>
                        </li>


                    </ul>
                </div>

            </div>

            <hr>

            <footer>
                <p>© 2015 Company, Inc.</p>
            </footer>
        </div>
    </body>
</html>