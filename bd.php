<?php

class bd{
	
    private $nomedb;
    private $servidor;
	private $usuario;
	private $senha;
	public $CON;
	
	public function login( $email, $senha ){
		
		$SQL = "Select * from usuarios where email='" . $email . "' and senha='" . md5( $senha ) . "'";
		$RES = $this->CON->query($SQL);
				
		if( $RES->rowCount() <= 0){
			$retorno = "Usuário ou senha incorretos";
		} else {
			
			$row = $RES->fetch(PDO::FETCH_ASSOC);
			
			//Iniciando sessão
			session_start();
			$_SESSION['id_user'] = $row['id'];
			$_SESSION['name_user'] = $row['nome'];
			$_SESSION['email_user'] = $row['email'];
			$_SESSION['matricula_user'] = $row['matricula'];
					
			return true;			
		}
	}
	
	public function logout(){
				
		$_SESSION = array();
		
		if( session_destroy() ){
			return 'logout';
		}		
	}
	
	public function adicionar_professor( $professor ){
		
		$SQL = "Select * from usuarios where email='" . $professor->getEmail() . "' or matricula='" . $professor->getMatricula() . "'";
		$RES = $this->CON->query($SQL);
				
		if( $RES->rowCount() >= 1){
			$retorno = "Email ou matricula já existente";
		} else {
			
			//Inserindo professor no BD
			$SQL = "INSERT INTO usuarios (nome, email, matricula, senha) values ('" . $professor->getNome() . "', '" . $professor->getEmail() . "', '" . $professor->getMatricula() . "', '" . md5( $professor->getSenha() ) . "')";
			$RES = $this->CON->query($SQL);
			
			if(!$RES){
				$retorno = "ERROR" . mysqli_error($this->CON);
			} else {
				$retorno = true;
			}
			
		}
			
		return $retorno;
	}
	
	public function atualizar_professor( $professor ){
		
		$SQL = "UPDATE usuarios set nome='" . $professor->getNome() . "', email='" . $professor->getEmail() . "', matricula='" . $professor->getMatricula() . "', senha='" . $professor->getSenha() . "' where id='" . $professor->getId() . "'";
		$RES = $this->CON->query($SQL);
		
		if(!$RES){
			$retorno = "ERROR" . mysqli_error($this->CON);
		} else {
			$retorno = true;
		}
				
		return $retorno;
		
	}
	
	public function remover_professor( $professor ){
		
		$SQL = "DELETE from usuarios where id='" . $professor->getId() . "'";
		$RES = $this->CON->query($SQL);
		
		if(!$RES){
			$retorno = "ERROR" . mysqli_error($this->CON);
		} else {
			$retorno = true;
		}
				
		return $retorno;
		
	}
	
	public function adicionar_sala( $sala ){
		
		$SQL = "Select * from salas where nome='" . $sala->getNome() . "' or codigo='" . $sala->getCodigo() . "'";
		$RES = $this->CON->query($SQL);
				
		if( $RES->rowCount() >= 1){
			$retorno = "Sala já existente";
		} else {
			
			$SQL = "INSERT INTO salas (nome, codigo) values ('" . $sala->getNome() . "','" . $sala->getCodigo() . "')";
			$RES = $this->CON->query($SQL);
			
			if(!$RES){
				$retorno = "ERROR" . mysqli_error($this->CON);
			} else {
				$retorno = true;
			}
			
		}
		return $retorno;
	}
	
	public function atualizar_sala( $sala ){
		
		$SQL = "UPDATE salas set nome='" . $sala->getNome() . "', codigo='" . $sala->getCodigo(). "' where id='" . $sala->getId() . "'";
		$RES = $this->CON->query($SQL);
		
		if(!$RES){
			$retorno = "ERROR" . mysqli_error($this->CON);
		} else {
			$retorno = true;
		}
				
		return $retorno;
		
	}
	
	public function remover_sala( $sala ){
		
		$SQL = "DELETE from salas where id='" . $sala->getId() . "'";
		$RES = $this->CON->query($SQL);
		
		if(!$RES){
			$retorno = "ERROR" . mysqli_error($this->CON);
		} else {
			$retorno = true;
		}
				
		return $retorno;
		
	}
	
