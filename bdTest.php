<?php
	include("/wamp64/www/composer/src/Application/professor.php");
	include("/wamp64/www/composer/src/Application/sala.php");
	
  require_once ('/wamp64/www/composer/vendor/phpunit/phpunit/tests/Framework/TestCaseTest.php');
  use PHPUnit_Framework_TestCase as PHPUnit;
   
  require_once '../../src/Application/bd.php';
   
  class bdTest extends PHPUnit{
                  
			  //Função de teste de tipo - Compara tipo da variável Código
			  public function testLogin() {
					 		 $bd = new bd("basesirlab", "localhost", "root", "");
							 $this->assertInternalType('boolean', $bd->login('lucasamaral@gmail.com','arielsoarescosta'));
				}
				
				/*public function testLogout() {
					 		 $bd = new bd("basesirlab", "localhost", "root", "");
							 $this->assertInternalType('boolean', $bd->logout());
				}*/
			  
			   public function testAdicionar_professor() {
							 $bd = new bd("basesirlab", "localhost", "root", "");
							 
					 		 $professor = new professor(0, "Lucas Amaral", "lucasamaral@gmail.com1", 2012111049, 'arielsoarescosta');
							 $this->assertInternalType('string', $bd->adicionar_professor($professor));
							 
							 $professor = new professor(0, "Lucas Amaral", "laucasamaral2@gmail.com1", 123123123, 'arielsoarescosta');
							 $this->assertInternalType('string', $bd->adicionar_professor($professor));
							 
							 $professor = new professor(0, "Maísa", "maisa@gmail.com", 23123, 'arielsoarescosta');
							 //$this->assertInternalType('boolean', $bd->adicionar_professor($professor));
				}
				
				public function testAtualizar_professor() {
							 $bd = new bd("basesirlab", "localhost", "root", "");
							 
					 		 $professor = new professor(50, "Catia", "catia@gmail.com1", 2012111049, 'arielsoarescosta');
							 $this->assertInternalType('string', $bd->atualizar_professor($professor));
							 							 
							 $professor = new professor(28, "Maísa", "maisa@gmail.com", 23123, 'arielsoarescosta');
							// $this->assertInternalType('boolean', $bd->atualizar_professor($professor));
				}
				
				public function testRemover_professor() {
							 $bd = new bd("basesirlab", "localhost", "root", "");
							 
					 		 $professor = new professor(50, "Catia", "catia@gmail.com1", 2012111049, 'arielsoarescosta');
							 $this->assertInternalType('string', $bd->remover_professor($professor));
							 							 
							 $professor = new professor(28, "Maísa", "maisa@gmail.com", 23123, 'arielsoarescosta');
							// $this->assertInternalType('boolean', $bd->remover_professor($professor));
				}
				
				 public function testAdicionar_sala() {
							 $bd = new bd("basesirlab", "localhost", "root", "");
							 
					 		 $sala = new sala ( '12', 'Lab EAD', '10' );
							 $this->assertInternalType('string', $bd->adicionar_sala($sala));
							 							 
							 $sala = new sala ( '21', 'sala', '30' );
					    	// $this->assertInternalType('boolean', $bd->adicionar_sala($sala));
				}
				
				public function testAtualizar_sala() {
							$bd = new bd("basesirlab", "localhost", "root", "");
							
							//testando quando atualiza 
					 		$sala = new sala ( '12', 'Lab', '10' );
						//	$this->assertInternalType('boolean', $bd->atualizar_sala($sala));					 
							
							//testando quando não atualiza
							$sala = new sala ( '2', 'L', '120' );
							$this->assertInternalType('string', $bd->atualizar_sala($sala));
				}
				
				public function testRemover_Sala() {
							$bd = new bd("basesirlab", "localhost", "root", "");
							 
							//testando quando remove
					 		$sala = new sala( '12', 'Lab', '10' );
						//	$this->assertInternalType('boolean', $bd->remover_sala($sala));
							
							//testando quando não remove		
							$sala = new sala( '12', 'Lab', '10' );
							$this->assertInternalType('string', $bd->remover_sala($sala));
				}
				
				
				 public function testAdicionar_horario() {
							 $bd = new bd("basesirlab", "localhost", "root", "");
							 
							 //adicionando horario novo
					 		 $sala = new sala ( '12', 'Lab', '10' );
							// $this->assertInternalType('boolean', $bd->adicionar_horario($sala, '22:00-23:00'));
							 		
							//tentando adicionar um horario ja existente
							$sala = new sala ( '14', 'sala', '30' );
					    	$this->assertInternalType('string', $bd->adicionar_horario($sala, '22:00-23:00'));
				}
				
				public function testAtualizar_horario() {
							$bd = new bd("basesirlab", "localhost", "root", "");
							
							//testando quando atualiza 
					 		$sala = new sala ( '12', 'Lab', '10' );
						    //$this->assertInternalType('boolean', $bd->atualizar_horario($sala,'16:30-17:00', '16:00-17:00'));					 
							
							//testando quando não atualiza
							$sala = new sala ( '12', 'Lab', '10' );
							$this->assertInternalType('string', $bd->atualizar_horario($sala,'12:22-13:00', '20:00-21:00'));
				}
				
				public function testRemover_horario() {
							$bd = new bd("basesirlab", "localhost", "root", "");
							 
							//testando quando remove
					 		$sala = new sala( '12', 'Lab', '10' );
						//	$this->assertInternalType('boolean', $bd->remover_horario($sala, '16:00-17:00'));
							
							//testando quando não remove		
							$sala = new sala( '12', 'Lab', '10' );
							$this->assertInternalType('string', $bd->remover_horario($sala, '16:00-17:00'));
							
				}
				
				public function testAdicionar_reserva() {
							$bd = new bd("basesirlab", "localhost", "root", "");
							
							//adicionando nova reserva
							$professor = new professor(0, "Lucas Amaral", "lucasamaral@gmail.com", 201211049, 'arielsoarescosta');
							//$this->assertInternalType('boolean', $bd->adicionar_reserva($professor,'5'));
							
							//reserva ja existente
							$professor = new professor(0, "Lucas Amaral", "lucasamaral@gmail.com", 201211049, 'arielsoarescosta');
							$this->assertInternalType('string', $bd->adicionar_reserva($professor,'5'));
				
				}
				public function testRemover_reserva() {
							$bd = new bd("basesirlab", "localhost", "root", "");
							
							//removendo reserva existente
							$professor = new professor(0, "Lucas Amaral", "lucasamaral@gmail.com", 201211049, 'arielsoarescosta');
							//$this->assertInternalType('boolean', $bd->remover_reserva( '5' , $professor ));
							
							//reserva inexistente
							$professor = new professor(0, "Lucas Amaral", "lucasamaral@gmail.com", 201211049, 'arielsoarescosta');
							$this->assertInternalType('string', $bd->remover_reserva('5' , $professor));
				
				}
				public function testGetHorarios(){
							$bd = new bd("basesirlab", "localhost", "root", "");
							
							$professor = new professor ( 0 , "Lucas", "lucas@gmail.com", 22223222, '123456'); 
							$sala = new sala ( '11', 'Laboratório de redes', '15' );
							
							$this->assertInternalType('array', $bd->getHorarios( $professor -> getId() , 'professor'));
							$this->assertInternalType('array', $bd->getHorarios( $sala -> getId() , 'sala'));
							
							
				}
  }
  ?> 