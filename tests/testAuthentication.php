<?php

require('vendor/autoload.php');

class AuthenticationTest extends PHPUnit\Framework\TestCase
{
    protected $client;

    protected function setUp()
    {
        $this->client = new GuzzleHttp\Client( );

        require_once("include/globais.php");

        $this->Globais = new raiz\Globais();

    }


    //TODO:         $this->NewUser_endpoint = $servidor."/PaintballSocialNetwork-AuthAPI/NewUser/";
    public function testPost_invalidAuthentication()
    {


        $response = $this->client -> request('POST',$this->Globais->Authentication_endpoint

            ,array(
                'headers' => array('Content-type' => 'application/x-www-form-urlencoded'),
                'form_params' => array(
                    'email' => 'bruno',
                    'senha' => 'brxuno'

                ),
                'debug' => true,
                'http_errors' => true
            )
        );
        $jsonRetorno = json_decode($response->getBody()->getContents() ,1);

        //var_dump(  $jsonRetorno );
        $this->assertEquals(   'ERRO',  $jsonRetorno["resultado"]  );

    }


    public function testPost_validAuthentication()
    {

        $response = $this->client -> request('POST', $this->Globais->Authentication_endpoint

            ,array(
                'headers' => array('Content-type' => 'application/x-www-form-urlencoded'),
                'form_params' => array(
                    'email' => 'bruno',
                    'senha' => 'bruno'
                ),
                'timeout' => 10,
                'debug' => true,
            )
        );
        $jsonRetorno = json_decode($response->getBody()->getContents() ,1);

        //var_dump(  $jsonRetorno );
        $this->assertEquals(   'SUCESSO',  $jsonRetorno["resultado"]  );

    }


    public function testGet_HealthCheck()
    {

        $response = $this->client -> request('GET', $this->Globais->healthcheck

            ,array(
                'headers' => array('Content-type' => 'application/x-www-form-urlencoded'),

                'timeout' => 10,
                'debug' => true,
            )
        );
        $jsonRetorno = json_decode($response->getBody()->getContents() ,1);

        //var_dump(  $jsonRetorno );
        $this->assertEquals(   'SUCESSO',  $jsonRetorno["resultado"]  );

    }

}