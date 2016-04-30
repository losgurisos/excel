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

        <style>
            @font-face {
                font-family: HelveticaLight;
                src: url("../fonts/Helvetica Light.ttf");
            }
            @font-face {
                font-family: HelveticaNeueLTStd;
                src: url("../fonts/HelveticaNeueLTStd-BdIt.otf");
            }

            .body{
                font-family: HelveticaLight;
            }
            .container {
                width: 100%;
            }
            .beneficios p{
                position: relative !important;
                width: 60% !important;
                padding-left: 40px !important;
                margin: 0 auto !important;
            }
            .beneficios p::before{
                content: " ";
                height: 45px;
                width: 31px;
                position: absolute;
                display: block;
                background: url("../img/icon_ubicacion.png");
                top: 5px;
                left: 5px;
            }
            .locations-map{
                height: 100%;
            }
            .item-apply-on {
                font-family: HelveticaLight;
                color: #b81d2c;
                margin: 2px !important;
                margin-top: 5px !important;
                width: 245px !important;
                font-weight: bold;
                line-height: 12px !important;
                font-size: 11px !important;
                overflow: hidden;
            }
            .location-excel-sidebar{
                padding: 0 !important;
                height: 750px !important;
                background: #850308;           
                position: absolute !important;
                z-index: 999;
            }
            .location-excel-sidebar .top{
                height:422px !important;background: #b81d2c;
            }
            .location-excel-sidebar .top p.title {
                color: white;
                font-family: HelveticaLight;
                font-size: 30px !important;
                text-align: center;
                margin: 0 auto !important;
                width: 85%;
                line-height: 25px !important;
                padding-top: 20px;margin-bottom: 30px !important;
            }
            .location-excel-sidebar .beneficios {
                line-height: 55px !important;
                height: 55px !important;
                background: #fdc600;
                color: white;
                font-size: 25px !important;
                font-weight: bold;
                text-align: center;
                margin-top: 20px !important;
            }
            .location-excel-sidebar .bottom{

            }
            .excel-center{
                height: 750px; box-sizing: content-box;
                padding-left: 25% !important;
            }
            .item-col{
                height: 650px;
            }
            .item {
                background: #ebebeb;
                height: 180px !important;
                padding: 15px !important;
                box-sizing: border-box;
                margin: 20px 5px;
                border-radius: 10px;
            }
            ul.item-list {
                list-style: none !important;
                padding: 30px !important;
            }
            .item .item-img{
                width: 150px;
                background: #4CAF50;
                height: 150px;float:left;}
            .item .item-img img{
                width: 100%;
                height: auto !important;
                overflow: hidden;
            }

            .item .item-data {
                float: left;
                margin-left: 15px !important;
            }
            .item .item-data .val{
                font-size: 80px  !important; color:#b81d2c;
                line-height: 75px !important;
                font-weight: bold;
                font-style: italic;
                margin: 0;
                float: left;
            }
            .item-category-img img{

            }
            .item .item-data .item-disscount p.mini {
                float: left; color:#b81d2c;
                line-height: 30px !important;

                font-weight: bold;
                font-size: 35px !important;
                margin: 38px 0px 0px 5px !important;
            }
            .item .item-disscount {
                height: 75px !important;
                font-family: HelveticaNeueLTStd;
            }
            .item .item-category-img {
                position: absolute;
                right: 35px !important;
                width: 60px !important;
                background-repeat: no-repeat;
                background-size: 60px !important;
                height: 60px!important;
                background-image: url('../img/icon_tecnologia_dark.png');
            }
            .item .item-category-img.tecnologia{
                background-image: url('../img/icon_tecnologia_dark.png');
            }
            .item .item-category-img.moda{
                background-image: url('../img/icon_moda_dark.png');
            }
            .item .item-category-img.ninos{
                background-image: url('../img/icon_ninos_dark.png');
            }
            .item .item-category-img.hogar{
                background-image: url('../img/icon_hogar_dark.png');
            }
            .item .item-category-img.otros{
                background-image: url('../img/icon_otros_dark.png');
            }
            .item .item-category-img.vehiculos{
                background-image: url('../img/icon_vehiculos_dark.png');
            }

            .item-address {font-family: HelveticaLight;
                           font-weight: bold;
                           position: relative;
                           margin-top: 10px !important;
                           width: 195px !important;
                           font-size: 11px;
                           line-height: 11px !important;
                           color: #5B5B5B;
                           padding-left: 50px !important;
            }
            hr {
                margin-top: 20px !important;
                margin-bottom: 20px !important;
                float: left !important;
                display: block !important;
                border: 0 !important;
                width: 100% !important;
                border-top: 3px solid #eee !important;
            }
            select {
                width: 100% !important;
                border: 0 !important;
            }
            .filter-depto,.filter-barrio {
                text-align: left !important;
                color: white;    height: 20px !important;
                font-size: 15px !important;
                padding: 0 !important;
                margin: 0 !important;    margin-bottom: 20px !important;
            }
            .filter-depto .label, .filter-depto .cbox,.filter-barrio .label, .filter-barrio .cbox{
                padding: 0 !important;line-height: 20px !important;    text-align: left !important;
            }
            .filter-container {
                margin: 0 !important;
                padding: 0 !important;
                height: 100% !important;
            }

            .container.parse-excel{
                padding: 0px 15px !important;
            }
            .container.parse-excel .row{
                margin: 0 !important;
            }
            .container{
                padding: 0 !important;
                margin: 0 !important;
                margin-top: 30px !important;
                width: 100% !important;
            }


            .item-address::before {
                content: " ";
                height: 30px !important;
                width: 20px !important;
                display: block;
                left: 15px !important;
                position: absolute;
                background-image: url("../img/location_pin.png");
            }

            .category-filter-container {
                margin: 15px 30px;
                height: 100%;
            }
            .category-filter-container .category-filter-item {
                height: 100% !important;
                margin-bottom: 20px !important;
            }
            .category-filter-container .category-filter-item .category-filter{
                height: 100px !important;
                width: 100% !important;
            }

            .category-filter-container .category-filter-item .tecnologia .cat-filter-icon{
                background: url('../img/icon_tecnologia.png');
            }
            .category-filter-container .category-filter-item  .moda .cat-filter-icon{
                background: url('../img/icon_moda.png');
            }
            .category-filter-container .category-filter-item  .ninos .cat-filter-icon{
                background: url('../img/icon_ninos.png');
            }
            .category-filter-container .category-filter-item  .hogar .cat-filter-icon{
                background: url('../img/icon_hogar.png');
            }
            .category-filter-container .category-filter-item  .otros .cat-filter-icon{
                background: url('../img/icon_otros.png');
            }
            .category-filter-container .category-filter-item  .vehiculos .cat-filter-icon{
                background: url('../img/icon_vehiculos.png');
            }
            .category-filter-container .category-filter-item .estadoc .cat-filter-icon{
                background: url('../img/icon_estado_cuenta.png');
            }
            .category-filter-container .category-filter-item .solicitud .cat-filter-icon{
                background: url('../img/icon_sol_prestamor.png');
            }
            .category-filter-container .category-filter-item .tarjeta .cat-filter-icon{
                background: url('../img/icon_tarjeta.png');
            }
            .category-filter-container .category-filter-item .sucursal .cat-filter-icon{
                background: url('../img/icon_ordenes_compra.png');
            }
            .category-filter-container .category-filter-item .category-filter .cat-filter-icon {
                height: 60px !important;
                width: 60px !important;
                background-repeat: no-repeat;
                background-size: 100%;
                margin: 0 auto;
            }
            .category-filter-container .category-filter-item .category-filter .cat-filter-title {
                color: white;
                width: 85px;
                margin: 0 auto !important;
                text-align: center !important;
                font-family: HelveticaLight;
                line-height: 12px !important;
                margin-top: 10px !important;
            }
            .category-filter-container .category-filter-item .category-filter .cat-filter-checkbox-container {
                width: 13px !important;
                height: 20px !important;
                line-height: 20px !important;
                margin: 0 auto !important;
            }
            .category-filter-container .category-filter-item .category-filter .cat-filter-checkbox {
                width: 100% !important;
                height: 100% !important;
            }
            .category-filter-container .category-filter-item .category-filter div {
                margin-bottom: 0!important;
            }
            .cities-filter-container {
                width: 100% !important;
                margin-bottom: 15px !important;
            }
            .cities-filter-select-container {
                margin: 0 auto;
                width: 210px !important;
                height: 30px !important;
            }
            .cities-filter-select {
                height: 100% !important;
                width: 100% !important;

            }

            .container-beneficios {
                margin-top: 30px !important;overflow: hidden;height: 95px !important;
            }
            .beneficio.col-lg-3 {
                height: 70px !important;
                padding: 0 !important;
            }
            .container-beneficios .checkbox-container{
                margin: 0 auto !important;
                width: 12px !important;
            }
            .beneficio.col-lg-3 .beneficio_image {
                width: 60px !important;
                display: block;
                margin: 0 auto !important;
                background-position: 0px 0px !important;
                height: 55px !important;
                background-image: url("../img/icons_beneficios.png");
            }
            .beneficio.col-lg-3.efectivo .beneficio_image {
                width: 60px !important;
                background-position: 0px 0px !important;
            }
            .beneficio.col-lg-3.movil .beneficio_image {
                background-position: 218px 0px !important;
            }
            .beneficio.col-lg-3.restaurantes .beneficio_image {
                width: 70px !important;
                background-position: 150px 0px !important;
            }
            .beneficio.col-lg-3.estaciones .beneficio_image {
                background-position: 60px 0px !important;
            }
            .beneficia{
                background-image: url("../img/logo_beneficia.png");    height: 66px;
                width: 188px !important;
                margin: 0 auto !important;
                margin-top: 20px !important;
            }
            .beneficio_name {
                color: white;
                text-align: center;
                font-size: 11px !important;
                margin-top: 10px !important;
            }
            .location-excel-sidebar .top {
                height: 585px !important;
                background: #b81d2c;
                margin-top: 85px !important;
            }
            .excel-center {
                padding: 0 !important;
                padding-left:25% !important;
            }
            #masthead{
                display :none;  
            }.separator{
                margin: 10px 0px !important;
                padding: 0 !important;
                position: relative !important;
            }
            .separator .absbox{
                position: absolute !important;
                height: 35px !important;
                width: 100% !important;
                color: white !important;
                text-align: center !important; 
            }
            .separator p{
                text-align: center !important;
                margin: 0 auto  !important;
                display: block  !important;
                width: 50%  !important;
                font-size: 27px  !important;
                background: #B81D2C  !important;
            }

            @media only screen and (min-width:1024px){
                height: 750px !important;
            }
            @media only screen and (max-width:1025px){
                .beneficios p {
                    position: relative !important;
                    width: 75% !important;
                    padding-left: 40px !important;
                    margin: 0 auto !important;
                }
                .cat-filter-title{    
                    width: 70px !important;
                    font-size: 12px !important;
                }
                .filter-depto, .filter-barrio{
                    font-size: 11px !important;
                }
                .separator p{
                    font-size: 18px !important;
                    line-height: 40px !important;
                }
                .category-filter-container .category-filter-item .category-filter .cat-filter-icon {
                    height: 50px !important; 
                    width: 50px !important;
                    background-repeat: no-repeat;
                    background-size: 100% !important;
                    margin: 0 auto !important;
                }
                .beneficio_name {
                    font-size: 8px  !important;
                }
                .category-filter-container .category-filter-item .category-filter .cat-filter-title {

                    margin-bottom: 0 !important;
                }
                .category-filter-container .category-filter-item {
                    height: 100% !important;
                    margin-bottom: 0px !important;
                }
                .location-excel-sidebar .top p.title {
                    font-size: 20px !important;
                    line-height: 15px !important;
                }
            }
            @media only screen and (max-width:768px){
                .beneficios p {
                    position: relative !important;
                    width: 85% !important;
                    padding-left: 40px !important;
                    margin: 0 auto !important;
                }
                .separator p{
                    font-size: 12px !important;
                    line-height: 40px !important;
                }
                .category-filter-container .category-filter-item .category-filter .cat-filter-icon {
                    height: 30px !important;
                    width: 30px !important;
                    background-repeat: no-repeat;
                    background-size: 100% !important;
                    margin: 0 auto;
                }
                .beneficio_name {
                    font-size: 6px  !important;
                }
                .category-filter-container .category-filter-item .category-filter .cat-filter-title {
                    text-align: center !important;
                    font-size: 8px  !important;
                    margin: 0 !important;
                }
                .category-filter-container .category-filter-item {
                    height: 100%;
                    margin-bottom: 0px !important;
                    padding: 0 !important;
                }
                .cities-filter-select-container {
                    margin: 0 auto !important;
                    width: 150px !important;
                    height: 30px !important;
                }
                .location-excel-sidebar .top {
                    height: 530px !important;
                }
                .location-excel-sidebar .beneficios {
                    font-size: 18px !important;
                }
                .beneficio.col-lg-3.efectivo .beneficio_image {
                    width: 30px !important;
                    background-repeat: no-repeat;
                    background-size: 155px;
                    background-position: 0px 0px !important;    height: 35px !important;
                }
                .beneficio.col-lg-3.movil .beneficio_image {
                    width: 30px !important;
                    background-repeat: no-repeat;
                    background-size: 155px !important;
                    background-position: -40px 0px !important;    height: 35px !important;
                }
                .beneficio.col-lg-3.restaurantes .beneficio_image {
                    width: 35px !important;
                    background-repeat: no-repeat;
                    background-size: 155px !important;
                    background-position: -77px 0px !important;    height: 35px !important;
                }
                .beneficio.col-lg-3.estaciones .beneficio_image {
                    width: 30px !important;
                    background-repeat: no-repeat;
                    background-size: 155px !important;
                    background-position: -130px 0px !important;    height: 35px !important;
                }
            }
            @media only screen and (max-width:425px){
                .beneficios p::before {
                    content: " ";
                    height: 45px !important;
                    width: 30px !important;
                    position: absolute !important;
                    display: block;
                    background-size: 15px !important;
                    background: url("../img/icon_ubicacion.png");
                    top: 5px !important;
                    background-repeat: no-repeat !important;
                    left: 5px !important;
                }
                .category-filter-container .category-filter-item .category-filter .cat-filter-title {
                    text-align: center !important;
                    padding: 0 !important;
                    width: 100% !important;
                    font-size: 8px !important;
                    margin: 0 !important;
                }
                .beneficios p {
                    position: relative !important;
                    width: 50% !important;
                    padding-left: 40px !important;
                    margin: 0 auto !important;
                }
                .cat-filter-title{   
                    width: 60px !important;
                    font-size: 12px !important;
                }
                .location-excel-sidebar .top{
                    margin-top: 15px !important;
                }
                .category-filter-container .category-filter-item .category-filter {
                    height: 55x !important;

                }
                .location-excel-sidebar .top {
                    height: 355px !important;
                }
                .excel-center {
                    padding-left: 0 !important;
                    padding-top: 370px !important;
                }

                .location-excel-sidebar .beneficios {
                    font-size: 18px  !important;
                    height: 30px !important;
                    line-height: 30px !important;

                }
                .location-excel-sidebar{
                    position: relative !important;height: 385px !important;
                }
                .category-filter-container .category-filter-item {
                    height: 60px !important;
                }
                .beneficio.col-lg-3 {
                    height: 40px !important;
                    padding: 0 !important;
                }
                .container-beneficios {
                    margin-top: 10px !important;
                    height: 55px !important;
                }
                .container-beneficios .checkbox-container {
                    margin: 0 auto !important;
                    width: 12px !important;
                    margin-top: 0px !important;
                }
                .beneficio_name {
                    font-size: 6px  !important;
                    margin: 0 !important;
                }
                .beneficio.col-lg-3.efectivo .beneficio_image,.beneficio.col-lg-3.restaurantes .beneficio_image,.beneficio.col-lg-3.estaciones .beneficio_image,.beneficio.col-lg-3.movil .beneficio_image {

                    height: 30px !important;
                }
                .beneficia {
                    height: 35px !important;
                    width: 100px !important;
                    margin: 0 auto;
                    margin-top: 20px !important;
                    background-size: 100px !important;
                    margin-bottom: 10px !important;
                }
                .excel-center {
                    height: 650px !important;
                    box-sizing: content-box;
                    padding: 0 !important;
                    padding-top: 325px !important;
                }
                ul.item-list {
                    list-style: none !important;
                    padding: 0 !important;
                }
                .item .item-img {
                    width: 90px !important;
                    background: #850308;
                    height: 90px !important;
                    float: left;
                }
                .item .item-data .val {
                    font-size: 50px  !important;
                    color: #b81d2c;
                    line-height: 55px !important;
                    font-weight: bold;
                    font-style: italic;
                    margin: 0 !important;
                    float: left !important;
                }
                .item .item-data .item-disscount p.mini {
                    float: left;
                    color: #b81d2c;
                    line-height: 0px;
                    font-weight: bold;
                    font-size: 20px  !important;
                    margin: 38px 0px 0px 5px !important;
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
                    margin: 0 !important;
                    width: 170px !important;
                    font-weight: bold;
                    line-height: 12px !important;
                    text-align: left;
                    font-size: 8px  !important;
                    overflow: hidden;
                }
                .item .item-data {
                    float: left;
                    margin-left: 5px;
                    width: 145px;
                }
                .item-address {
                    width: 145px;
                    font-size: 9px  !important;
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
            .entry-header{
                display:none;
            }
            .container{
                width: 100%;
                margin: 0 !important;
                padding: 0 !important;
            }
            .container {
                width: 100% !important;
            }

            .container.parse-excel {
                padding: 0 !important;
                margin: 0 !important;
                width: 100%;
            }
            #content ul li{
                list-style: none !important;
            }
            ul.item-list {
                padding: 0 !important;
            }
            .edit-link,.sep-str{
                display: none !important;
            }

        </style>
        <div class="container parse-excel">
            <!-- Example row of columns -->


            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12 location-excel-sidebar">
                    <div class="top">
                        <p class="title">Encontrá la sucursal más cercana a vos</p>
                        <div class="row">

                            <div class="category-filter-container">

                                <div class="col-lg-12 filter-container">
                                    <div class="filter-depto col-lg-12">
                                        <div class="label col-lg-6 col-md-6 col-sm-12">
                                            Elegí tu departamento
                                        </div>
                                        <div class="cbox col-lg-6 col-md-6 col-sm-12">
                                            <select>
                                                <option>Montevideo</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="filter-barrio col-lg-12">
                                        <div class="label col-lg-6 col-md-6 col-sm-12">
                                            Barrio/Localidad
                                        </div>
                                        <div class="cbox col-lg-6 col-md-6 col-sm-12">
                                            <select>
                                                <option>Montevideo</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 separator">
                                    <hr>
                                    <div class="absbox"><p>Locales con</p></div>
                                </div>
                                <div class="category-filter-item  col-xs-3 col-sm-6 col-lg-6 col-md-6">
                                    <div class="category-filter solicitud">
                                        <div class="cat-filter-icon"></div>
                                        <div class="cat-filter-checkbox-container">
                                            <input category="moda" type="checkbox" class="cat-filter-checkbox"/>
                                        </div>
                                        <div class="cat-filter-title">Solicitúd de prestamo</div>

                                    </div>
                                </div>
                                <div class="category-filter-item col-xs-3 col-sm-6 col-lg-6 col-md-6" >
                                    <div class="category-filter tarjeta">
                                        <div class="cat-filter-icon"></div>
                                        <div class="cat-filter-checkbox-container">
                                            <input category="ninos" type="checkbox" class="cat-filter-checkbox"/>
                                        </div>
                                        <div class="cat-filter-title">Solicitar tarjeta</div>

                                    </div>
                                </div>
                                <div class="category-filter-item col-xs-3 col-sm-6 col-lg-6 col-md-6">

                                    <div class="category-filter sucursal">
                                        <div class="cat-filter-icon "></div>
                                        <div class="cat-filter-checkbox-container">
                                            <input category="tecnologia" type="checkbox" class="cat-filter-checkbox"/>
                                        </div>
                                        <div class="cat-filter-title">Ordenes de compra</div>

                                    </div>
                                </div>


                                <div class="category-filter-item  col-xs-3 col-sm-6 col-lg-6 col-md-6" >
                                    <div class="category-filter estadoc">
                                        <div class="cat-filter-icon"></div>
                                        <div class="cat-filter-checkbox-container">
                                            <input category="hogar" type="checkbox" class="cat-filter-checkbox"/>
                                        </div>
                                        <div class="cat-filter-title">Pagos</div>

                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="beneficios"><p>Mi ubicación</p></div>
                    </div>

                </div>
                <div class="col-md-9 excel-center">
                    <div class="locations-map" id="locations-map">


                    </div>

                </div>

            </div>
    </body>
</html>