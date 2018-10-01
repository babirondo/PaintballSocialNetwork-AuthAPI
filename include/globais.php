<?php
namespace raiz;
set_time_limit(2);
error_reporting(E_ALL ^ E_DEPRECATED ^E_NOTICE);
class Globais{


    public $env;
    public $banco;

    function __construct( ){

        $this->banco= "prod";
        $this->env = "prod";

        $this->verbose=1;

        $servidor["UI"] = $servidor["frontend"] = "http://34.247.245.249";
        $servidor["autenticacao"] = "http://34.242.188.167";
        $servidor["players"] = "http://54.171.155.88";
        $servidor["campeonato"] = "http://34.242.140.31";

        switch($this->banco){

            case("local");
              $this->localhost = "localhost";
              $this->username = "postgres";
              $this->password = "bruno";
              $this->db ="usuarios";
            break;

            case("prod");
                $this->localhost = "localhost";
                $this->username = "postgres";
                $this->password = "bruno";
                $this->db ="usuarios";
            break;

        }


        $this->Authentication_endpoint = $servidor["autenticacao"]."/PaintballSocialNetwork-AuthAPI/Auth/";
        $this->healthcheck = $servidor["autenticacao"]."/PaintballSocialNetwork-AuthAPI/healthcheck/";
        $this->NewUser_endpoint = $servidor["autenticacao"]."/PaintballSocialNetwork-AuthAPI/NewUser/";
        $this->NovoJogador_endpoint = $servidor["players"]."/PaintballSocialNetwork-Players/Players/";

    }


}