	public function adicionar_horario( $sala, $horario ){
		
		
		$SQL = "Select * from horarios_sala where id_sala='" . $sala->getId() . "' and horario='" . $horario . "'";
		$RES = $this->CON->query($SQL);
				
		if( $RES->rowCount() >= 1){
			$retorno = "Horário já existente para essa sala";
		} else {
			
			$SQL = "INSERT INTO horarios_sala (id_sala, horario) values ('" . $sala->getId() . "','" . $horario . "')";
			$RES = $this->CON->query($SQL);
			
			if(!$RES){
				$retorno = "ERROR" . mysqli_error($this->CON);
			} else {
				$retorno = true;
			}
			
		}
		return $retorno;
	}
	
	public function atualizar_horario( $sala, $horario, $novohorario ){
		
		$SQL = "UPDATE horarios_sala set id_sala='" . $sala->getId() . "', horario='" . $novohorario. "' where id_sala='" . $sala->getId() . "' and horario='" . $horario . "'";
		$RES = $this->CON->query($SQL);
		
		if(!$RES){
			$retorno = "ERROR" . mysqli_error($this->CON);
		} else {
			$retorno = true;
		}
				
		return $retorno;
		
	}
	
	public function remover_horario( $sala, $horario ){
		
		$SQL = "DELETE from horarios_sala where id_sala='" . $sala->getId() . "' and horario='" . $horario . "'";
		$RES = $this->CON->query($SQL);
		
		if(!$RES){
			$retorno = "ERROR" . mysqli_error($this->CON);
		} else {
			$retorno = true;
		}
				
		return $retorno;
		
	}
	
	public function adicionar_reserva( $professor, $id_horario ){
		
		
		$SQL = "Select * from reservas where id_usuario='" . $professor->getId() . "' and id_horario='" . $id_horario . "'";
		$RES = $this->CON->query($SQL);
				
		if( $RES->rowCount() >= 1){
			$retorno = "Reserva indisponível";
		} else {
			
			$SQL = "INSERT INTO reservas (id_usuario, id_horario) values ('" . $professor->getId() . "','" . $id_horario . "')";
			$RES = $this->CON->query($SQL);
			
			if(!$RES){
				$retorno = "ERROR" . mysqli_error($this->CON);
			} else {
				$retorno = true;
			}
			
		}
		return $retorno;
	}
	
	public function remover_reserva( $id_reserva, $professor ){
		
		$SQL = "DELETE from reservas where id='" . $id_reserva . "' and id_usuario='" . $professor->getId() . "'";
		$RES = $this->CON->query($SQL);
		
		if(!$RES){
			$retorno = "ERROR" . mysqli_error($this->CON);
		} else {
			$retorno = true;
		}
				
		return $retorno;
		
	}
	
	public function getHorarios( $id, $tipo ){
		
		switch( $tipo ){
			case 'professor':
				
				$SQL = "Select reservas.*, horarios_sala.horario, salas.nome, salas.codigo from reservas inner join horarios_sala on reservas.id_horario=horarios_sala.id inner join salas on horarios_sala.id_sala=salas.id where reservas.id_usuario='" . $id . "'";
				$RES = $this->CON->query($SQL);
				
				$i=0;
				while( $row = $RES->fetch(PDO::FETCH_ASSOC)){
					$retorno[$i]['id'] = $row['id'];
					$retorno[$i]['id_usuario'] = $row['id_usuario'];
					$retorno[$i]['id_horario'] = $row['id_horario'];
					$retorno[$i]['horario'] = $row['horario'];
					$retorno[$i]['nome'] = $row['nome'];
					$retorno[$i]['codigo'] = $row['codigo'];
					
					$i++;
				}
			break;
			case 'sala':
				$SQL = "select * from horarios_sala where id_sala='" . $id . "'";
				$RES = $this->CON->query($SQL);
				
				$i=0;
				while( $row = $RES->fetch(PDO::FETCH_ASSOC)){
					$retorno[$i]['id'] = $row['id'];
					$retorno[$i]['id_sala'] = $row['id_sala'];
					$retorno[$i]['horario'] = $row['horario'];
					
					$i++;
				}
			break;
		}
					
		return $retorno;
	}

	
	// Método construtor da classe.
	function __construct($nomedb, $servidor, $usuario, $senha) {
		$this->nomedb = $nomedb;
		$this->servidor = $servidor;
		$this->usuario = $usuario;
		$this->senha = $senha;
				
		try {
			// Iniciando conexao com banco de dados.
			$this->CON = new PDO("mysql:host=" . $servidor . ";dbname=" . $nomedb, $usuario, $senha);
			$this->CON->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					
		} catch ( PDOException $e ) {
			 echo 'ERROR: ' . $e->getMessage();
		}
	}	
}   

?>