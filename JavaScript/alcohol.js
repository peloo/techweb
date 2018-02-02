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
	"La strada che la macchina percorrerà prima di fermarsi è di: "+tot+" m circa.";
}

//parte alcol
var tot=0;
var n_nodo=0;
var bevande_array=[];

function scrivi_ris(tot){
	var ris="Livello di alcolemia nel sangue: "+tot+" grammi/litro. ";
	if(tot==0)
		ris=ris+"Non si ha nessuna sensazione particolare e nessuna abilità compromessa.";
	else if(tot>0 || tot<=0.2)
		ris=ris+"Si percepisce un iniziale sensazione di ebbrezza e una riduzione delle inibizioni e del controllo. "+
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
		gen="uomo";
	else if(document.getElementById("female").checked)
		gen="donna";
	if(gen==null){
		alert("Indicare il sesso");
		return;
	}

	//var 2
	var stm;
	if(document.getElementById("full").checked)
		stm="pieno";
	else if(document.getElementById("empty").checked)
		stm="vuoto";
	if(stm==null){
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

	var drink={numero:n_nodo, sesso:gen, stomaco:stm, peso:weight, bevanda:beva.value};
	bevande_array.push(drink);

	aggiungi_nodo(beva.innerHTML);
	tot=tot+grado(drink);
	scrivi_ris(tot);

	n_nodo=n_nodo+1;
}

function grado(drink){
	var aggiunta=0;
	//interroga il database per aggiornare il campo tot

	return aggiunta;
}

function aggiungi_nodo(bev){
	//creo il nodo li della lista
	var node=document.createElement("LI");
	var li_id=document.createAttribute("id");
	li_id.value=n_nodo;
	node.setAttributeNode(li_id);
	node.style.margin="0.2em 0 0.2em 0";

	//dico cosa ho aggiunto
	var text=document.createTextNode(bev);
	node.appendChild(text);

	//a fianco ci metto il bottone per rimuoverla
	var remove=document.createElement("BUTTON");
	var text_button=document.createTextNode("Rimuovi");
	var button_onclick=document.createAttribute("onclick");
	button_onclick.value="rimuovi_bevanda(this.parentNode)";//il bottone rimuoverà la bevanda corrente
	remove.setAttributeNode(button_onclick);
	remove.appendChild(text_button);
	remove.style.margin="0 0 0 1em";

	//creo il nodo con il bottone
	node.appendChild(remove);
	document.getElementById("risultato_2").appendChild(node);
}

function rimuovi_bevanda(elem){
	elem.parentNode.removeChild(elem);
	var i=elem.id;
	tot=tot-grado(bevande_array[i]);
	if(bevande_array.length>0)
		delete bevande_array[i];
}