<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8" />
	 <title>Calculadora cientifica Casio modelo chris</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="calcula.css"/>
</head>

<body>
	<h1>Calculadora cientifica Casio modelo Anthony</h1>
	<?php
	class CalculadoraBasica
	{
		public $consola;
		private $memoria;

		public function __construct()
		{
			$this->consola = "";
			$this->memoria = 0;
		}
		public function getmemoria()
		{
			return $this->memoria;
		}
		public function getconsola()
		{
			return $this->consola;
		}

		public function annadirCampoConsola($value)
		{
			if ($this->getconsola() === "NaN" | $this->getconsola() === "Syntax Error" | $this->getconsola() === "Infinity") {
				$this->consola = "";
			}
			$this->consola .= $value;
		}

		public function calcular()
		{
			try {
				$this->consola = eval("return $this->consola ;");
			} catch (Exception $e) {
				$this->consola = "Syntax Error";
			}
		}

		//funcion exponente
		public function exponente()
		{
			$this->memoria = $this->getmemoria() ** eval("return $this->consola;");	
		}

		public function Madd()
		{
			$this->memoria = $this->getmemoria() + eval("return $this->consola ;");
		}

		public function Msubs()
		{
			$this->memoria = $this->getmemoria() - eval("return $this->consola ;");
		}

		//funcion borrar
		public function erase()
		{
			$this->consola = "";
		}
	};

	class CalculadoraCientifica extends CalculadoraBasica
	{
		//funcion raiz cuadrada
		public function root()
		{
			$this->consola = sqrt(floatval($this->consola));
		}

		//funcion logaritmo
		public function log()
		{
			$this->consola = log(floatval($this->consola));
		}

		//funcion seno
		public function sin()
		{
			$this->consola = sin(floatval($this->consola));
		}

		//funcion coseno
		public function cosin()
		{
			$this->consola = cos(floatval($this->consola));
		}

		//funcion inversa
		public function inverso()
		{
			$toInv = floatVal($this->consola);
			$inv = 1;
			$value=	 $inv / $toInv;
			$this->consola = $value;
		}

		//funcion factorial
		public function fact()
		{
			$toFact = floatVal($this->consola);
			$fact = 1;
			for ($i = 1; $i <= $toFact; $i++)
				$fact *= $i;
			$this->consola = $fact;
		}
	};

	//el if para determinar el input del usuario
	if (!isset($_SESSION['calculadoraC']))
		$_SESSION['calculadoraC'] = new CalculadoraCientifica();
	$calculadora = $_SESSION['calculadoraC'];

	if (count($_POST) > 0) {
		if (isset($_POST['root']))
			$calculadora->root();
		elseif (isset($_POST['cuadrado']))
			$calculadora->annadirCampoConsola("**2");
		elseif (isset($_POST['pi']))
			$calculadora->annadirCampoConsola(M_PI);
		elseif (isset($_POST['fact']))
			$calculadora->fact();
		elseif (isset($_POST['sin']))
			$calculadora->sin();
		elseif (isset($_POST['cos']))
			$calculadora->cosin();
		elseif (isset($_POST['inv']))
			$calculadora->inverso();
		elseif (isset($_POST['log']))
			$calculadora->log();
		elseif (isset($_POST['mrc']))
		$calculadora->annadirCampoConsola("**");
		elseif (isset($_POST['m-']))
			$calculadora->Msubs();
		elseif (isset($_POST['m+']))
			$calculadora->Madd();
		elseif (isset($_POST['0']))
			$calculadora->annadirCampoConsola("0");
		elseif (isset($_POST['1']))
			$calculadora->annadirCampoConsola("1");
		elseif (isset($_POST['2']))
			$calculadora->annadirCampoConsola("2");
		elseif (isset($_POST['3']))
			$calculadora->annadirCampoConsola("3");
		elseif (isset($_POST['4']))
			$calculadora->annadirCampoConsola("4");
		elseif (isset($_POST['5']))
			$calculadora->annadirCampoConsola("5");
		elseif (isset($_POST['6']))
			$calculadora->annadirCampoConsola("6");
		elseif (isset($_POST['7']))
			$calculadora->annadirCampoConsola("7");
		elseif (isset($_POST['8']))
			$calculadora->annadirCampoConsola("8");
		elseif (isset($_POST['9']))
			$calculadora->annadirCampoConsola("9");
		elseif (isset($_POST['/']))
			$calculadora->annadirCampoConsola("/");
		else if (isset($_POST['*']))
			$calculadora->annadirCampoConsola("*");
		elseif (isset($_POST['+']))
			$calculadora->annadirCampoConsola("+");
		elseif (isset($_POST['-']))
			$calculadora->annadirCampoConsola("-");
		elseif (isset($_POST['C']))
			$calculadora->erase();
		elseif (isset($_POST[',']))
			$calculadora->annadirCampoConsola(".");
		elseif (isset($_POST['=']))
			$calculadora->calcular();
	};
//la parte visual, lo que aparece en cada boton e instanciamos lo que aparece en la pantalla
	echo "<form action='CalculadoraCientifica.php' method='post' name='Calculadora'>
				<textarea disabled>$calculadora->consola</textarea>
				<button type='submit' name='root' >√</button>
				<button type='submit' name='cuadrado' >x^2</button>
				<button type='submit' name='pi' >π</button>
				<button type='submit' name='fact' >n!</button>
				<button type='submit' name='sin' >sin</button>
				<button type='submit' name='cos' >cos</button>
				<button type='submit' name='inv' >x/1</button>
				<button type='submit' name='log' >log</button>
				<button type='submit' name='mrc' >x^y</button>
				<button type='submit' name='m-' >m-</button>
				<button type='submit' name='m+' >m+</button>
				<button type='submit'name='/' >/</button>
				<button type='submit' name='7' >7</button>
				<button type='submit' name='8' >8</button>
				<button type='submit' name='9' >9</button>
				<button type='submit' name='*' >x</button>
				<button type='submit' name='4' >4</button>
				<button type='submit' name='5' >5</button>
				<button type='submit' name='6' >6</button>
				<button type='submit' name='-' >-</button>
				<button type='submit'name='1' >1</button>
				<button type='submit' name='2' >2</button>
				<button type='submit' name='3' >3</button>
				<button type='submit' name='+' >+</button>
				<button type='submit' name='0' >0</button>
				<button type='submit' name=',' >.</button>
				<button type='submit' name='C' >C</button>
				<button type='submit' name='=' >=</button>
			</form>";
	?>
</body>

</html>