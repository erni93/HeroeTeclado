ENGINE.List = function(args) {
	var datos = $.ajax({
        type: "GET",
        url: "obtenernotas.php",
        data: {action:"notas"},
        cache: false,
        async: false
    }).responseText;
    var notas = JSON.parse(datos.trim());
    console.log("notas: " + notas.length);
	_.extend(this, {
		song: notas,
		bar: 0,
		lastBarUsed: 0,
	}, args)
}

ENGINE.List.prototype = {

	barUsed: function(args) {
		this.lastBarUsed = args;
	},

	nextBar: function() {
		this.bar += 1;
	},

	getNotes: function(bar) {
		if(bar <= this.song.length) {
			return this.song[bar]
		}
	},

	reset: function() {
		this.lastBarUsed = 0;
		this.bar = 0;
	}
}