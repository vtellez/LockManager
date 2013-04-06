<div class="tabbable tabs-left">
<ul class="nav nav-tabs">
<li class="active"><a href="#tab1" data-toggle="tab"><i class="icon-lock"></i> Bloqueos</a></li>
<li><a href="#tab2" data-toggle="tab"><i class="icon-time"></i> Registros</a></li>
</ul>


<div class="tab-content">
<div class="tab-pane active" id="tab1">
	<h3><i class="icon-lock"></i> &nbsp;Buscador de bloqueos</h3>
	<?php $this->load->view('locks_search_form'); ?>
</div>

<div class="tab-pane" id="tab2">
	<h3><i class="icon-time"></i> &nbsp;Buscador de registros</h3>
	<?php $this->load->view('logs_search_form'); ?>
</div>

</div>
</div>

