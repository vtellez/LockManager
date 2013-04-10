<form class="form-horizontal" method="post" 
    action="<?php echo site_url('locks/add');?>">
<fieldset>
<legend>Formulario de alta</legend>

<div class="control-group">
<label class="control-label" for="lock_type">Tipo de bloqueo</label>
<div class="controls">
<select name="lock_type">
<?php foreach ($lock_types->result() as $row)
{ 
    echo "<option value=\"$row->type_id\"";

   if ( $section == strtolower($row->name) )
    {
        echo "selected";
    } 

    echo ">$row->resource</option>";
}
?>
</select>
</div>
</div>

<div class="control-group">
<label class="control-label" for="value">Valor a bloquear *</label>
<div class="controls">
<input type="text" class="input-xlarge" name="value">
<p class="help-block">(*) Campo obligatorio.</p>
</div>
</div>

<div class="control-group">
<label class="control-label" for="state">Estado de bloqueo</label>
<div class="controls">
     <div class="switch" 
		data-off="success" 
		data-on="danger" 
		data-off-label="<i class='icon-unlock'></i>" 
		data-on-label="<i class='icon-lock'></i>">
                <input type="checkbox" name ="state"
                 value="<?php echo $this->config->item('lock_state');?>"/>
            </div>
</div>
</div>

<div class="control-group">
<label class="control-label" for="comments">Comentarios</label>
<div class="controls">
<textarea rows="3" name="comments" class="input-xlarge"></textarea>
</div>
</div>

<input type="hidden" name="query" value="1" />

<div class="form-actions">
<button type="submit" class="btn btn-primary"><i class="icon-plus"></i> Añadir nuevo bloqueo</button>
</div>
</fieldset>
</form>
