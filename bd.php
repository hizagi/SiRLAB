<?php
header('Content-Type: text/html; charset=utf-8');

include "sala.php";
include "professor.php";

class bd
{

    private $nomedb;
    private $servidor;
    private $usuario;
    private $senha;
    public $CON;
    public $resposta = array();

    public function login( $email, $senha )
    {

        $SQL = "Select * from usuarios where email='" . $email . "' and senha='" . md5($senha) . "'";
        $RES = $this->CON->query($SQL);

        if($RES->rowCount() <= 0) {
            $resposta['status']="error";
            return $resposta;
        } else {

            $row = $RES->fetch(PDO::FETCH_ASSOC);

            //Iniciando sessão
            session_start();
            $_SESSION['id_user'] = $row['id'];
            $_SESSION['name_user'] = $row['nome'];
            $_SESSION['email_user'] = $row['email'];
            $_SESSION['matricula_user'] = $row['matricula'];
            $_SESSION['tipo_user'] = $row['tipo'];
            $resposta['status']="ok";
            return $resposta;
        }
    }

    public function logout()
    {

        $_SESSION = array();

        if (session_destroy() && session_unset()) {
            return 'logout';
        }
    }

    public function adicionar_professor( $professor )
    {

        $SQL = "Select * from usuarios where email='" . $professor->getEmail() . "' or matricula='" . $professor->getMatricula() . "'";
        $RES = $this->CON->query($SQL);

        if($RES->rowCount() >= 1) {
            $resposta['status'] = "Email ou matricula já existente";
        } else {

            //Inserindo professor no BD
            $SQL = "INSERT INTO usuarios (nome, email, matricula, senha) values ('" . $professor->getNome() . "', '" . $professor->getEmail() . "', '" . $professor->getMatricula() . "', '" . md5($professor->getSenha()) . "')";
            $RES = $this->CON->query($SQL);

            if(!$RES) {
                $resposta['status'] = "ERROR" . mysqli_error($this->CON);
            } else {
                $resposta['status'] = true;
            }

        }

        return $resposta;
    }

    public function listar_professores($sala)
    {
      if(isset($sala)){

        $SQL = "SELECT DISTINCT u.id id_usuario,u.nome nome,r.id id_reserva,h.id id_horario,horario_inicio,horario_fim FROM usuarios u
        JOIN reservas r on u.id = r.id_usuario
        JOIN horarios_sala h on h.id = r.id_horario
        JOIN salas s on s.id = h.id_sala
        where tipo = 1 and s.id=?
        GROUP BY id_usuario
        ";
        $sqlarray = array($sala->getId());
      }else {
        $SQL = "SELECT * FROM u usuarios where tipo = 1";
        $sqlarray = array();
      }
      $RES = $this->CON->prepare($SQL);
      $RES->execute($sqlarray);

      if(!$RES) {
          $resposta['status'] = "ERROR" . mysqli_error($this->CON);
      } else {
          $resposta['status'] = true;
          $resposta['data'] = $sala = $RES->fetchAll(PDO::FETCH_ASSOC);
      }

      return $resposta;
    }

    public function atualizar_professor( $professor )
    {

        $SQL = "UPDATE usuarios set nome='" . $professor->getNome() . "', email='" . $professor->getEmail() . "', matricula='" . $professor->getMatricula() . "', senha='" . $professor->getSenha() . "' where id='" . $professor->getId() . "'";
        $RES = $this->CON->query($SQL);

        if(!$RES) {
            $resposta['status'] = "ERROR" . mysqli_error($this->CON);
        } else {
            $resposta['status'] = true;
        }

        return $resposta;

    }

    public function remover_professor( $professor )
    {

        $SQL = "DELETE from usuarios where id='" . $professor->getId() . "'";
        $RES = $this->CON->query($SQL);

        if(!$RES) {
            $resposta['status'] = "ERROR" . mysqli_error($this->CON);
        } else {
            $resposta['status'] = true;
        }

        return $resposta;

    }

    public function listar_salas()
    {
        $SQL = "Select * from salas";
        $RES = $this->CON->query($SQL);

        $salas = array();

        while ($sala = $RES->fetch(PDO::FETCH_ASSOC)) {
            $salas[] = new sala($sala['id'],$sala['nome'],$sala['codigo']);
        }

        $resposta['data'] = $salas;

        return $resposta;

    }

    public function adicionar_sala( $sala )
    {

        $SQL = "Select * from salas where nome='" . $sala->getNome() . "' or codigo='" . $sala->getCodigo() . "'";
        $RES = $this->CON->query($SQL);

        if($RES->rowCount() >= 1) {
            $resposta['status'] = "Sala já existente";
        } else {

            $SQL = "INSERT INTO salas (nome, codigo) values ('" . $sala->getNome() . "','" . $sala->getCodigo() . "')";
            $RES = $this->CON->query($SQL);

            if(!$RES) {
                $resposta['status'] = "ERROR" . mysqli_error($this->CON);
            } else {
                $sala->setId($this->CON->lastInsertId());
                $resposta['data']['id'] = $sala->getId();
                $resposta['data']['nome'] = $sala->getNome();
                $resposta['data']['codigo'] = $sala->getCodigo();
                $resposta['status'] = "OK";
            }

        }
        return $resposta;
    }

