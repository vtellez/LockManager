<div class="tabbable tabs-left">
<ul class="nav nav-tabs">
<li class="active"><a href="#tab4" data-toggle="tab"><i class="icon-search"></i> Buscar</a></li>
<li><a href="#tab1" data-toggle="tab"><i class="icon-list-alt"></i> Todos</a></li>
<li><a href="#tab3" data-toggle="tab"><i class="icon-user"></i> Usuarios</a></li>
<li><a href="#tab2" data-toggle="tab"><i class="icon-cogs"></i> Automáticos</a></li>

</ul>


<div class="tab-content">
<div class="tab-pane" id="tab1">
	<h3><i class="icon-list-alt"></i> &nbsp;Todos los registros</h3>
</div>

<div class="tab-pane active" id="tab4">
	<h3><i class="icon-search"></i> &nbsp;Filtrar registros</h3>
	<?php $this->load->view('logs_search_form'); ?>
</div>



</div>
</div>

