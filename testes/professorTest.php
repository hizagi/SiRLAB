<?php
  use PHPUnit_Framework_TestCase as PHPUnit;

  require_once '../professor.php';

  class professorTest extends PHPUnit{

			  //Função de teste de tipo - Compara tipo da variável Matricula
			  public function testType() {
					 		 $professor = new professor("", "Lucas Amaral", "lucasamaral@gmail.com", 201211049, 'arielsoarescosta');
							 $this->assertInternalType('int', $professor->getMatricula());
			  }
				//Função de teste de tipo - Compara tipo da variável Senha
			  public function testSenha() {
					 		 $professor = new professor(0, "Lucas Amaral", "lucasamaral@gmail.com", 201211049, 'arielsoarescosta');
							 $this->assertInternalType('string', $professor->getSenha());
			  }
			  //Função de teste de tipo - Compara tipo da variável Email
			  public function testEmail() {
					 		 $professor = new professor(0, "Lucas Amaral", "lucasamaral@gmail.com", 201211049, 'arielsoarescosta');
							 $this->assertInternalType('string', $professor->getEmail());
							 }
			  //Função de teste de tipo - Compara tipo da variável Nome
			  public function testNome() {
					 		 $professor = new professor(0, "Lucas Amaral", "lucasamaral@gmail.com", 201211049, 'arielsoarescosta');
							 $this->assertInternalType('string', $professor->getNome());
							 }

			  //Função de teste de tipo - Compara tipo da variável Id
			  public function testId() {
					 		 $professor = new professor(0, "Lucas Amaral", "lucasamaral@gmail.com", 201211049, 'arielsoarescosta');
							 $this->assertInternalType('int', $professor->getId());
							 }


			  //Função de teste de igualdade - Compara variável Matricula
			  public function testType1() {
					 		 $professor = new professor("", "Lucas Amaral", "lucasamaral@gmail.com", 201211049, 'arielsoarescosta');
							 $this->assertEquals(201211049, $professor->getMatricula());
			  }

			  //Função de teste de igualdade - Compara variável Senha
			  public function testSenha1() {
					 		 $professor = new professor(0, "Lucas Amaral", "lucasamaral@gmail.com", 201211049, 'arielsoarescosta');
							 $this->assertEquals('arielsoarescosta', $professor->getSenha());
			  }

			  //Função de teste de igualdade - Compara variável Email
			  public function testEmail1() {
					 		 $professor = new professor(0, "Lucas Amaral", "lucasamaral@gmail.com", 201211049, 'arielsoarescosta');
							 $this->assertEquals('lucasamaral@gmail.com', $professor->getEmail());
							 }

			  //Função de teste de igualdade - Compara variável Nome
			  public function testNome1() {
					 		 $professor = new professor(0, "Lucas Amaral", "lucasamaral@gmail.com", 201211049, 'arielsoarescosta');
							 $this->assertEquals('Lucas Amaral', $professor->getNome());
							 }

			  //Função de teste de igualdade - Compara variável Id
			  public function testId1() {
					 		 $professor = new professor(0, "Lucas Amaral", "lucasamaral@gmail.com", 201211049, 'arielsoarescosta');
							 $this->assertEquals(0, $professor->getId());
							 }
  }
  ?>
