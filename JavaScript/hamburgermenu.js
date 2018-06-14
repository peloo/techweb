function dropdown(){
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