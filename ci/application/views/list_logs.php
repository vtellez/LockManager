<div id="freeow" class="freeow freeow-top-right"></div>

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

foreach ($rows->result() as $row)
{ ?>
<tr>
	<td>
	</td>
	<td>
        <i class='icon-<?php echo $row->icon; ?>'></i> <?php echo $row->resource; ?>
	</td>
	<td><a href="<?php echo site_url("locks/view/$row->lock_id"); ?>"><?php echo $row->value; ?></a></td>
	<td>
        <div id="lastupdate<?php echo $row->lock_id;?>">
        <?php echo date("d/m/Y, H:i",$row->date);?> por <?php echo $row->owner; ?>
        </div>
    </td>
</tr>


<?php 
}
?>
</tbody>
</table>

<?php echo $pagination->create_links(); ?>
