/**
*@Description controla efeito flip e a lógica do jogo
*/
var c1 = "";
var c2 = "";
var hits = 0;
var cartas = 0;
var total = 0;
var errors = 0;

function controlFlip(element, color, direction)
{
	 var $this = element;
		$this.flip({
		 direction: direction,
		 color: color,
		 content: $this.attr("title"),
		 onBefore: function(){
			 }
		 });
		
		 return false;
}

function card(element, color)
{
	controlFlip(element, color, 'lr');
	ajaxLoad(element);
}
function save(strName,nPoints,nSeconds,nAttempts)
{
	$.post("/pianogame/player/save", {
		strName: strName,
		nPoints: nPoints,
		nSeconds: nSeconds,
		nAttempts: nAttempts
    }, function(data){
	});
}
function completed(nAttempts)
{
	var nSeconds = $('#tempoSeg').val();
	nPoints = Math.round(100000 * (nAttempts) / nSeconds / nAttempts);
	
	strPlayerName = "Seu Nome";
	strMsg = "Fez " + nPoints + " pontos.\nPor favor digite seu nome para Ranking:";
	strName = prompt(strMsg, strPlayerName);

	if(strName != null && strName != "" && strName != "Seu Nome")
		{
			save(strName,nPoints,nSeconds,nAttempts);
		}
}	
function ajaxLoad(element)
{
	var nAttempts;
	var card = $('.controlFlipbox').index(element);
	$.post("/pianogame/player/carta", {
		card: card
    }, function(data){
    	element.attr('id', 'selected');
    	if(c1 == "")
    	{
    		c1 = element;
    		c1.attr('rel', data);
			c1.html('<img src="../images/imgcard/' + data + '" width="60" height="80" />');
			
    	}
    	else if(c2 == "")
    	{
    		c2 = element;
    		c2.attr('rel', data);
			c2.html('<img src="../images/imgcard/' + data + '" width="60" height="80"/>');
    		
    		if(c1.attr('rel') == c2.attr('rel'))
    		{
    			c1 = '';
    			c2 = '';
    			
    			hits++;
    			
    			if((total / 2) == hits)
    			{
    				$('#victory').fadeIn("slow");
    				verificar = 0;
					nAttempts = (hits+errors);
					completed(nAttempts);
    			}
    			
				$('#hits span').html(hits);
    			cartas = 0;
    		}
    		else
    		{
    			c1.removeAttr('id');
    			c2.removeAttr('id');
    			errors++;
    			$('#errors span').html(errors);
    			
    			setTimeout(function(){
            		error(c1);
            		c1 = '';
            		error(c2);
            		c2 = '';
            		cartas = 0;
    			}, 2000);
    			
    		}
    		
    	}
    			
    });
}

function error(element)
{
	element.attr('rel', '');
	element.html('');
	controlFlip(element, '#00008B', 'rl');
}

function init()
{
	$('.controlFlipbox').click(function()
	{
		if(cartas < 2 && $(this).attr('id') != 'selected')
		{
			card($(this), '#9C9C9C');
			cartas++;
		}
	});
	
	total = $("#memoryGame").find("a").size();
	$("#numCards").change(function () {
        $('#nums').submit();
    });
	
}
$(document).ready(init);