    public function atualizar_sala( $sala )
    {

        $SQL = "UPDATE salas set nome='" . $sala->getNome() . "', codigo='" . $sala->getCodigo(). "' where id='" . $sala->getId() . "'";
        $RES = $this->CON->query($SQL);

        if(!$RES) {
            $resposta['status'] = "ERROR" . mysqli_error($this->CON);
        } else {
            $resposta['status'] = true;
        }

        return $resposta;

    }

    public function remover_sala( $sala )
    {

        $SQL = "DELETE from salas where id='" . $sala->getId() . "'";
        $RES = $this->CON->query($SQL);

        if(!$RES) {
            $resposta['status'] = "ERROR" . mysqli_error($this->CON);
        } else {
            $resposta['status'] = 'OK';
        }

        return $resposta;

    }

    public function adicionar_horario( $sala, $horario )
    {

        $SQL = "Select * from horarios_sala where id_sala=? and dia=? and (  (horario_inicio =? and horario_fim = ?) or (  (horario_fim >? and horario_fim <?) or (horario_inicio >? and horario_inicio <?) ) )";

        $RES = $this->CON->prepare($SQL);
        $sqlarray = array($sala->getId(),$horario['dia_lab'],$horario['hora_inicial_lab'],$horario['hora_final_lab'],$horario['hora_inicial_lab'],$horario['hora_final_lab'],$horario['hora_inicial_lab'],$horario['hora_final_lab']);

        $RES->execute($sqlarray);

        if($RES->rowCount() >= 1) {
            $resposta['status'] = "Horário já existente para essa sala";
        } else {

            $SQL = "INSERT INTO horarios_sala (id_sala, horario_inicio, horario_fim, dia) values ('" . $sala->getId() . "','" . $horario['hora_inicial_lab'] . "','" .$horario['hora_final_lab']. "','" .$horario['dia_lab']."')";
            $RES = $this->CON->query($SQL);

            if(!$RES) {
                $resposta['status'] = "ERROR" . mysqli_error($this->CON);
            } else {
                $horario['id'] = $this->CON->lastInsertId();
                $resposta['data'] = $horario;
                $resposta['status'] = "OK";
            }

        }
        return $resposta;
    }

    public function listar_horarios($id,$dia)
    {
      $SQL = "Select * from horarios_sala where id_sala=? and dia=? ORDER BY horario_inicio";

      $RES = $this->CON->prepare($SQL);
      $sqlarray = array($id,$dia);

      $RES->execute($sqlarray);

      $horarios = $RES->FetchAll(PDO::FETCH_ASSOC);

      return $horarios;
    }

    public function atualizar_horario( $sala, $horario, $novohorario )
    {

        $SQL = "UPDATE horarios_sala set id_sala='" . $sala->getId() . "', horario='" . $novohorario. "' where id_sala='" . $sala->getId() . "' and horario='" . $horario . "'";
        $RES = $this->CON->query($SQL);

        if(!$RES) {
            $resposta['status'] = "ERROR" . mysqli_error($this->CON);
        } else {
            $resposta['status'] = true;
        }

        return $resposta;

    }

    public function remover_horario( $sala, $horario )
    {

        $SQL = "DELETE from horarios_sala where id_sala='" . $sala->getId() . "' and id='" . $horario . "';
        DELETE from reservas where id_horario='" . $horario . "'
        ";
        $RES = $this->CON->query($SQL);

        if(!$RES) {
            $resposta['status'] = "ERROR" . mysqli_error($this->CON);
        } else {
            $resposta['status'] = "OK";
        }

        return $resposta;

    }

    public function listar_reservas($professor)
    {
      $SQL = "select reservas.id,salas.nome,salas.codigo,salas.id id_sala,horarios_sala.horario_inicio,horarios_sala.horario_fim,reservas.data from reservas
              join horarios_sala on reservas.id_horario=horarios_sala.id
              join salas on salas.id=horarios_sala.id_sala
              where reservas.id_usuario=?
              order by reservas.data, horarios_sala.horario_inicio asc";

      $RES = $this->CON->prepare($SQL);
      $sqlarray = array($professor->getId());

      try {
        $RES->execute($sqlarray);
      } catch (Exception $e) {
        $resposta['status'] = "ERROR ".$e->getMessage();
      }
      //var_dump($RES->fetchAll(PDO::FETCH_ASSOC));
      $resposta['data'] = $RES->fetchAll(PDO::FETCH_ASSOC);

      foreach ($resposta['data'] as $key => &$reserva) {
        $reserva['data'] = date( "d-m-Y", strtotime($reserva['data']) );
      }

      $resposta['status'] = "OK";

      return $resposta;
    }

