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
 	        	  		<li><i class="icon-angle-right"></i> 
		  			    <?php echo $key;?> es: <?php echo $value;?></li>
                    <?php
                    }
                ?>
		  </ul>
		</div>
	</div>
</div>
