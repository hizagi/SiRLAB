<?php

class Professor{
    private $id;
    private $nome;
	private $email;
	private $matricula;
	private $bd;
	
	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getNome(){
		return $this->nome;
	}

	public function setNome($nome){
		$this->nome = $nome;
	}

	public function getEmail(){
		return $this->email;
	}

	public function setEmail($email){
		$this->email = $email;
	}

	public function getMatricula(){
		return $this->matricula;
	}

	public function setMatricula($matricula){
		$this->matricula = $matricula;
	}
	
	public function getSenha(){
		return $this->senha;
	}

	public function setSenha($senha){
		$this->senha = $senha;
	}
	
	// Método construtor da classe.
	function __construct($id, $nome, $email, $matricula, $senha) {
		$this->id = $id;
		$this->nome = $nome;
		$this->email = $email;
		$this->matricula = $matricula;
		$this->senha = $senha;
	}	
}   

?>