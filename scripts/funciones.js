
function obtenerFecha(){
	var d = new Date();
	var n = d.toString();
	var today = new Date().toISOString().slice(0, 19);
	today = today.split("T",2);
	// fecha
	fecha = today[0].split("-",3);
	today[1] = d.toTimeString();
	hora = today[1].slice(0,8);
	hora = hora.split(":",3);

	var stringDate='';
	fecha.forEach(function(entry) {
		stringDate += entry;
	});

	hora.forEach(function(entry){
		stringDate += entry;
	});
	return stringDate;
}
