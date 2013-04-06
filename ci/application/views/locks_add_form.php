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
<label class="control-label" for="select01">Estado de bloqueo</label>
<div class="controls">
            <div class="switch" 
		data-on="success" 
		data-off="danger" 
		data-on-label="<i class='icon-unlock'></i>" 
		data-off-label="<i class='icon-lock'></i>">
                <input type="checkbox" checked />
<!--
$('#mySwitch').on('switch-change', function (e, data) {
    var $el = $(data.el)
      , value = data.value;
    console.log(e, $el, value);
});
-->
            </div>
</div>
</div>

<div class="control-group">
<label class="control-label" for="input01">Valor a bloquear</label>
<div class="controls">
<input type="text" class="input-xlarge" id="input01">
</div>
</div>


<div class="form-actions">
<button type="submit" class="btn btn-primary">Save changes</button>
<button type="reset" class="btn">Cancel</button>
</div>
</fieldset>
</form>
