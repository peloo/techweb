function dropdown(){
	/*vresione più lenta
	var nav=document.querySelector("#breadcrumb .nav");
	nav.style.display="block";
	var Height=nav.offsetHeight;
	nav.style.height="0px";	
	var h=0;
	var intval=setInterval(function(){
		h++;
		nav.style.height=h+"px";
		if(h>=Height)
			window.clearInterval(intval);
	}, 1);*/
	document.getElementById("hamburger").style.display="none";
	document.getElementById("cross").style.display="block";
	document.querySelector("#breadcrumb .nav").style.display="block";
}

function dropup(){
	document.getElementById("cross").style.display="none";
	document.getElementById("hamburger").style.display="block";
	document.querySelector("#breadcrumb .nav").style.display="none";
}

function reset(){
	if(document.getElementById("hamburger").style.display=="block"){
		location.reload();
	}
}