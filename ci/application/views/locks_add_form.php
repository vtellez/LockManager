<form class="form-horizontal">
<fieldset>
<legend>Añadir nuevo bloqueo</legend>

<div class="control-group">
<label class="control-label" for="select01">Tipo de bloqueo</label>
<div class="controls">
<select id="select01">
<option>2</option>
<option>3</option>
<option>4</option>
<option>5</option>
</select>
</div>
</div>


<div class="control-group">
<label class="control-label" for="input01">Valor a bloquear</label>
<div class="controls">
<input type="text" class="input-xlarge" id="input01">
</div>
</div>

<div class="control-group">
<label class="control-label" for="select01">Estado de bloqueo</label>
<div class="controls">
     <div class="switch" 
		data-off="success" 
		data-on="danger" 
		data-off-label="<i class='icon-unlock'></i>" 
		data-on-label="<i class='icon-lock'></i>">
                <input type="checkbox" value="<?php echo $this->config->item('lock_state');?>"/>
            </div>
</div>
</div>

<div class="control-group">
<label class="control-label" for="input01">Comentarios</label>
<div class="controls">
<textarea rows="3" id="input01" class="input-xlarge"></textarea>
</div>
</div>

<div class="form-actions">
<button type="submit" class="btn btn-primary"><i class="icon-plus"></i> Añadir nuevo bloqueo</button>
</div>
</fieldset>
</form>
