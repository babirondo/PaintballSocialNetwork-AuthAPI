<?php
namespace raiz;
error_reporting( E_ALL ^E_NOTICE ); 
class Auth{
    public $Globais ;

    function __construct( ){

        require_once 'vendor/autoload.php'; // Autoload files using Composer autoload

        require_once("include/globais.php");
        $this->Globais = new Globais();

        $this->con = new \babirondo\classbd\db();
        $this->con->conecta( $this->Globais->banco ,
                              $this->Globais->localhost,
                              $this->Globais->db,
                              $this->Globais->username,
                              $this->Globais->password,
                              $this->Globais->port);

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

            $API = new\babirondo\REST\RESTCall();


            $APICall_CriarJogador = $API->CallAPI("POST",    $this->Globais->NovoJogador_endpoint , json_encode($jsonRAW) ) ;


            if ( $APICall_CriarJogador["id_jogador"] > 0 ){
                    $idjogador = $APICall_CriarJogador["id_jogador"];

                    $sql = "INSERT INTO usuarios (email, senha, id_jogador, usuarioTeste)
                            VALUES('".$jsonRAW['email']."','".$jsonRAW['senha1']."','".$idjogador."' ,'".(($jsonRAW['usuarioTeste'])?$jsonRAW['usuarioTeste']:"null")."') ";
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
