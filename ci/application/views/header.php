<?php
	$controller_name = $this->uri->segment(1);
?>
<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Víctor Téllez">
  <title>Bloquea | Universidad de Sevilla</title>
	<link href="<?php echo base_url("css/font-awesome.css"); ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url("css/bootstrapSwitch.css"); ?>" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url("css/freeow/freeow.css"); ?>" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url("css/bootstrap-spacelab.css"); ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url("css/extra.css"); ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url("img/favicon.ico"); ?>" rel="stylesheet" type="text/css">   

  <!-- Le javascript
    ================================================== -->
  <script type="text/javascript" src="<?php echo base_url("js/jquery.min.js");?>"></script>
  <script src="<?php echo base_url("js/flot/jquery.flot.js");?>"></script>
  <script src="<?php echo base_url("js/flot/jquery.flot.pie.js");?>"></script>  
  <script src="<?php echo base_url("js/bootstrap.js");?>"></script>
  <script src="<?php echo base_url("js/bootstrapSwitch.js");?>"></script>
  <script src="<?php echo base_url("js/jquery.freeow.js");?>"></script>  
  <!--[if lte IE 8]>
  <script language="javascript" type="text/javascript" src="<?php echo base_url("js/flot/excanvas.min.js");?>">
  </script>
  <![endif]-->

<script type="text/javascript">
$(function(){
    //Back to top function
    $(window).scroll(function() {
            if($(this).scrollTop() != 0) {
                    $('#toTop').fadeIn();   
            } else {
                    $('#toTop').fadeOut();
            }
    });

    $('#toTop').click(function() {
            $('body,html').animate({scrollTop:0},600);
    }); 

    //Initial load of page
    $(document).ready(sizeContent);

    //Every resize of window
    $(window).resize(sizeContent);

    //Dynamically assign height
    function sizeContent() {
      var newHeight = $(window).height()-230+"px";
      //if ($('.tab-content').height() < $(document).height()){
        $(".tab-content").css("min-height", newHeight);
    //}
    }       
    });
</script>

    </head>

  
    <body>

<div id="toTop"> ^ </div>

<div class="navbar navbar-fixed-top navbar-inverse navbar-fluid">
      <div class="navbar-inner">
        <div class="container-fluid">
            <a class="brand" href="<?php echo base_url();?>">
                <i class="icon-lock icon-white" style="margin-top:5px;"></i>
                Bloquea - Universidad de Sevilla
            </a>
        </div>
      </div>
    </div>
<div class="container-fluid">

<!-- Subnav
================================================== -->
<div class="subnav sombra">
    <ul class="nav nav-pills mio">
          <li>
                <a href="<?php echo site_url("dashboard");?>"
		<?php echo ($controller_name == "dashboard") ? 'class="current"' : "";?>
		<?php echo ($controller_name == "") ? 'class="current"' : "";?>>
                <i class="icon-th-large"></i> Dashboard</a>
          </li>
	        <li>
                <a href="<?php echo site_url("search");?>"
		<?php echo ($controller_name == "search") ? 'class="current"' : "";?>>
                <i class="icon-search"></i> Buscador</a>
          </li>
          <li>
                <a href="<?php echo site_url("locks");?>"
		<?php echo ($controller_name == "locks") ? 'class="current"' : "";?>>
                <i class="icon-lock"></i> Bloqueos</a>
          </li>
	        <li>
                <a href="<?php echo site_url("logs");?>"
		<?php echo ($controller_name == "logs") ? 'class="current"' : "";?>>
                <i class="icon-time"></i> Registros</a>
          </li>
          <li>
                <a href="<?php echo site_url("stats");?>"
		<?php echo ($controller_name == "stats") ? 'class="current"' : "";?>>
                <i class="icon-bar-chart"></i> Indicadores</a>
          </li>
          <li>
                <a href="<?php echo site_url("help");?>"
		<?php echo ($controller_name == "help") ? 'class="current"' : "";?>>
                <i class="icon-question-sign"></i> Ayuda</a>
          </li>
	        <li>
                <a href="<?php echo site_url("logout"); ?>">
                <i class="icon-off"></i> Salir</a>
          </li>
    </ul>
  </div>

<article class="data-block">
<header>
<h2><i class="<?php echo $icon;?>" style="margin-top:5px;"></i>&nbsp; <?php echo $subtitle; ?></h2>
</header>
<section class="tab-content">