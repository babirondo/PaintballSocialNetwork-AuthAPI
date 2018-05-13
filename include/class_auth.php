<?php
namespace raiz;

error_reporting(E_ALL  );

class Auth{
    function __construct( ){
        require("include/class_db.php");
        $this->con = new db();
        $this->con->conecta();
        set_time_limit(10);
    }

    function NovoUsuario(  $response, $jsonRAW){

        if (!$this->con->conectado){
            $data =   array(	"resultado" =>  "ERRO",
                "erro" => "nao conectado - ".$this->con->erro );
            return $response->withStatus(500)
                ->withHeader('Content-type', 'application/json;charset=utf-8')
                ->withJson($data);
        }

        IF (!is_array( $jsonRAW) ) {
            $data =  array(	"resultado" =>  "ERRO",
                "erro" => "JSON zuado - ".var_export($jsonRAW, true) );

            return $response->withStatus(500)
                ->withHeader('Content-type', 'application/json;charset=utf-8')
                ->withJson($data);


        }

        $sql = "SELECT * FROM usuarios WHERE email = '".$jsonRAW["email"]."'   ";
        $this->con->executa($sql);

        if ( $this->con->nrw == 0 ){


            $sql = "INSERT INTO jogadores (nome)
                VALUES('".$jsonRAW['nome']."')
                RETURNING id_jogador";
            $this->con->executa($sql, 1);

            if ( $this->con->res == 1 ){
                    $idjogador = $this->con->dados["id_jogador"];

                    $sql = "INSERT INTO usuarios (email, senha, id_jogador)
                            VALUES('".$jsonRAW['email']."','".$jsonRAW['senha1']."','".$idjogador."' ) ";
                    $this->con->executa($sql, 1);

                    if ( $this->con->res == 1 ){

                        $data =   array(	"resultado" =>  "SUCESSO" );
                        $data["idjogador"] = $idjogador;


                        return $response->withJson($data, 200)->withHeader('Content-Type', 'application/json');
                    }
                    else {

                        // nao encontrado
                        $data =    array(	"resultado" =>  "ERRO",
                            "erro" => "Error creating user");

                        return $response->withStatus(200)
                            ->withHeader('Content-type', 'application/json;charset=utf-8')
                            ->withJson($data);
                    }
            }
            else {

                // nao encontrado
                $data =    array(	"resultado" =>  "ERRO",
                    "erro" => "Error creating player");

                return $response->withStatus(200)
                    ->withHeader('Content-type', 'application/json;charset=utf-8')
                    ->withJson($data);
            }

        }
        else {

            // nao encontrado
            $data =    array(	"resultado" =>  "ERRO",
                "erro" => "User already registered");


            return $response->withStatus(200)
                ->withHeader('Content-type', 'application/json;charset=utf-8')
                ->withJson($data);



        }

    }

    function Autenticar(  $response, $jsonRAW){

        if (!$this->con->conectado){
            $data =   array(	"resultado" =>  "ERRO",
                    "erro" => "nao conectado - ".$this->con->erro );
            return $response->withStatus(500)
                ->withHeader('Content-type', 'application/json;charset=utf-8')
                ->withJson($data);
        }

        IF (!is_array( $jsonRAW) ) {
            $data =  array(	"resultado" =>  "ERRO",
                    "erro" => "JSON zuado - ".var_export($jsonRAW, true) );

            return $response->withStatus(500)
                ->withHeader('Content-type', 'application/json;charset=utf-8')
                ->withJson($data);


        }
        //@mail("babirondo@gmail.com", "novo cadastro", "novo suuarios");

        $sql = "SELECT * 
                FROM usuarios 
                WHERE email = '".$jsonRAW["email"]."' and senha = '".$jsonRAW[ "senha"]."' ";
        $this->con->executa($sql);

        if ( $this->con->nrw == 1 ){


            $this->con->navega(null);
            //autenticado
            $data =   array(	"resultado" =>  "SUCESSO",
                "id_usuario" => $this->con->dados["id_usuario"],
                "id_jogador" => $this->con->dados["id_jogador"] );


            return $response->withJson($data, 200)->withHeader('Content-Type', 'application/json');
        }
        else {

            // nao encontrado
            $data =    array(	"resultado" =>  "ERRO",
                "erro" => "Wrong Password");


            return $response->withStatus(200)
                ->withHeader('Content-type', 'application/json;charset=utf-8')
                ->withJson($data);



        }

    }
}
