<?
/**
*@Author Jamilson Batista
*@Description class responsável pelo tratamento de requisições
*/
class PlayerController extends AppController{
		
		/**
		*@Description inicia a sessão
		*/
		public function beforeFilter()
		{
			Session::start();
		}
		public function index(){
			Controller::redirect("player/game");
		}
		/**
		*@Description método responsável pela construção do ambiente do jogo
		*@Return lista de cartas
		*/
		public function game()
		{
			if(!empty($this->data)){
				$cartas = "";
				 $cartas .= "<ul>";
					for ($i=1; $i<=$this->data["numCards"]; $i++)
						{
							$cartas .= "<li><a rel='' class='controlFlipbox' alt='Carta (".$i.")'></a></li>";
						}
					$cartas .= "</ul>";
				$this->set("listCartas", $cartas);				
			}
			
			if(!empty($this->data["numCards"]))
			{
				$arrayCartas[$this->data["numCards"]];			
				for ($i=0; $i<($this->data["numCards"]/2); $i++)
					{
						$arrayCartas[$i] = ($i+1).".jpg";
					}
					$arrayCartas;
					shuffle($arrayCartas);
					$arrayCartas2 = $arrayCartas;
					$arrayCartas = array_merge($arrayCartas, $arrayCartas2);
					$this->set("passageCards",$arrayCartas);
					Session::write("arrayCard", $arrayCartas);
			}
			$this->data["numCards"] = null;
			
		}
		/**
		*@Description método responsável pela busca de cartas
		*@Return a imagem da carta selecionada
		*/
		public function carta()
		{
			if($this->isXhr())
			{
				$this->layout = false;
			}
			$arrayData = Session::read("arrayCard");
			
			$this->set("img", $arrayData[$this->data["card"]]);
		}
		
		/**
		*@Description método responsável por salvar os dados da partida
		*@Return a imagem da carta selecionada
		*/
		public function save()
		{
			if($this->isXhr())
			{
				$this->layout = false;
			}
			$this->Player->save(array(
					"name_player" => $this->data["strName"],
					"score" => $this->data["nPoints"],
					"time" => $this->data["nSeconds"],
					"attempts" => $this->data["nAttempts"],
				));
		}
		public function isXhr()
		{
			return array_key_exists('HTTP_X_REQUESTED_WITH', $_SERVER) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
		}
		/**
		*@Description método responsável pela busca do ranking
		*@Return o ranking dos jogadores
		*/
		public function ranking()
		{
			$options = array(
			"order" => "score DESC"
				);
			$this->set("ranking", $this->Player->All($options));
		}
}
?>