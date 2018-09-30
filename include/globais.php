<?php
namespace raiz;
set_time_limit(2);
error_reporting(E_ALL ^ E_DEPRECATED ^E_NOTICE);
class Globais{


    public $env;
    public $banco;

    function __construct( ){



          $this->banco= "prod";
          $this->env = "local";


        switch($this->env){

            case("local");
                $servidor= "http://localhost:81";
                $this->verbose=1;
                break;

            case("prod");
                $servidor= "http://-";
                $this->verbose=1;
                break;

        }
        switch($this->banco){

            case("local");
                $this->localhost = "localhost";
                $this->username = "postgres";
                $this->password = "bruno";
                $this->db ="usuarios_local";
                break;

            case("prod");
                $this->localhost = "localhost";
                $this->username = "postgres";
                $this->password = "bruno";
                $this->db ="usuarios";
                break;

        }


        $this->Authentication_endpoint = $servidor."/PaintballSocialNetwork-AuthAPI/Auth/";
        $this->healthcheck = $servidor."/PaintballSocialNetwork-AuthAPI/healthcheck/";
        $this->NewUser_endpoint = $servidor."/PaintballSocialNetwork-AuthAPI/NewUser/";

    }


}
