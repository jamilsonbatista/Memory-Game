<h1><?php echo $this->pageTitle = "Piano Memory Game" ?></h1>
<?

echo $html->stylesheet("pianogame.css");
echo $html->stylesheet("colorbox.css");
echo $html->script(array("jquery-ui-1.7.2.custom.min","jquery.flip","time","controlEffectFlip","jquery.colorbox"), array(),true,true);

?>
<script type="text/javascript">
	$(document).ready(function(){	
		$(".rankig").colorbox({width:"80%", height:"80%", iframe:true});
		$("#click").click(function(){ 
			$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
			return false;
		});
	});
</script>
	

 <div id="innerContent">
	 <div id="innertop">
		<div id="ranking">
			<a class='rankig' href="/pianogame/player/ranking"><img id="rankig" src="../images/ranking.png" alt="ranking"/></a>
		</div>
	 </div>
	 <div id="menu">
		<p id="hits">Hits: <span>0</span></p>
		<p id="errors">Errors: <span>0</span></p>
		<p id="time">Time: <span>00:00:00</span></p>
		<input id="tempoSeg" type="hidden" value=""></input>
	</div>
	 <div id="innerGame">
		<div id="victory">
		</div>
		<form id="nums" action="" method="post">
			<select id="numCards" name="numCards"><option value="">Select a Level</option>
				<?
					$cont = 1;
					for ($i=6; $i<=80; $i=$i+2)
					{
						echo "<option value='$i'>"."Level".($cont++)."</option>";
					}?>
			</select>
				<input type="hidden" id="post" value="<?= $_POST["numCards"]?>" />
		</form>
		<div id="cardGame">
			<div id="card_top"></div>
				<div id="cardInnerGame">
        			<div id="memoryGame">
					<?
						echo $listCartas;
					?>
				     </div>
        		</div>
			<div id="card_footer"></div>
        </div>
	</div>
</div>


<?

/** Awesome Facebook Application
* Name: MemoryGame
* @Autor Jamilson Batista
* @Description código criado para evoluçã da maquina social para jogos utilizando o facebook como plataforma
* @Version 0.1 - Atualmente está configurado para criar o game dentro do facebook, e buscar o id dos usuários. Falta as implementações de token e ranking dentro da rede.
*/

require_once 'lib/utils/facebook-php-sdk/src/facebook.php';

// Create our Application instance.
$facebook = new Facebook(array(
  'appId' => '',//Your ID
  'secret' => '',//Your secret key
  'cookie' => true,
));

$user = $facebook->getUser();

if ($user) {
  try {
    $user_profile = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}

if ($user) {
	$logoutUrl = $facebook->getLogoutUrl();
} else {
	$loginUrl = $facebook->getLoginUrl();
}
?>
<div id="face">
	<a href="<?php echo $loginUrl; ?>">Login with Facebook</a>
</div>