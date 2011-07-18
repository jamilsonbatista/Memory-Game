var verificar = 1;
var Seg = 00;
var Hora = 00;
var Min = 00;
var Intervalo = 1000;
var TempoInicial = 0;
var Segaux = 00;

function Relogio()
{
	var HoraActual;
	
	
	if (Seg == 60) {
		Seg = 0;
		Min = Min + 1;
	}
	
	if (Min == 60) {
		Min = 0;
		Hora = Hora + 1;
	}
		(Hora < 10) ? HoraActual = "0" + Hora + ":" : HoraActual = Hora + ":";
		(Min < 10) ? HoraActual += "0" + Min + ":" : HoraActual += Min + ":";
		(Seg < 10) ? HoraActual += "0" + Seg : HoraActual += Seg;
		Seg = Seg + 1;
		Segaux = Segaux + 1;
		$('#time span').html(HoraActual);
		
		$('#tempoSeg').val(Segaux);
		
		if(verificar == 1)
		{
			setTimeout("Relogio()", Intervalo);
		}
}

function init()
{
	var verifica = $('#post').val();
	
	if(verifica != "")
	{
		Relogio();
	}
}

$(document).ready(init);