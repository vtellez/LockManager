<div class="tabbable tabs-left">
<ul class="nav nav-tabs">
<li class="active"><a href="#tab1" data-toggle="tab"><i class="icon-lock"></i> Bloqueo</a></li>
<li><a href="javascript:history.back(1);"><i class="icon-reply"></i> Volver atrás</a></li>
</ul>

<div class="tab-content">
<div class="tab-pane active" id="tab1">
	<h3><i class="icon-<?php echo $lock->icon; ?>"></i> &nbsp;<?php echo $lock->resource; ?> (<?php echo $lock->value; ?>)</h3>

<div class="tab-pane active" id="locks">
    <div class="tabbable"> 
        <ul class="nav nav-tabs">
        <li class="active"><a href="#info" data-toggle="tab"><i class="icon-info-sign"></i> Información general</a></li>
        <li><a href="#history" data-toggle="tab"><i class="icon-calendar"></i> Auditoría e historial</a></li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade in active" id="info">
                <div class="row-fluid">
                 <div class="span4 offset2">
                <center>
                <a href="#" 
                class="btn btn-large" style="padding-left:30px;padding-right:30px;padding-top:35px;">
                <h3><i class="icon-<?php echo $lock->icon;?> icon-4x"></i>
                <br/><br/><?php echo $lock->value;?></h3>
                <p>Identificador del recurso</p>
                </a>
                </center>
                </div><!--/span-->
                <div class="span4">
                <center>
                <a href="#" 
                class="btn btn-large" style="padding-left:30px;padding-right:30px;padding-top:35px;">
                <h3><i class="icon-<?php echo ($lock->state == $this->config->item('lock_state')) ? 'lock' : 'unlock';?> icon-4x"></i>
                <br/><br/><?php echo ($lock->state == $this->config->item('lock_state')) ? 'Bloqueado' : 'Desbloqueado';?>
                </h3>
                <p>Estado actual del bloqueo</p>
                </a>
                </center>
                </div><!--/span-->
                </div><!--/row-->
<br/>
<br/>

<table class="table table-bordered table-striped">
<thead>
<tr>
<th width="190px">Parámetro</th>
<th>Valor</th>
</tr>
</thead>
<tbody>
<tr>
    <td><i class="icon-tag"></i> Tipo de recurso</td>
    <td>
	   <i class='icon-<?php echo $lock->icon; ?>'></i> <?php echo $lock->resource; ?>
    </td>
</tr>
<tr>
    <td><i class="icon-adjust"></i> Estado del bloqueo</td>
    <td>
        <?php echo ($lock->state == $this->config->item('lock_state')) ? 'Bloqueado' : 'Desbloqueado';?>
    </td>
</tr>
<tr>
    <td><i class="icon-edit"></i> Valor</td>
    <td>
        <?php echo $lock->value;?>
    </td>
</tr>
<tr>
    <td><i class="icon-calendar"></i> Última actualización</td>
    <td>
        <?php echo date("d/m/Y, H:i",$lock->date);?> por el usuario <?php echo $lock->owner; ?>
    </td>
</tr>
<tr>
    <td><i class="icon-dashboard"></i> Contador de bloqueos</td>
    <td>
        <?php echo $lock->lock_counter;?>
    </td>
</tr>
<tr>
    <td><i class="icon-comment"></i> Comentarios<br/><br/></td>
    <td>
        <?php echo $lock->comment;?>
    </td>
</tr>
</tbody>
</table>





            </div>

            <div class="tab-pane fade in" id="history">
                <div class="tab-title">
                </div>
            </div>
        </div>



</div>

</div>
</div>

