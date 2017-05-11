		</div> <!-- content -->

	</div> <!-- wrapper -->

	<div id="footer">Created for back-end development practice</div>

	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>

	<script type="text/javascript">

		$(document).on("click",".logout", function(){
			var exit = confirm("Are you sure you would like to sing out?");

			if (exit == true) {
				location.replace("header.php?logout=true");
			}
				
			return false;
		});

		$(".dropdown, a.drpdownCont, p.drpdownCont").hover(function() {
			$("#drpdownBtn i").toggleClass("fa fa-angle-right fa fa-angle-down");
			return false;
		});


	</script>

</body>

</html