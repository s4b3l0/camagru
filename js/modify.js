//link for reference :https://www.w3schools.com/howto/howto_js_draggable.asp



document.getElementById('ol1').addEventListener('click', function() {
	var ol = this.id;
	renderSticker(ol);
	var btnImg1=  document.getElementById(ol);
	this.style.border = 'thin dotted red';
}, false);

document.getElementById('ol2').addEventListener('click', function() {
	var ol = this.id;
	renderSticker(ol);
	var btnImg1=  document.getElementById(ol);
	this.style.border = 'thin dotted red';
}, false);
document.getElementById('ol3').addEventListener('click', function() {
	var ol = this.id;
	renderSticker(ol);
	var btnImg1=  document.getElementById(ol);
	this.style.border = 'thin dotted red';
}, false);
document.getElementById('ol4').addEventListener('click', function() {
	var ol = this.id;
	renderSticker(ol);
	var btnImg1=  document.getElementById(ol);
	this.style.border = 'thin dotted red';
}, false);
document.getElementById('ol5').addEventListener('click', function() {
	var ol = this.id;
	renderSticker(ol);
	var btnImg1=  document.getElementById(ol);
	this.style.border = 'thin dotted red';
}, false);




function renderSticker(elmnt){
	var canvas = document.getElementById('canvas'),
		context = canvas.getContext('2d'),
		sticker1 = document.getElementById(elmnt),
		photo = document.getElementById('img2'),
		pic = document.getElementById('pic');

	context.drawImage(sticker1, 0, 0, 400, 200);
	photo.setAttribute('src', canvas.toDataURL('image/png'));

	document.getElementById('mydiv').setAttribute('src', canvas.toDataURL('image/png'));
	
	context.clearRect(0, 0, canvas.width, canvas.height);

			
		context.drawImage(pic, 0, 0, 400, 300);
		context.drawImage(mydiv, 0, 0,400, 450);

		pic.setAttribute('src', canvas.toDataURL('pic/png'));
		document.getElementById('fdata').setAttribute('value', canvas.toDataURL('pic/png'));
		context.clearRect(0, 0, canvas.width, canvas.height);
		document.getElementById('mydiv').setAttribute('src', "");
	};
/* Code for dragging my pic
//make the Div element draggable:
dragElement(document.getElementById('mydiv'));

function dragElement(elmnt){
	var pos1 = 0, pos2 = 0,pos3 = 0,pos4 = 0;
	//if present, the header is where you move the DIV from:
	if(document.getElementById(elmnt.id + "header")){
		document.getElementById(elmnt.id + "header").onmousedown = dragMouseDown;
	}else {
		//otherwize, move the DIV from anywhere inside
		elmnt.onmousedown = dragMouseDown;
	}
	function dragMouseDown(e){
		e =e || window.event;
		e.preventDefault();
		// get the mouse cursor position at staetup:
		pos3 = e.clientX;
		pos4 = e.clientY;
		document.onmouseup = closeDragElement;
		// call a function whenever the cursore moves
		document.onmousemove = elementDrag;
	}

	function elementDrag(e) {
		e = e || window.event;
		e.preventDefault();
		//calculate the new cursor position:
		pos1 = pos3 - e.clientX;
		pos2 = pos4 - e.clientY;
   		pos3 = e.clientX;
    	pos4 = e.clientY;
    	// set the element's new position
    	elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
    	elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
	}

	function closeDragElement() 
	{
		//stop moving when mouse is released:
		document.onmouseup = null;
		document.onmousemove = null;
	}


}*/
