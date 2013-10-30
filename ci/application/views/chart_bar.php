  <script type="text/javascript">
    $(function() {
      var d2 = [[0, 3], [2, 8], [4, 5], [6, 13],[8, 13],[10, 13],[12, 13],[14, 13],[16, 13],[18, 13],[20, 13]];
		
	$.plot("#placeholder", [ 
			{
				data: d2,
				bars: { show: true },
			}
		]);
    });
  </script>

		<div class="demo-container">
			<h4><?php echo $title; ?></h4>		
			<div id="placeholder" class="demo-placeholder"></div>
		</div>
