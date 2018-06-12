<div id="hamburger_menu">
	<button id="hamburger" onclick="dropdown()">&#9776;</button>
	<button id="cross" onclick="dropup()">&#735;</button>
</div>

<form id="search_bar" method="get" action="articoli.php?p=0">
	<input id="text_search" type="text" name="search" placeholder="cerca"/>
	<input type="submit" name="submit" id="button_search" value="Cerca"/>
	<input type="hidden" name="p" value="0"/>
</form>