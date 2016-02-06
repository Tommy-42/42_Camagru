document.addEventListener('DOMContentLoaded', function(){ 

	// when submit button is hit
	if( document.getElementsByClassName("btn-reset-password").length == 1 ) {
		document.getElementsByClassName("btn-reset-password")[0]
				.addEventListener("click", function(event) {
			
			// stop sending form
			event.preventDefault();

			// get informations
			var email = document.getElementsByClassName("email-input")[0].value;
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
	}


	// when submit button is hit
	if( document.getElementsByClassName("btn-change-password").length == 1 ) {
		document.getElementsByClassName("btn-change-password")[0]
				.addEventListener("click", function(event) {
			
			// stop sending form
			event.preventDefault();

			// get informations
			var password = document.getElementsByClassName("password-input")[0].value;
			var confirm = document.getElementsByClassName("confirm-input")[0].value;
			var token = getUrlParam('t');
			if( token == false ) return;
			var send =	'change_password=1&' +
						'&password='+ encodeURIComponent(password) +
						'&confirm='+ encodeURIComponent(confirm) +
						'&token='+ encodeURIComponent(token);

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
							.innerHTML = "<h1>Mot de passe bien changé</h1>";
						window.setTimeout(function() {
							location.href = "?p=connexion";
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
	}

	function getUrlParam(val) {
		var result = false, tmp = [];
		var items = location.search.substr(1).split("&");
		for (var index = 0; index < items.length; index++) {
			tmp = items[index].split("=");
			if (tmp[0] === val) result = decodeURIComponent(tmp[1]);
		}
		return result;
	}
}, false);