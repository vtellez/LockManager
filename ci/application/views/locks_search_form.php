<form class="form-horizontal" action="<?php echo site_url('locks/repo/');?>" method="post">
<fieldset>
<legend>Formulario de búsqueda</legend>

<div class="control-group">
<label class="control-label" for="lock_type">Tipo de bloqueo</label>
<div class="controls">
<select name="lock_type">
<option>Cualquiera</option>
<?php foreach ($lock_types->result() as $row)
{ 
    echo "<option value=\"$row->type_id\">$row->resource</option>";
}
?>
</select>
</div>
</div>

<div class="control-group">
<label class="control-label" for="state">Estado de bloqueo</label>
<div class="controls">
<select name="state">
<option value="all">Cualquiera</option>
	<option value="lock">
			Bloqueos activos
	</option>
	<option value="unlock">
			Bloqueos inactivos
	</option>
</select>
</div>
</div>

<div class="control-group">
<label class="control-label" for="value">Valor bloqueado</label>
<div class="controls">
<input type="text" class="input-xlarge" name="value">
<p class="help-block">Admite '*' como comodín.</p>
</div>
</div>

<div class="control-group">
<label class="control-label" for="owner">Usuario</label>
<div class="controls">
<input type="text" class="input-xlarge" name="owner">
<p class="help-block">Admite '*' como comodín.</p>
</div>
</div>

<input type="hidden" name="query" value="1" />

<div class="form-actions">
<button type="submit" class="btn btn-primary">
	<i class="icon-search icon-white"></i> Realizar búsqueda
</button>
</div>
</fieldset>
</form>
