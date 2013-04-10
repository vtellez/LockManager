<div class="tabbable tabs-left">
<ul class="nav nav-tabs">
<li <?php echo ($section == "search" || $section == "results") ? 'class="active"' : '';?>>
    <a href="#search" data-toggle="tab">
    	<i class="icon-search"></i> Buscar
    </a>
</li>
<li <?php echo ($section == "add") ? 'class="active"' : '';?>>
    <a href="#new" data-toggle="tab">
    	<i class="icon-plus"></i> Añadir
    </a>
</li>
<h4 style="margin-top:25px; margin-bottom:10px; color: #666;">Consultar</h4>
<li <?php echo ($section == "all") ? 'class="active"' : '';?>>
    <a href="<?php echo site_url('locks/index/all');?>">
        <i class="icon-pushpin"></i> Todos</a>
</li>
<li <?php echo ($section == "user") ? 'class="active"' : '';?>>
    <a href="<?php echo site_url('locks/index/user');?>">
        <i class="icon-user"></i> Usuarios</a>
</li>
<li <?php echo ($section == "phishing") ? 'class="active"' : '';?>>
    <a href="<?php echo site_url('locks/index/phishing');?>">
        <i class="icon-link"></i> Phishing</a>
</li>
<li <?php echo ($section == "hdd") ? 'class="active"' : '';?>>
    <a href="<?php echo site_url('locks/index/hdd');?>">
        <i class="icon-hdd"></i> Disco Virtual</a>
</li>
<li <?php echo ($section == "ip") ? 'class="active"' : '';?>>
    <a href="<?php echo site_url('locks/index/ip');?>">
        <i class="icon-globe"></i> Direcciones IP</a>
</li>
</ul>


<div class="tab-content">

<div class="tab-pane <?php echo ($section == "search" || $section == "results") ? 'active' : '';?>" id="search">
		<h3><i class="icon-search"></i> &nbsp;Filtrado de bloqueos</h3>
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
					<h4>Resultados de la búsqueda (<?php echo $locks_count;?>)</h4>
				</div>
				<?php $this->load->view('filter_conditions'); ?>
				<?php $this->load->view('list_locks',$locks); ?>
			</div>
			<div class="tab-pane fade in" id="filter">
				<?php $this->load->view('locks_search_form'); ?>
			</div>
		</div>
	</div>
	<?php 
		}else
		{ 
		 $this->load->view('locks_search_form');
		} 
	?>	
</div>

<div class="tab-pane <?php echo ($section == "add") ? 'active' : '';?>" id="new">
	<h3><i class="icon-plus"></i> &nbsp;Alta de nuevo bloqueo</h3>
	<?php $this->load->view('locks_add_form'); ?>
</div>



<?php if ($section != "search" && $section != "results") { ?>
<div class="tab-pane active" id="locks">
	<h3>
     	<?php
			switch ($section) {
	    		case "ip":
					echo "<i class='icon-globe'></i> &nbsp;Bloqueos de direcciones IP";
					break;
				
	    		case "user":
					echo "<i class='icon-user'></i> &nbsp;Bloqueos de usuarios";
					break;
				
	    		case "phishing":
					echo "<i class='icon-link'></i> &nbsp;Bloqueos de Phishing";
					break;

	    		case "hdd":
					echo "<i class='icon-hdd'></i> &nbsp;Bloqueos de disco duro virtual";
					break;

				default:
					echo "<i class='icon-pushpin'></i> &nbsp;Todos los bloqueos";
					break;
			}	
		?>
    </h3>
	<div class="tabbable"> 
		<ul class="nav nav-tabs">
		<li <?php echo ($state == "lock") ? 'class="active"' : '';?>>
			<a href="<?php echo site_url("locks/repo/$section/lock");?>">
				<i class="icon-lock"></i> Activos
			</a>
		</li>
		<li <?php echo ($state == "unlock") ? 'class="active"' : '';?>>
			<a href="<?php echo site_url("locks/repo/$section/unlock");?>">
				<i class="icon-unlock"></i> Inactivos
			</a>
		</li>
		<li <?php echo ($state == "all") ? 'class="active"' : '';?>>
			<a href="<?php echo site_url("locks/repo/$section/all");?>">
				<i class="icon-list-alt"></i> Todos
			</a>
		</li>
		<li><a href="#filter" data-toggle="tab"><i class="icon-filter"></i> Filtrar</a></li>
		<li><a href="#add" data-toggle="tab"><i class="icon-plus-sign"></i> Añadir</a></li>
		</ul>

		<div class="tab-content">
			<div class="tab-pane fade in active" id="list">
				<div class="tab-title">
					<h4>Listado de bloqueos (<?php echo $locks_count;?>)</h4>
				</div>
				<?php $this->load->view('filter_conditions'); ?>
				<?php $this->load->view('list_locks',$locks); ?>
			</div>
			<div class="tab-pane fade in" id="filter">
				<?php $this->load->view('locks_search_form'); ?>
			</div>
			<div class="tab-pane fade in" id="add">
				<?php $this->load->view('locks_add_form'); ?>
			</div>
		</div>
	</div>
</div>

<?php } ?>

</div>
</div> <!-- tabbable tabs-left -->