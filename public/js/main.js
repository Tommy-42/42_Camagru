document.addEventListener('DOMContentLoaded', function(){ 

	// when submit button is hit
	if( document.getElementsByClassName("btn-logout").length == 1 ) {
		document.getElementsByClassName("btn-logout")[0]
				.addEventListener("click", function(event) {
			
			// stop sending form
			event.preventDefault();

			// postValue
			var send = 'logout=1';

			// create AJAX ressources
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (xhttp.readyState == 4 && xhttp.status == 200) {
					var result = JSON.parse(xhttp.responseText);
					console.log(result);
					location.href = "?p=connexion";
				}
			};
			xhttp.open("POST", "api/logout.php", true);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send(send);
		});
	}
}, false);