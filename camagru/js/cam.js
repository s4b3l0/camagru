(function(){
	//access video element to apply source
var btn_usecam = document.getElementById("btn_usecam");
document.getElementById("video").style.display = 'none';
btn_usecam.style.display = 'none';
document.getElementById('stack').style.display = 'none';
document.getElementById("btn_capture").style.display = 'none';
document.getElementById("btn_cancel").style.display = 'none';
document.getElementById("btn_use").style.display = 'none';

function hidcam() 
{
	document.getElementById("video").style.display = 'none';
	document.getElementById("btn_usecam")
	document.getElementById('stack').style.display = 'none';
	document.getElementById("btn_capture").style.display = 'none';
	document.getElementById("btn_cancel").style.display = 'none';
	document.getElementById("btn_use").style.display = 'none';
	document.getElementById("frmUpload").style.display = '';
};

function parsepath()
{
	var canvas = document.getElementById('canvas');
	document.getElementById('inpic').setAttribute('value', canvas.toDataURL('image/png'));
	document.getElementById('p_caption').style.display = '';
	document.getElementById('inp_image').style.display = 'none';
	document.getElementById('or').style.display = 'none';
	hidcam();
}

btn_usecam.addEventListener('click', function() {
	var     video = document.getElementById("video"),
			canvas = document.getElementById('canvas'),
			context = canvas.getContext('2d'),
			photo = document.getElementById('photo'),
			btn_capture = document.getElementById("btn_capture"),
			btn_cancel =  document.getElementById("btn_cancel"),
			vendorUrl = window.URL || window.webkitUrl;// generate source  
	navigator.getMedia  =   navigator.getUserMedia ||
							navigator.webkitGetUserMedia ||
							navigator.mozGetUserMedia ||
							navigator.msGetUserMedia;
	btn_usecam.style.display = 'none';
	const mediaSource = new MediaSource();
	navigator.getMedia({
		video:true,
		audio:false
	}, function(mediaSource){
		try{
			video.srcObject = mediaSource
		}catch  (error)
		{
			 video.src = vendorURL.createObjectURL(mediaSource);
		}
		video.style.display = '';
		btn_cancel.style.display = '';
		btn_capture.style.display = '';
		video.play();
	}, function(error) {
		hidcam();
		alert("Please enable camera");
	});
	document.getElementById("btn_capture").addEventListener('click', function(){
		context.drawImage(video, 0, 0, 400, 300);
		photo.setAttribute('src', canvas.toDataURL('image/png'));
		document.getElementById('stack').style.backgroundImage='image/png';
		document.getElementById('stack').style.display = '';
		document.getElementById("btn_use").style.display = '';
	});
	btn_cancel.addEventListener('click', hidcam);
	document.getElementById("btn_use").addEventListener('click', parsepath);
});

document.getElementById('btntake').addEventListener('click', function(){
	document.getElementById("frmUpload").style.display = 'none';
	document.getElementById("btn_usecam").style.display = '';
});
})();
