document.addEventListener('DOMContentLoaded', function(){ 
	(function() {
	    // The width and height of the captured photo. We will set the
	    // width to the value defined here, but the height will be
	    // calculated based on the aspect ratio of the input stream.

	    var width = 320; // We will scale the photo width to this
	    var height = 0; // This will be computed based on the input stream

	    // |streaming| indicates whether or not we're currently streaming
	    // video from the camera. Obviously, we start at false.

	    var streaming = false;

	    // The various HTML elements we need to configure or control. These
	    // will be set by the startup() function.

	    var video = null;
	    var canvas = null;
	    var photo = null;
	    var user_pic = null;
	    var startbutton = null;

	    function startup() {
	        video = document.getElementById('video');
	        canvas = document.getElementById('canvas');
	        photo = document.getElementById('photo');
	        user_pic = document.getElementById('userPic');
	        startbutton = document.getElementById('startbutton');

	        navigator.getMedia = (navigator.getUserMedia ||
	            navigator.webkitGetUserMedia ||
	            navigator.mozGetUserMedia ||
	            navigator.msGetUserMedia);

	        navigator.getMedia({
	                video: true,
	                audio: false
	            },
	            function(stream) {
	                if (navigator.mozGetUserMedia) {
	                    video.mozSrcObject = stream;
	                } else {
	                    var vendorURL = window.URL || window.webkitURL;
	                    video.src = vendorURL.createObjectURL(stream);
	                }
	                video.play();
	            },
	            function(err) {
	                console.log("An error occured! " + err);
	            }
	        );

	        video.addEventListener('canplay', function(ev) {
	            if (!streaming) {
	                height = video.videoHeight / (video.videoWidth / width);

	                // Firefox currently has a bug where the height can't be read from
	                // the video, so we will make assumptions if this happens.

	                if (isNaN(height)) {
	                    height = width / (4 / 3);
	                }

	                video.setAttribute('width', width);
	                video.setAttribute('height', height);
	                canvas.setAttribute('width', width);
	                canvas.setAttribute('height', height);
	                streaming = true;
	            }
	        }, false);

	        startbutton.addEventListener('click', function(ev) {
	            takepicture();
	            ev.preventDefault();
	        }, false);

	        clearphoto();
	    }

	    // Fill the photo with an indication that none has been
	    // captured.

	    function clearphoto() {
	        var context = canvas.getContext('2d');
	        context.fillStyle = "#AAA";
	        context.fillRect(0, 0, canvas.width, canvas.height);

	        var data = canvas.toDataURL('image/png');
	        photo.setAttribute('src', data);
	        user_pic.setAttribute('src', data);
	    }

	    // Capture a photo by fetching the current contents of the video
	    // and drawing it into a canvas, then converting that to a PNG
	    // format data URL. By drawing it on an offscreen canvas and then
	    // drawing that to the screen, we can change its size and/or apply
	    // other changes before drawing it.

	    function takepicture() {
	        var context = canvas.getContext('2d');
	        if (width && height) {
	            canvas.width = width;
	            canvas.height = height;
	            
	            context.translate(width, 0);
  				context.scale(-1, 1);

	            context.drawImage(video, 0, 0, width, height);

	            var user_data = canvas.toDataURL('image/png');
	            user_pic.setAttribute('src', user_data);

	            /* preview  rendu */
				var img = document.getElementsByClassName("render-filter")[0].firstElementChild;
				var filter= document.createElement("img");
				filter.setAttribute('src', img.src);
				filter.style.width = img.getAttribute("data-width");

				context.translate(width, 0);
  				context.scale(-1, 1);

	            context.drawImage(filter, 0, 0, img.width, img.height);

	            var data = canvas.toDataURL('image/png');
	            photo.setAttribute('src', data);

				document.getElementById("photo").style.display = "inline";
				document.getElementById("saveButton").style.display = "inline";
				if( document.getElementById("saveButton").classList.contains('disabled') )
					document.getElementById("saveButton").classList.remove("disabled");
	        } else {
	            clearphoto();
	        }
	    }

	    // Set up our event listener to run the startup process
	    // once loading is complete.
	    window.addEventListener('load', startup, false);
	})();

	document.getElementById("saveButton").addEventListener("click", function(event) {

		if( this.classList.contains('disabled') ) {
			event.preventDefault();
			event.stopPropagation();
			return;
		}
		// get informations
		var user_pic = document.getElementById("userPic").src;
		var img = document.getElementsByClassName("render-filter")[0].firstElementChild;
		var filter = img.src;
		var send = 'save_img=1&user_pic=' + user_pic +
			'&filter=' + filter;

		// create AJAX ressources
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			// document.getElementsByClassName("p-error")[0].innerHTML = '';
			// document.getElementsByClassName("p-success")[0].innerHTML = '';
			if (xhttp.readyState == 4 && xhttp.status == 200) {
				var result = JSON.parse(xhttp.responseText);
				
				if( result.hasOwnProperty('success' ) ) {
					console.log(document.getElementById("recap").childNodes);
					if( document.getElementById("recap").childNodes.length == 7 )
						document.getElementById("recap").lastElementChild.remove();
					document.getElementById("recap")
						.innerHTML = '<div class="col-12"><img class="recap-img" src='+ result.success + '></div>' +
						document.getElementById("recap").innerHTML;
					;
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
		xhttp.open("POST", "api/montage.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send(send);
		document.getElementById("saveButton").classList.add("disabled");
	});


}, false);

function chooseFilter(el) {

	var render_filter = document.getElementsByClassName("render-filter")[0];

	var filter= document.createElement("img");
	filter.setAttribute('src', el.src);
	filter.style.width = el.getAttribute("data-width");

	document.getElementsByClassName("render-filter")[0].innerHTML = "";
	document.getElementsByClassName("render-filter")[0]
		.appendChild(filter);

	document.getElementById("startbutton").style.display = "block";
};