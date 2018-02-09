/*var input = document.getElementById("speed");
input.addEventListener("keyup", function(event) {
    event.preventDefault();
    if (event.keyCode === 13) {
        spazio_frenata();
    }
});*/


//parte spazio di frenata
function spazio_frenata(){
	var st=document.getElementById("street");
	var street=st.options[st.selectedIndex].value;

	var con=document.getElementById("condition");
	var cond=con.options[con.selectedIndex].value;

	var speed=document.getElementById("speed").value;

	var s;
	var c;
	var tot;

	if(street=="buono")
		s=0.8;
	else if(street=="bagnato")
		s=0.4;
	else
		s=0.05;

	if(cond=="normale")
		c=1;
	else if(cond=="over_0.5")
		c=1.5;
	else if(cond=="cellulare")
		c=1.35;
	else if(cond=="bevuto")
		c=1.12;
	else if(cond=="messaggio")
		c=1.91;
	else if(cond=="fumato")
		c=1.21;
	else
		c=1.35;

	tot=c*speed/3.6+((speed/3.6)*(speed/3.6))/(2*9.81*s);
	tot=tot.toFixed(2);
	document.getElementById("risultato_1").innerHTML=
	"Una macchina che corre ai <strong>"+speed+" Km/h</strong> percorrerà <strong>"+tot+" m</strong> circa prima di fermarsi. "+ 
    " Questo se il manto stradale é "+street+" lo stato dell'autista è: "+cond+".";
}

//parte alcol
var tot=0;
var n_nodo=0;
var bevande_array=[];

function scrivi_ris(tot){
	var ris="Livello di alcolemia nel sangue: <strong>"+tot+" grammi/litro.</strong></br>";
	if(tot==0)
		ris=ris+"Non si ha nessuna sensazione particolare e nessuna abilità compromessa.";
	else if(tot>0 && tot<=0.2)
		ris=ris+"Si percepisce un'iniziale sensazione di ebbrezza e una riduzione delle inibizioni e del controllo. "+
		"Si ha un affievolimento della vigilanza, attenzione e controllo. Una riduzione del coordinamento motorio e della visione laterale. Nausea.";
	else if(tot>0.2 && tot<=0.4)
		ris=ris+"Si ha una sensazione di ebbrezza, una riduzione delle inibizioni, del controllo e della percezione del rischio. "+
		"Le abilità subisco una riduzione delle capacità di vigilanza, attenzione e controllo. Una riduzione del coordinamento motorio, dei riflessi e della visione laterale. Vomito.";
	else if(tot>0.4 && tot<=0.8)
		ris=ris+"Si percepiscono cambiamenti d’umore, nausea, sonnolenza e uno stato di eccitazione emotiva. "+
		"Si avrà una riduzione della capacità di giudizio, di individuare gli oggetti in movimento e della visione laterale; nonchè delle capacità di reazione agli stimoli sonorie luminosi.";
	else if(tot>0.8)
		ris=ris+"Il risultato sarà alterazione d'umore, rabbia, tristezza, confusione mentale e disorientamento. "+
		"Si avrà la compromissione della capacità di giudizio e di autocontrollo, si possono avere comportamenti socialmente inadeguati e una compromissione della visione, della percezione di forme ,colori e dimensioni";
	document.getElementById("risultato_3").innerHTML=ris;
}

function aggiungi_bevanda(){
	//var 1
	var gen;
	if(document.getElementById("male").checked)
		gen=document.getElementById("male").value;
	else if(document.getElementById("female").checked)
		gen=document.getElementById("female").value;
	if(gen==undefined){
		alert("Indicare il sesso");
		return;
	}

	//var 2
	var stm;
	if(document.getElementById("full").checked)
		stm=document.getElementById("full").value;
	else if(document.getElementById("empty").checked)
		stm=document.getElementById("empty").value;
	if(stm==undefined){
		alert("Indicare se lo stomaco è pieno o vuoto");
		return;
	}

	//var 3
	var aux=document.querySelector("input[name='weight']:checked");
	if(aux==null){
		alert("Indicare il peso");
		return;
	}
	var weight=aux.value;

	//var 4
	var bev=document.getElementById("bevanda")
	var beva=bev.options[bev.selectedIndex];

	//codice
	var drink={numero:n_nodo, sesso:gen, stomaco:stm, peso:weight, bevanda:beva.value};
	bevande_array.push(drink);
 
 	aggiungi_nodo(drink, beva.innerHTML);
	var aggiunta=grado(drink);
	tot+=aggiunta;
	tot=Number(tot.toFixed(2));
	scrivi_ris(tot);

	n_nodo=n_nodo+1;
}

function grado(drink){
	var aggiunta=0;
	var sesso=drink.sesso;
	var stomaco=drink.stomaco;
	var peso=drink.peso;
	var bevanda=drink.bevanda;
	var table="";
	if(sesso=="uomo"){
		if(stomaco=="pieno")
			table="uomini_s_pieno";
		else
			table="uomini_s_vuoto";
	}
	else{
		if(stomaco=="pieno")
			table="donne_s_pieno";
		else
			table="donne_s_vuoto";
	}

	if (window.XMLHttpRequest)
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
	else
		// code for IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	//deprecato ma non mi interessa
    xmlhttp.open("GET","../php/php-funzioni/alcol.php?t="+table+"&p="+peso+"&b="+bevanda,false);
    xmlhttp.send();
    aggiunta = xmlhttp.responseText;
    aggiunta=Number(aggiunta);
	return aggiunta;
}

function aggiungi_nodo(drink, beva){
	//creo il nodo li della lista
	var node=document.createElement("LI");
	var li_id=document.createAttribute("id");
	li_id.value=drink.numero;
	node.setAttributeNode(li_id);

	//dico cosa ho aggiunto
	var text=document.createElement("P"); 
	var t=document.createTextNode(drink.sesso+" a stomaco "+drink.stomaco+", "+beva); 
	text.appendChild(t);
	node.appendChild(text);

	//a fianco ci metto il bottone per rimuoverla
	var remove=document.createElement("BUTTON");
	var text_button=document.createTextNode("Rimuovi");
	var button_onclick=document.createAttribute("onclick");
	button_onclick.value="rimuovi_bevanda(this.parentNode)";//il bottone rimuoverà la bevanda corrente
	remove.setAttributeNode(button_onclick);
	remove.appendChild(text_button);

	//creo il nodo con il bottone
	node.appendChild(remove);
	document.getElementById("risultato_2").appendChild(node);
}

function rimuovi_bevanda(elem){
	var i=elem.id;
	var index=-1; 
	for(var j=0; j<bevande_array.length && index<0; j++) 
		if(bevande_array[j].numero==i) 
		  index=j; 

	if(index>=0){ 
		tot-=grado(bevande_array[index]);
		tot=Number(tot.toFixed(2));
		scrivi_ris(tot); 
		if(bevande_array.length>0) 
		  bevande_array.splice(index, 1); 
	}

	elem.parentNode.removeChild(elem); 
}