<?php
namespace raiz;
set_time_limit(2);
error_reporting(E_ALL ^ E_DEPRECATED ^E_NOTICE);
class Globais{


    public $env;
    public $banco;

    function __construct( ){

        $this->env = $this->banco= "local";

        $this->verbose=1;

        $servidor["UI"] = $servidor["frontend"] = "http://192.168.0.150:81";
        $servidor["autenticacao"] = "http://192.168.0.150:82";
        $servidor["players"] = "http://192.168.0.150:83";
        $servidor["campeonato"] = "http://192.168.0.150:81";

        $servidor["bancodados_campeonato"] = "192.168.0.150";


        switch($this->banco){

            case("local");
              $this->localhost = $servidor["bancodados_campeonato"];
              $this->username = "postgres";
              $this->password = "postgres";
              $this->db ="authentication";
            break;

            case("prod");
                $this->localhost = "localhost";
                $this->username = "postgres";
                $this->password = "postgres";
                $this->db ="usuarios";
            break;

        }


        $this->Authentication_endpoint = $servidor["autenticacao"]."/PaintballSocialNetwork-AuthAPI/Auth/";
        $this->healthcheck = $servidor["autenticacao"]."/PaintballSocialNetwork-AuthAPI/healthcheck/";
        $this->NewUser_endpoint = $servidor["autenticacao"]."/PaintballSocialNetwork-AuthAPI/NewUser/";
        $this->NovoJogador_endpoint = $servidor["players"]."/PaintballSocialNetwork-Players/Players/";

    }


}
