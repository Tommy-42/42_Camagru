document.addEventListener('DOMContentLoaded', function(){ 

	// when submit button is hit
	document.getElementsByClassName("btn-reset-password")[0]
			.addEventListener("click", function(event) {
		
		// stop sending form
		event.preventDefault();

		// get informations
		var email = document.getElementsByClassName("email-input")[0].value
		var send = 'reset_password=1&' + '&email='+ encodeURIComponent(email);

		// create AJAX ressources
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {

			document.getElementsByClassName("p-error")[0].innerHTML = '';
			document.getElementsByClassName("p-success")[0].innerHTML = '';

			if (xhttp.readyState == 4 && xhttp.status == 200) {
				var result = JSON.parse(xhttp.responseText);
				console.log(result);
				if( result == 'success' ) {
					document.getElementsByClassName("p-success")[0]
						.innerHTML = "<h1>Email Envoyé</h1>";
					window.setTimeout(function() {
						location.href = "?p=index";
					}, 2000);

				}
				else {
					if( Array.isArray(result) ) {
						for(i=0; i < result.length; i++) {
							document.getElementsByClassName("p-error")[0]
								.innerHTML += result[i] + "<br>";
						}
					}
					else {
						document.getElementsByClassName("p-error")[0]
								.innerHTML += result + "<br>";
					}
				}
			}
		};
		xhttp.open("POST", "api/crud.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send(send);
	});
	
}, false);