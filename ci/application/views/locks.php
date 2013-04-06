

<div class="tabbable tabs-left">
<ul class="nav nav-tabs">
<li><a href="#search" data-toggle="tab"><i class="icon-search"></i> Buscar</a></li>
<li><a href="#locks" data-toggle="tab"><i class="icon-list-alt"></i> Todos</a></li>
<li class="active"><a href="#locks" data-toggle="tab"><i class="icon-user"></i> Usuarios</a></li>
<li><a href="#locks" data-toggle="tab"><i class="icon-warning-sign"></i> Phishing</a></li>
<li><a href="#locks" data-toggle="tab"><i class="icon-globe"></i> Direcciones IP</a></li>
<li><a href="#locks" data-toggle="tab"><i class="icon-hdd"></i> Disco Virtual</a></li>
</ul>


<div class="tab-content">

<div class="tab-pane" id="search">
	<h3><i class="icon-search"></i> &nbsp;Filtrado de bloqueos</h3>
	<?php $this->load->view('locks_search_form'); ?>
</div>


<div class="tab-pane active" id="locks">
	<h3><i class="icon-user"></i> &nbsp;Usuarios bloqueados</h3>
	<div class="tabbable"> 
		<ul class="nav nav-tabs">
		<li class="active"><a href="#list" data-toggle="tab"><i class="icon-list-alt"></i> Listado de bloqueos</a></li>
		<li><a href="#filter" data-toggle="tab"><i class="icon-filter"></i> Filtrar bloqueos</a></li>
		<li><a href="#add" data-toggle="tab"><i class="icon-plus-sign"></i> Añadir nuevo</a></li>
		</ul>

		<div class="tab-content">
			<div class="tab-pane fade in active" id="list">
				<div class="tab-title">
					<h4>Listado de bloqueos (378)</h4>
				</div>
				<?php $this->load->view('filter_conditions',$locks); ?>
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
