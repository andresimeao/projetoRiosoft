<?php

namespace Utils;

class JWTUtils
{

  private static $key = "!/jwt-Riosoft-2019@faSDF@!oj";
  private static $minutesValid = 1000;

  public static function getHeader () {
    return [
        'typ' => 'JWT',
        'alg' => 'HS256'
    ];
  }

  /**
   * Cria um novo JWT (https://www.jwt.io/)
   * @author Hiago Silva Souza <hiago.souza@riosoft.com.br>
   */
  public static function getToken ($payload) {

    if($payload instanceof \stdClass)
      $payload->time = time();
    else
      $payload['time'] = time();

    $header = json_encode(self::getHeader());
    $header = base64_encode($header);
    $payload = json_encode($payload);
    $payload = base64_encode($payload);
    $signature = hash_hmac('sha256', "{$header}.{$payload}", self::$key, true);
    $signature = base64_encode($signature);
    $token = "{$header}.{$payload}.{$signature}";
    return $token;
  }

  /**
   * Verifica se o JWT é válido.
   * @author André Simeão Ferreira <andre.simeao@riosoft.com.br>
   */
  public static function getPayload($token) {
    $token = explode('.', $token);
    return json_decode(base64_decode($token[1]));
  }

  /**
   * Verifica se o JWT é válido.
   * @author Hiago Silva Souza <hiago.souza@riosoft.com.br>
   */
  public static function verify ($token) {

    if(empty($token))
      throw new \Exception('Token não informado!', 401);

    $token = explode('.', $token);

    $header = $token[0];
    $payload = $token[1];
    $send_signature = $token[2];

    if(\json_decode(\base64_decode($header))->alg != self::getHeader()['alg'])
      throw new \Exception('Algoritmo de autenticação é invalido!', 401);

    //gerando assinatura para validar
    $signature = hash_hmac('sha256', "{$header}.{$payload}", self::$key, true);
    $signature = base64_encode($signature);

    if($signature != $send_signature)
      throw new \Exception('Token não foi assinado pelo servidor!', 401);

    //verificando tempo de validade
    $data = \json_decode(\base64_decode($payload));

    if((time() - (self::$minutesValid * 60)) >= $data->time)
      throw new \Exception('A vida útil do token ('.self::$minutesValid.' minutos) foi atingida!', 401);

    //gerando um novo token
    header('Token: ' . self::getToken($data));

    return true;
  }
}
