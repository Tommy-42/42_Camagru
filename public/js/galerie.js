document.addEventListener('DOMContentLoaded', function(){ 

});
function imgInfo(el) {

	resetModal();

	var modal = document.getElementById('modal').childNodes[3];
	var img = modal.childNodes[1];
	var likes = modal.childNodes[3];
	var comments = modal.childNodes[5];

	var img_id = el.getAttribute('data-id');
	console.log( el );
	var send = 'get_info_img=1&img_id=' + img_id;

	// create AJAX ressources
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			var result = JSON.parse(xhttp.responseText);
			if( result.hasOwnProperty('success' ) ) {
				var data = result.success;
				console.log(img);
				img.src = 'private/galerie/' + data['infos']['name'] + '.png';
			}
			else {
				// console.log( xhttp.responseText );
			}
		}
	};
	xhttp.open("POST", "api/galerie.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send(send);


	showModal();
}
function showModal() {
	document.getElementById('modal').style.display = 'block';
	document.body.innerHTML = '<div class="modal-is-on"></div>' +
		document.body.innerHTML;
}
function resetModal() {

	var modal = document.getElementById('modal').childNodes[3];
	var img = modal.childNodes[1];
	var likes = modal.childNodes[3];
	var comments = modal.childNodes[5];

	img.src = '';
	likes.innerHTML = '';
	comments.innerHTML = '';
}
function hideModal() {
	document.getElementById('modal').style.display = 'none';
	if( typeof(document.getElementsByClassName('modal-is-on')[0]) !== 'undefined' )
		document.getElementsByClassName('modal-is-on')[0].remove();

	var modal = document.getElementById('modal').childNodes[3];
	var img = modal.childNodes[1];
	var likes = modal.childNodes[3];
	var comments = modal.childNodes[5];

	img.src = '';
	likes.innerHTML = '';
	comments.innerHTML = '';
} 
function pageLeft(el) {
	
	var c_el = el.parentNode;
	var cp_el = el.parentNode.previousSibling;
	var p_el = el.parentNode.previousSibling.previousSibling;
	var pp_el = el.parentNode.previousSibling.previousSibling.previousSibling;

	if( typeof(p_el.classList) !== 'undefined' ) {
		if( pp_el.classList.contains('page-container') ) { 
			c_el.style.display = 'none';
			cp_el.style.display = 'none';
			p_el.style.display = 'block';
			pp_el.style.display = 'block';
		}
	}
}
function pageRight(el) {

	var c_el = el.parentNode;
	var cp_el = el.parentNode.previousSibling;
	var p_el = el.parentNode.nextSibling;
	var pp_el = el.parentNode.nextSibling.nextSibling;

	if( typeof(p_el.classList) !== 'undefined' ) {
		if( p_el.classList.contains('page-container') ) { 
			c_el.style.display = 'none';
			cp_el.style.display = 'none';
			p_el.style.display = 'block';
			pp_el.style.display = 'block';
		}
	}
}