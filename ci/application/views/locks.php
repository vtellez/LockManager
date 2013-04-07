

<div class="tabbable tabs-left">
<ul class="nav nav-tabs">
<li <?php echo ($section == "search") ? 'class="active"' : '';?>>
    <a href="#search" data-toggle="tab"><i class="icon-search"></i> Buscar</a></li>

<li <?php echo ($section == "all") ? 'class="active"' : '';?>>
    <a href="<?php echo site_url('locks/index/all');?>">
        <i class="icon-list-alt"></i> Todos</a>
</li>

<li <?php echo ($section == "user") ? 'class="active"' : '';?>>
    <a href="<?php echo site_url('locks/index/user');?>">
        <i class="icon-user"></i> Usuarios</a>
</li>
<li <?php echo ($section == "phishing") ? 'class="active"' : '';?>>
    <a href="<?php echo site_url('locks/index/phishing');?>">
        <i class="icon-warning-sign"></i> Phishing</a>
</li>
<li <?php echo ($section == "ip") ? 'class="active"' : '';?>>
    <a href="<?php echo site_url('locks/index/ip');?>">
        <i class="icon-globe"></i> Direcciones IP</a>
</li>
<li <?php echo ($section == "hdd") ? 'class="active"' : '';?>>
    <a href="<?php echo site_url('locks/index/hdd');?>">
        <i class="icon-hdd"></i> Disco Virtual</a>
</li>
</ul>


<div class="tab-content">

<div class="tab-pane  <?php echo ($section == "search") ? 'active' : '';?>" id="search">
	<h3><i class="icon-search"></i> &nbsp;Filtrado de bloqueos</h3>
	<?php $this->load->view('locks_search_form'); ?>
</div>


<div class="tab-pane  <?php echo ($section != "search") ? 'active' : '';?>" id="locks">
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
					echo "<i class='icon-warning-sign'></i> &nbsp;Bloqueos de Phishing";
					break;

	    		case "hdd":
					echo "<i class='icon-hdd'></i> &nbsp;Bloqueos de disco duro virtual";
					break;

				default:
					echo "<i class='icon-list-alt'></i> &nbsp;Todos los bloqueos";
					break;
			}	
		?>
    </h3>
	<div class="tabbable"> 
		<ul class="nav nav-tabs">
		<li class="active"><a href="#list" data-toggle="tab"><i class="icon-list-alt"></i> Listado de bloqueos</a></li>
		<li><a href="#filter" data-toggle="tab"><i class="icon-filter"></i> Filtrar bloqueos</a></li>
		<li><a href="#add" data-toggle="tab"><i class="icon-plus-sign"></i> Añadir nuevo</a></li>
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

</div>
</div> <!-- tabbable tabs-left -->
