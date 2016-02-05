document.addEventListener('DOMContentLoaded', function(){ 

	// when submit button is hit
	document.getElementsByClassName("btn-connexion")[0]
			.addEventListener("click", function(event) {
		
		// stop sending form
		event.preventDefault();

		// get information
		var email = document.getElementsByClassName("email-input")[0].value
		var password = document.getElementsByClassName("password-input")[0].value

		var send = 'connexion=1&' +
			'&email='+ encodeURIComponent(email) +
			'&password='+ encodeURIComponent(password);

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
						.innerHTML = "<h1>Connexion Validé</h1>";
					window.setTimeout(function() {
						location.href = "?p=index";
					}, 1000);

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