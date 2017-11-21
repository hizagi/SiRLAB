<?php
  use PHPUnit_Framework_TestCase as PHPUnit;

  require_once '../sala.php';

  class salaTest extends PHPUnit{

			  //Função de teste de tipo - Compara tipo da variável Código
			  public function testType() {
					 		 $sala = new sala(0, "Lucas Amaral", 201211049);
							 $this->assertInternalType('int', $sala->getCodigo());
			  }
				//Função de teste de tipo - Compara tipo da variável Nome
			  public function testSenha() {
					 		 $sala = new sala(0, "Lucas Amaral", 201211049);
							 $this->assertInternalType('string', $sala->getNome());
			  }
			  //Função de teste de tipo - Compara tipo da variável Email
			  public function testEmail() {
					 		 $sala = new sala(0, "Lucas Amaral", 201211049);
							 $this->assertInternalType('int', $sala->getId());
							 }


	  //Função de teste de tipo - Compara tipo da variável Código
			  public function testType1() {
					 		 $sala = new sala(0, "Lucas Amaral", 201211049);
							 $this->assertEquals(201211049, $sala->getCodigo());
			  }
				//Função de teste de tipo - Compara tipo da variável Nome
			  public function testSenha1() {
					 		 $sala = new sala(0, "Lucas Amaral", 201211049);
							 $this->assertEquals('Lucas Amaral', $sala->getNome());
			  }
			  //Função de teste de tipo - Compara tipo da variável Email
			  public function testEmail1() {
					 		 $sala = new sala(0, "Lucas Amaral", 201211049);
							 $this->assertEquals(0, $sala->getId());
							 }

  }
  ?>