    public function adicionar_reserva( $professor, $id_horario, $data)
    {

            $data = date( "Y-m-d", strtotime($data) );

            $SQL = "INSERT INTO reservas (id_usuario, id_horario, data) values ('" . $professor->getId() . "','" . $id_horario . "','" . $data . "')";
            $RES = $this->CON->query($SQL);

            if(!$RES) {
                $resposta['status'] = "ERROR" . mysqli_error($this->CON);
            } else {
                $SQL = "select reservas.id,salas.nome,salas.codigo,horarios_sala.horario_inicio,horarios_sala.horario_fim,reservas.data from reservas
                        join horarios_sala on reservas.id_horario=horarios_sala.id
                        join salas on salas.id=horarios_sala.id_sala
                        where reservas.id=?
                        order by reservas.data, horarios_sala.horario_inicio";

                $RES = $this->CON->prepare($SQL);

                $sqlarray = array($this->CON->lastInsertId());

                try {
                  $RES->execute($sqlarray);
                } catch (Exception $e) {
                  $resposta['status'] = "ERROR ".$e->getMessage();
                }

                $resposta['data'] = $RES->fetchAll(PDO::FETCH_ASSOC);
                //var_dump($resposta['data']);
                $resposta['data'][0]['data'] = date( "d-m-Y", strtotime($resposta['data'][0]['data']) );
                $resposta['status'] = "OK";

            }


        return $resposta;
    }

    public function remover_reserva( $id_reserva, $professor )
    {

        $SQL = "DELETE from reservas where id='" . $id_reserva . "' and id_usuario='" . $professor->getId() . "'";
        $RES = $this->CON->query($SQL);

        if(!$RES) {
            $resposta['status'] = "ERROR" . mysqli_error($this->CON);
        } else {
            $resposta['data'] = $id_reserva;
            $resposta['status'] = "OK";
        }

        return $resposta;

    }

    public function getHorarios( $id, $tipo, $dia_semana, $data)
    {
        $data = date( "Y-m-d", strtotime($data) );
        switch( $tipo ){
        case 'professor':

            $SQL = "Select reservas.*, horarios_sala.horario, salas.nome, salas.codigo from reservas inner join horarios_sala on reservas.id_horario=horarios_sala.id inner join salas on horarios_sala.id_sala=salas.id where reservas.id_usuario='" . $id . "' and dia='".$dia_semana."'";
            $RES = $this->CON->query($SQL);

            if(!$RES) {
                $resposta['status'] = "ERROR" . mysqli_error($this->CON);
            }

            $i=0;
            while( $row = $RES->fetch(PDO::FETCH_ASSOC)){
                $resposta['data'][$i]['id'] = $row['id'];
                $resposta['data'][$i]['id_usuario'] = $row['id_usuario'];
                $resposta['data'][$i]['id_horario'] = $row['id_horario'];
                $resposta['data'][$i]['horario'] = $row['horario'];
                $resposta['data'][$i]['nome'] = $row['nome'];
                $resposta['data'][$i]['codigo'] = $row['codigo'];
                $i++;
            }
            $resposta['status'] = "OK";
            break;
        case 'sala':
            $SQL = "select horarios_sala.id,id_sala,horario_inicio,horario_fim,dia from horarios_sala
            LEFT JOIN reservas on horarios_sala.id=reservas.id_horario and reservas.data=?
            where horarios_sala.id_sala=? and horarios_sala.dia=? and reservas.id_horario is null";

            $RES = $this->CON->prepare($SQL);
            $sqlarray = array($data,$id,$dia_semana);


            try {
              $RES->execute($sqlarray);
            } catch (Exception $e) {
              $resposta['status'] = "ERROR ".$e->getMessage();
            }




                $i=0;
                while( $row = $RES->fetch(PDO::FETCH_ASSOC)){
                    $resposta['data'][$i]['id'] = $row['id'];
                    $resposta['data'][$i]['id_sala'] = $row['id_sala'];
                    $resposta['data'][$i]['horario_inicio'] = $row['horario_inicio'];
                    $resposta['data'][$i]['horario_fim'] = $row['horario_fim'];
                    $resposta['data'][$i]['dia'] = $row['dia'];
                    $i++;
                }
                $resposta['status'] = "OK";

            break;
        }

        return $resposta;
    }


    // Método construtor da classe.
    function __construct($nomedb, $servidor, $usuario, $senha)
    {
        $this->nomedb = $nomedb;
        $this->servidor = $servidor;
        $this->usuario = $usuario;
        $this->senha = $senha;

        try {
            // Iniciando conexao com banco de dados.
            $this->CON = new PDO("mysql:host=" . $servidor . ";dbname=" . $nomedb, $usuario, $senha, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $this->CON->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch ( PDOException $e ) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }
}

?>
