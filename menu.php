
		<link rel="stylesheet" type="text/css" href="menu/css/component.css" />
		<script src="menu/js/modernizr.custom.js"></script>


		<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right" id="cbp-spmenu-s2">
			<!--<h3>Menu</h3> -->
			<ul>
			<li><a href="home.php">Home</a>	</li>		
			<li><a href="reporting.php">Reporting</a></li>	
			<li><a href="#">Listening</a></li>	
			
			<li><a href="#">Settings</a>
				  <ul>
					<li><a href="config_brands.php">Brands</a></li>
					<li><a href="config_persona.php">Persona based Keywords</a></li>
					<li><a href="dashboard.php">Dashboard</a></li>					
				  </ul>
			</li>	
			<li><a href="#">Notifications</a></li>			
			</ul>
		</nav>
	
		<script src="menu/js/classie.js"></script>
		<script>
			var menuRight = document.getElementById( 'cbp-spmenu-s2' ),
				body = document.body;

		
			showRight.onclick = slideMenuOnClick;
			
			function slideMenuOnClick()
			{
			$('#divUser').hide();  
$('#divNotify').hide(); 
				classie.toggle( this, 'active' );
				classie.toggle( menuRight, 'cbp-spmenu-open' );
				disableOther( 'showRight' );
			}
		

			function disableOther( button ) {
			
				if( button !== 'showRight' ) {
					classie.toggle( showRight, 'disabled' );
				}
				
			}
		</script>
	