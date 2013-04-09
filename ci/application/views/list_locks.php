<div id="freeow" class="freeow freeow-top-right"></div>

<script type="text/javascript">
function changeLockState(lockId,lockValue)
{
    /*
    * Función que se encarga de realizar una consulta AJAX para 
    * cambiar el estado y actualizar el timestamp de un bloqueo
    */
    $.ajax(
    {
        type: 'POST',
        url: '<?php echo site_url(); ?>/ws/changeLockState/'+lockId,
        data: 'lock_id='+lockId,

        beforeSend : function (resp) {
       },

        success: function(resp) 
        {            
            var mySplit = resp.split("#");
            var date = mySplit[0]; 
            var owner = mySplit[1]; 
            var divid = "#lastupdate"+lockId;
            $(divid).html(date+" por el usuario "+owner);
  
             $("#freeow").freeow("Bloqueo actualizado","El estado del bloqueo ha cambiado con éxito.", {
                classes: ["smokey","success","slide"],
            });

       },

        error: function (xhr, ajaxOptions, thrownError)
        {   
 
             $("#freeow").freeow("Error",xhr.responseText, {
                classes: ["smokey","error","slide"],
            });

        }
    });
}

</script>

<table class="table table-bordered table-striped">
<thead>
<tr>
<th width="90px">Estado</th>
<th width="120px">Tipo de bloqueo</th>
<th width="240px">Valor bloqueado</th>
<th><i class="icon-double-angle-down"></i> Última actualización</th>
</tr>
</thead>
<tbody>


<?php

foreach ($locks->result() as $row)
{ ?>
<tr>
	<td>
        <div class="switch switch-small" 
        data-off="success" 
        data-on="danger" 
        data-off-label="<i class='icon-unlock'></i>" 
        data-on-label="<i class='icon-lock'></i>"
		id = "mySwitch<?php echo $row->lock_id; ?>">
        <input type="checkbox" class="mySwitch" <?php echo ($row->state == $this->config->item('lock_state')) ? 'checked' : '';?>/>
	   <script type="text/javascript">
	       	$('#mySwitch<?php echo $row->lock_id; ?>').on('switch-change', function (e, data) {
        		changeLockState(<?php echo "$row->lock_id,'$row->value'"; ?>);
          });
         </script>
        </div>
	</td>
	<td>
        <i class='icon-<?php echo $row->icon; ?>'></i> <?php echo $row->resource; ?>
	</td>
	<td><a href="<?php echo site_url("locks/view/$row->lock_id"); ?>"><?php echo $row->value; ?></a></td>
	<td>
        <div id="lastupdate<?php echo $row->lock_id;?>">
        <?php echo date("d/m/Y, H:i",$row->date);?> por el usuario <?php echo $row->owner; ?>
        </div>
    </td>
</tr>


<?php 
}
?>
</tbody>
</table>

<?php echo $pagination->create_links(); ?>
