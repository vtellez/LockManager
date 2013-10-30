<div class="tabbable tabs-left">
<ul class="nav nav-tabs">
<li><a href="#tab1" data-toggle="tab"><i class="icon-bar-chart"></i> Generales</a></li>
<li class="active"><a href="#tab2" data-toggle="tab"><i class="icon-lock"></i> Bloqueos</a></li>
</ul>


<div class="tab-content">
<div class="tab-pane" id="tab1">
	<h3><i class="icon-bar-chart"></i> &nbsp;&nbsp;Indicadores generales de Bloquea</h3>
	  <ul id="myTab" class="nav nav-tabs">
      <li class="active"><a href="#home" data-toggle="tab"><i class="icon-file"></i> Resumen del aplicativo</a></li>
    </ul>	
</div>

<div class="tab-pane active" id="tab2">
	<h3><i class="icon-lock"></i> &nbsp;&nbsp;Indicadores de bloqueos</h3>
	  <ul id="myTab" class="nav nav-tabs">
      <li class="active"><a href="#home" data-toggle="tab"><i class="icon-pushpin"></i> Todos</a></li>
      <li><a href="#profile" data-toggle="tab"><i class="icon-user"></i> Usuarios</a></li>
		<li>
		    <a href="#tab4" data-toggle="tab"><i class="icon-link"></i> Phishing</a>
		</li>
		<li>
		    <a href="#tab5" data-toggle="tab"><i class="icon-hdd"></i> Disco Virtual</a>
		</li>
		<li>
		    <a href="#tab6" data-toggle="tab"><i class="icon-globe"></i> Direcciones IP</a>
		</li>  
    </ul>
</div>


  
    <div id="myTab" class="tab-content">

      <div class="tab-pane fade in active" id="home">

      <?php 
		$data = array(
				'title' => 'PIE CHART',
			);
		$this->load->view('chart_pie',$data);

		$data = array(
				'title' => 'BAR CHART',
			);
		$this->load->view('chart_bar',$data);		
	  ?>
		</div>

    </div>



</div>
</div>