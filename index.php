<!doctype html>
<html>
	<head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
		<script type="text/javascript" async="" src="recipefind.js"></script>
	</head>
	<body>
		<h1 style="text-align: center">
			Radonic and Fleming ---  Recipe Clippings
		</h1>
		<div style="margin-left:200px" >
			
<!-- 			<p id="monitor"></p><br>	  -->
			<form id="f1" name="f1" action="javascript:void()" onsubmit="if(this.t1.value!=null &amp;&amp; this.t1.value!='')
				window.findString(this.t1.value);return false;" _lpchecked="1">
				<label for="t1">Search for:</label><br>
				<input type="text" id="t1" name="t1" size="25">
				
				
			</form>
	
			<?php 
				include 'getlistofrecipes.php';
				//phpinfo();
			?>
			
			
		</div>
	</body>  
	<script>
		$.expr[":"].contains = $.expr.createPseudo(function(arg) {
		    return function( elem ) {
		        return $(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0; 
		    };
		});
		
	$(document).ready(function(){
		$('#t1').focus();
		$('#f1').keyup(
			function(){
				var $texttext = $('#t1').val().toLowerCase();
				var $allrecipes = $('.recipe');
				var $n = $allrecipes.length;
				//$('#monitor').text('recipies: ' + $n + ' ');
                var selector = ".recipe:not(:contains('" + $texttext + "'))";
                
/*
				$('#monitor').append(selector);
				var $k = $n - $(selector).length;
				$('#monitor').append(" " + $k);
*/
				var $k = $n - $(selector).length;
				$('#recipecount').html(" " + $k);
				
				$allrecipes.show();
				$(selector).hide();
				
			}
		);
	});
	</script>
</html>

