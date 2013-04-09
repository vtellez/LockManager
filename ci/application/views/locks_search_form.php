<form class="form-horizontal" method="POST" action="<?php echo site_url('locks/repo/search');?>">
<fieldset>
<legend>Formulario de búsqueda</legend>

<div class="control-group">
<label class="control-label" for="select01">Tipo de bloqueo</label>
<div class="controls">
<select id="select01">
<option>Cualquiera</option>
<option>2</option>
<option>3</option>
<option>4</option>
<option>5</option>
</select>
</div>
</div>

<div class="control-group">
<label class="control-label" for="select01">Estado de bloqueo</label>
<div class="controls">
<select id="select01">
<option>Cualquiera</option>
	<option value="<?php echo $this->config->item('lock_state');?>">
			Bloqueos activos
	</option>
	<option value="<?php echo $this->config->item('unlock_state');?>">
			Bloqueos inactivos
	</option>
</select>
</div>
</div>

<div class="control-group">
<label class="control-label" for="input01">Valor bloqueado</label>
<div class="controls">
<input type="text" class="input-xlarge" id="input01">
<p class="help-block">Admite '*' como comodín.</p>
</div>
</div>

<div class="control-group">
<label class="control-label" for="input01">Usuario</label>
<div class="controls">
<input type="text" class="input-xlarge" id="input01">
<p class="help-block">Admite '*' como comodín.</p>
</div>
</div>


<div class="form-actions">
<button type="submit" class="btn btn-primary">
	<i class="icon-search icon-white"></i> Realizar búsqueda
</button>
</div>
</fieldset>
</form>
