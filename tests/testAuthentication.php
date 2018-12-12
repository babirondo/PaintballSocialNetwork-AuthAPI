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

    public function testPost_NewUser()
    {
        set_time_limit(10);
        $rand = rand(500,8500);
        $nome = "test John Doe ".$rand;
        $email = "$rand@test.com";

        $senha1 = "$rand";
        $senha2 = "$rand";

        $JSON = json_decode( "  {\"nome\":\"$nome\",\"email\":\"$email\",\"senha1\":\"$senha1\",\"senha2\":\"$senha2\"} " , true);
        if ($JSON == NULL ) die(" JSON erro de formacao");

        $trans = null;$trans = array(":idtorneio" => null );
        $response = $this->client->request('POST', strtr($this->Globais->NewUser_endpoint, $trans)

            , array(
                'headers' => array('Content-type' => 'application/x-www-form-urlencoded'),
                'timeout' => 10, // Response timeout
                'form_params' => $JSON,
                'connect_timeout' => 10 // Connection timeout


            )
        );
        $jsonRetorno = json_decode($response->getBody()->getContents(), 1);
        //  var_dump($jsonRetorno);

        $this->assertEquals('SUCESSO', $jsonRetorno["resultado"] );

    }

    public function testPost_invalidAuthentication()
    {


        $response = $this->client -> request('POST',$this->Globais->Authentication_endpoint

            ,array(
                'headers' => array('Content-type' => 'application/x-www-form-urlencoded'),
                'form_params' => array(
                    'email' => 'bruno',
                    'senha' => 'brxuno'

                ),

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

            )
        );
        $jsonRetorno = json_decode($response->getBody()->getContents() ,1);

        //var_dump(  $jsonRetorno );
        $this->assertEquals(   'SUCESSO',  $jsonRetorno["resultado"]  );

    }

}