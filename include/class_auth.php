<?php
namespace raiz;
set_time_limit( 2 );
class Auth{
    function __construct( ){
        require("include/class_db.php");
        $this->con = new db();
        $this->con->conecta();
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

        $sql = "SELECT * FROM usuarios WHERE login = '".$jsonRAW["login"]."' and senha = '".$jsonRAW[ "senha"]."' ";
        $this->con->executa($sql);

        if ( $this->con->nrw == 1 ){


            $this->con->navega(null);
            //autenticado
            $data =   array(	"resultado" =>  "SUCESSO",
                    "email" => $this->con->dados["email"],
                    "id_usuario" => $this->con->dados["id_usuario"],
                    "nome" => $this->con->dados["nome"]);
            return $response->withJson($data, 200)->withHeader('Content-Type', 'application/json');
        }
        else {

            // nao encontrado
            $data =    array(	"resultado" =>  "ERRO",
                    "erro" => "Usuário/Senha não encontrado");

            return $response->withStatus(204)
                ->withHeader('Content-type', 'application/json;charset=utf-8')
                ->withJson($data);



        }

    }
}
