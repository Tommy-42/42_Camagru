function imgInfo(el) {

	resetModal();

	var modal = document.getElementById('modal-box');
	var img = document.getElementById('modal-preview-img');
	var like_number = document.getElementById('like-number');
	var comments = document.getElementById('comments');

	var img_id = el.getAttribute('data-id');
	console.log( el );
	var send = 'get_info_img=1&img_id=' + img_id;

	// create AJAX ressources
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			var result = JSON.parse(xhttp.responseText);
			console.log(result);
			if( result.hasOwnProperty('success' ) ) {
				// <script>console.log('toto');</script>
				var data = result.success;
				img.src = 'private/galerie/' + data['infos']['name'] + '.png';
				img.setAttribute('data-id', data['infos']['id']);
				like_number.innerHTML = data['likes']['total'];
				if( document.getElementById('like-img-btn') !== null ) {
					if( data['likes']['is_liked'] != 0 ) {
						document.getElementById('like-img-btn').classList.remove('like-icon');
						document.getElementById('like-img-btn').classList.add('liked-icon');
					}
					else {
						document.getElementById('like-img-btn').classList.remove('liked-icon');
						document.getElementById('like-img-btn').classList.add('like-icon');
					}
				}
				var html = '';
				for ( var i = 0; i < data['comments'].length; i++ ) {
					html += '<div class="com-box col-12 no-padding-at-all">' +
							'<p>\'\'' +
								data['comments'][i]['comment'] +
								'\'\'<br><small class="com-username text-right">' +
									data['comments'][i]['username'] +
								'</small>' +
							'</p>' +
						'</div>';
				};
				comments.innerHTML = html;
			}
			else {
				// console.log( xhttp.responseText );
			}
		}
	};
	xhttp.open("POST", "api/galerie.php", false);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send(send);


	showModal();
}
function likeImg() {

	var img_id = document.getElementById('modal-preview-img').getAttribute('data-id');
	var send = 'post_like=1&img_id=' + img_id;
	console.log(img_id);
	// create AJAX ressources
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			var result = JSON.parse(xhttp.responseText);
			console.log(result);
			if( result == 'success' ) {
				if( document.getElementById('like-img-btn').classList.contains('like-icon') ) {
					document.getElementById('like-img-btn').classList.remove('like-icon');
					document.getElementById('like-img-btn').classList.add('liked-icon');
					document.getElementById('like-number')
						.innerHTML = parseInt(document.getElementById('like-number').innerHTML) + 1;
				}
				else {
					document.getElementById('like-img-btn').classList.remove('liked-icon');
					document.getElementById('like-img-btn').classList.add('like-icon');
					document.getElementById('like-number')
						.innerHTML = parseInt(document.getElementById('like-number').innerHTML) - 1;
				}
			}
			else {
				// console.log( xhttp.responseText );
			}
		}
	};
	xhttp.open("POST", "api/galerie.php", false);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send(send);
}
function commentImg(el) {

    var key = event.which || event.keyCode;
    if (key === 13) { // 13 is enter
		var comment = el.value;
		if( comment.length > 140 ) {
			alert('Msg trop long, 140 caracteres maximum');
			return;
		}
		else {

			var img_id = document.getElementById('modal-preview-img').getAttribute('data-id');
			var send = 'post_comment=1&img_id=' + img_id + '&comment=' + encodeURIComponent(comment);
			// create AJAX ressources
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (xhttp.readyState == 4 && xhttp.status == 200) {
					var result = JSON.parse(xhttp.responseText);
					if( result == 'success' ) {
						el.value = '';
						var comments = document.getElementById('comments');
						comments.innerHTML = reloadComments() || '';
					}
					else {
						
					}
				}
			};
			xhttp.open("POST", "api/galerie.php", false);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send(send);
		}
    }
}
function reloadComments() {

	var modal = document.getElementById('modal-box');
	var img = document.getElementById('modal-preview-img');
	var comments = document.getElementById('comments');

	var img_id = img.getAttribute('data-id');
	var send = 'get_comments=1&img_id=' + img_id;

	// create AJAX ressources
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "api/galerie.php", false);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send(send);
	var result = JSON.parse(xhttp.responseText);
	if( result.hasOwnProperty('success' ) ) {
		var data = result.success;
		var html = '';
		for ( var i = 0; i < data['comments'].length; i++ ) {
			html += '<div class="com-box col-12 no-padding-at-all">' +
					'<p>\'\'' +
						data['comments'][i]['comment'] +
						'\'\'<br><small class="com-username text-right">' +
							data['comments'][i]['username'] +
						'</small>' +
					'</p>' +
				'</div>';
		};
		return(html);
	}
	else {
		return false;
	}
}
function showModal() {
	document.getElementById('modal').style.display = 'block';
	document.body.innerHTML = '<div id="modal-is-on"></div>' +
		document.body.innerHTML;
}
function resetModal() {

	var modal = document.getElementById('modal-box');
	var img = document.getElementById('modal-preview-img');
	var comments = document.getElementById('comments');

	img.src = '';
	//comments.innerHTML = '';
	if( document.getElementById('like-img-btn') !== null ) {
		document.getElementById('like-img-btn').classList.remove('liked-icon');
		document.getElementById('like-img-btn').classList.add('like-icon');
	}
}
function hideModal() {
	document.getElementById('modal').style.display = 'none';
	if( typeof(document.getElementById('modal-is-on')) !== 'undefined' )
		document.getElementById('modal-is-on').remove();

	var modal = document.getElementById('modal-box');
	var img = document.getElementById('modal-preview-img');
	var comments = document.getElementById('comments');

	img.src = '';
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