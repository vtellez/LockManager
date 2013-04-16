<div class="tabbable tabs-left">
<ul class="nav nav-tabs">
<li <?php echo ($section == "search" || $section == "results") ? 'class="active"' : '';?>>
	<a href="#search" data-toggle="tab">
		<i class="icon-search"></i> Buscar
	</a>
</li>
<h4 style="margin-top:25px; margin-bottom:10px; color: #666;">Consultar</h4>
<li <?php echo ($section == "all") ? 'class="active"' : '';?>>
	<a href="<?php echo site_url('logs/repo/all');?>">
		<i class="icon-pushpin"></i> Todos
	</a>
</li>
<li <?php echo ($section == "users") ? 'class="active"' : '';?>>
	<a href="<?php echo site_url('logs/repo/users');?>">
		<i class="icon-user"></i> Usuarios
	</a>
</li>
<li <?php echo ($section == "auto") ? 'class="active"' : '';?>>
	<a href="<?php echo site_url('logs/repo/auto');?>">
		<i class="icon-cogs"></i> Automáticos
	</a>
</li>
</ul>

<div class="tab-content">


<div class="tab-pane <?php echo ($section == "search" || $section == "results") ? 'active' : '';?>" id="search">
		<h3><i class="icon-search"></i> &nbsp;Filtrado de eventos</h3>
	<?php 
		if($results || $section == "results"){
	?>
	<div class="tabbable"> 
		<ul class="nav nav-tabs">
		<li class="active">
			<a href="#results" data-toggle="tab"><i class="icon-list-alt"></i>
			 Resultados</a>
		</li>
		<li><a href="#filter" data-toggle="tab"><i class="icon-search"></i> 
			Nueva búsqueda</a>
		</li>
		</ul>

		<div class="tab-content">
			<div class="tab-pane fade in active" id="results">
				<div class="tab-title">
					<h4>Resultados de la búsqueda (<?php echo $count;?>)</h4>
				</div>
				<?php $this->load->view('filter_conditions'); ?>
				<?php $this->load->view('list_locks',$rows); ?>
			</div>
			<div class="tab-pane fade in" id="filter">
				<?php $this->load->view('logs_search_form'); ?>
			</div>
		</div>
	</div>
	<?php 
		}else
		{ 
		 $this->load->view('logs_search_form');
		} 
	?>	
</div>


<?php if ($section != "search" && $section != "results") { ?>
<div class="tab-pane active" id="locks">
	<h3>
     	<?php
			switch ($section) {			
	    		case "users":
					echo "<i class='icon-user'></i> &nbsp;Eventos de usuarios";
					break;
				
	    		case "auto":
					echo "<i class='icon-cogs'></i> &nbsp;&nbsp;Eventos automáticos";
					break;

	    		default:
					echo "<i class='icon-pushpin'></i> &nbsp;Todos los eventos";
					break;
			}	
		?>
    </h3>
	<div class="tabbable"> 
		<ul class="nav nav-tabs">
		<li class="active">
			<a href="#list" data-toggle="tab">
				<i class="icon-list"></i> Listado de eventos
			</a>
		</li>
		<li><a href="#filter" data-toggle="tab"><i class="icon-filter"></i> Filtrar</a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane fade in active" id="list">
				<div class="tab-title">
					<h4>Listado de bloqueos (2)</h4>
				</div>
				<?php $this->load->view('filter_conditions'); ?>
				<?php $this->load->view('list_logs',$rows); ?>
			</div>
			<div class="tab-pane fade in" id="filter">
				<?php $this->load->view('logs_search_form'); ?>
			</div>
		</div>
	</div>
</div>

<?php } ?>

</div>
</div> <!-- tabbable tabs-left -->