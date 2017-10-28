<?php

class Sala{
    private $id;
    private $nome;
	private $codigo;
	
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


	public function getCodigo(){
		return $this->codigo;
	}

	public function setCodigo($codigo){
		$this->codigo = $codigo;
	}
	
	// Método construtor da classe.
	function __construct($id, $nome, $codigo) {
		$this->id = $id;
		$this->nome = $nome;
		$this->codigo = $codigo;
	
	} 
}	
	  

?>