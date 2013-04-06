<!--
<div class="btn-toolbar pull-right"> 

<div class="btn-group">
<a class="btn dropdown-toggle" data-toggle="dropdown" href="http://choquito.us.es/bloquea/index.php/locks#"><i class="icon-list-alt"></i> Registros <span class="caret"></span></a>
<ul class="dropdown-menu">
<li><a href=""> 15 registros</a></li>
<li><a href=""> 30 registros</a></li>
<li><a href=""> 50 registros</a></li>
<li><a href=""> 100 registros</a></li>
<li class="divider"></li>
<li><a href=""><i class="icon-list-alt"></i> Toda la tabla</a></li>
</ul>
</div>

<div class="btn-group">
<a class="btn" href="http://choquito.us.es/bloquea/index.php/locks#"><i class="icon-print"></i> Imprimir</a>
</div>


</div>
-->



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
		data-on="success" 
		data-off="danger" 
		data-on-label="<i class='icon-unlock'></i>" 
		data-off-label="<i class='icon-lock'></i>"
		id = "mySwitch<?php echo $row->lock_id; ?>">
        <input type="checkbox" class="mySwitch" <?php echo ($row->state == 1) ? '' : 'checked';?>/>

	<script type="text/javascript">
		$('#mySwitch<?php echo $row->lock_id; ?>').on('switch-change', function (e, data) {
		    alert("Hola");
		});
    </script>

        </div>
	</td>
	<td>
		<?php
			switch ($row->type_id) {
				case '1':
					echo "<i class='icon-globe'></i> Dirección IP";
					break;
				
				case '2':
					echo "<i class='icon-user'></i> Usuario";
					break;
				
				case '3':
					echo "<i class='icon-warning-sign'></i> Phishing";
					break;

				case '4':
					echo "<i class='icon-cloud'></i> Disco Virtual";
					break;

				default:
					echo "<i class='icon-question-sign'></i> No definido";
					break;
			}	
		?>
	</td>
	<td><a href="#"><?php echo $row->value; ?></a></td>
	<td><?php echo date("d/m/Y, H:i",$row->date);?> por el usuario <a href="#"><?php echo $row->owner; ?></a></td>
</tr>


<?php 
}
?>
</tbody>
</table>


<div class="pagination pull-right">
<ul>
<li class="disabled"><a href="#">«</a></li>
<li class="active"><a href="#">1</a></li>
<li><a href="#">2</a></li>
<li><a href="#">3</a></li>
<li><a href="#">4</a></li>
<li><a href="#">5</a></li>
<li><a href="#">»</a></li>
</ul>
</div>
