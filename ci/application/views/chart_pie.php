  <script type="text/javascript">
    $(function() {
		// Randomly Generated Data
		var data = [],
			series = Math.floor(Math.random() * 6) + 3;

		for (var i = 0; i < series; i++) {
			data[i] = {
				label: "Series" + (i + 1),
				data: Math.floor(Math.random() * 100) + 1
			}
		}

		$.plot('#placeholder2', data, {
		    series: {
		        pie: {
		            show: true,
		            combine: {
		                color: '#999',
		                threshold: 0.1
		            }
		        }
		    },
		    grid: {
		        hoverable: true,
		        clickable: true
		    },
		    legend: {
		        show: false
		    }
		});

    });
  </script>
		<div class="demo-container">
			<h4><?php echo $title; ?></h4>
			<div id="placeholder2" class="demo-placeholder"></div>
		</div>