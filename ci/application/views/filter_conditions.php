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

                                    case 'value like':
 	        	  						echo "Valor del bloqueo: ".str_replace("%", "*", $value);
 	        	  						break;

                                    case 'owner like':
 	        	  						echo "Bloqueo realizado por: ".str_replace("%", "*", $value);
 	        	  						break;

 	        	  					case 'locks.type_id':
 	        	  						echo "Tipo de bloqueo: ";
 	        	  						echo ($value == $this->config->item('ip_type')) ? 'Dirección IP' : '';
 	        	  						echo ($value == $this->config->item('user_type')) ? 'Usuario' : '';
 	        	  						echo ($value == $this->config->item('hdd_type')) ? 'Disco Virtual' : '';
 	        	  						echo ($value == $this->config->item('phishing_type')) ? 'Dirección Phishing' : '';
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
