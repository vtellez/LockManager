<div class="row-fluid">
	<div class="span10 offset1">
		<div class="alert alert-block">
		  <button type="button" class="close" data-dismiss="alert">&times;</button>
		  <h4><i class="icon-filter"></i> Condiciones de filtrado aplicadas</h4>
		  <ul>
                <?php
                    if(sizeof($where_array) == 0){
 	        	  		echo '<li><i class="icon-angle-right"></i> Ninguna condición definida';
                    }

                    while (list($key,$value) = each($where_array))
                    {
                    ?>
 	        	  		<li>
 	        	  			<i class="icon-angle-right"></i> 
 	        	  			<?php 
 	        	  				switch($key)
 	        	  				{
 	        	  					case 'state':
 	        	  						echo "Estado del bloqueo: ";
 	        	  						echo ($value == $this->config->item('lock_state')) ? 'Activo' : 'Inactivo';
 	        	  						break;

 	        	  					case 'locks.type_id':
 	        	  						echo "Tipo de bloqueo: ";
 	        	  						break;

 	        	  					default:
 	        	  						echo "$key es $value";
 	        	  						break;
 	        	  				}
 	        	  			?>
		  				</li>
                    <?php
                    }
                ?>
		  </ul>
		</div>
	</div>
</div>
