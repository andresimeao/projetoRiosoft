<?php
/*
 * Copyright 2015 Bruno de Oliveira Francisco <bruno@salluzweb.com.br>
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace EasyFast\Http;

use ReflectionMethod;
use StdClass;
use EasyFast\App;
use EasyFast\Common\Utils;
use EasyFast\Common\AnnotationReader;
use EasyFast\Exceptions\EasyFastException;

/**
 * Class Restful
 * Cria servidor restful
 * @author Bruno Oliveira <bruno@salluzweb.com.br>
 * @package EasyFAst\Http
 */
class Restful
{
    /**
     * @var array Store querystring
     */
    private $queryString;

    /**
     * Method __construct
     * @author Bruno Oliveira <bruno@salluzweb.com.br>
     */
    public function __construct()
    {
        if (empty($_SERVER['REQUEST_METHOD'])) {
            throw new EasyFastException('REQUEST_METHOD não disponivel.');
        }
    }

    /**
     * Method restful
     * Executa servidor restful, apenas entra dentro do contexto se URL e método forem os mesmos declarados
     * @author Bruno Oliveira <bruno@salluzweb.com.br>
     * @param string $method Método da requisição, POST, GET, DELETE, PUT
     * @param string $url
     * @param callback|array $callback
     * @param bool $argsAssoc Informa se os argumentos são associativos
     * @param bool $returnJson Transforma o retorno ou echo em json
     * @return bool|callback
     */
    public function server($method, $url, $callback, $argsAssoc = true, $returnJson = true)
    {
        $method = strtoupper($method);
        try {
            if ($this->checkUrl($url) && ($_SERVER['REQUEST_METHOD'] == $method && is_callable($callback))) {
                ob_clean();
                $return = null;
                if (is_array($callback) && $argsAssoc) {
                    $data = Utils::decodeRequest();
                    if (empty($data)) {
                        $data = new StdClass();
                    }
                    foreach ($this->queryString as $key => $val) {
                        $data->$key = $val;
                    }

                    //TODO tento serializar o Json enviado, verificar para funcionar quando for 1 para N.
                    //region Tentado serializar os objetos caso sejam classes
                    $r = new ReflectionMethod($callback[0], $callback[1]);
                    $params = $r->getParameters();
                    foreach ($params as $param) {

                        $c = $param->getClass();
                        if($c) {
                            $data->{$param->getName()} = Utils::modelBind($data, $c);
                        }
                    }
                    //endregion

                    $return = Utils::callMethodArgsOrder($callback[0], $callback[1], (array)$data);
                } elseif (is_array($callback)) {
                    $return = call_user_func_array(array(new $callback[0], $callback[1]), $this->queryString);
                } else {
                    $return = call_user_func_array($callback, $this->queryString);
                }
                $content = ob_get_contents();
                ob_clean();

                $annReturnType = str_replace(array("\r", "\n"), '',  AnnotationReader::getAnnotationMethod($callback[0], $callback[1], 'EF_returnType'));
                $annHttpStatus = AnnotationReader::getAnnotationMethod($callback[0], $callback[1], 'EF_httpStatus');
                $annContentType = AnnotationReader::getAnnotationMethod($callback[0], $callback[1], 'EF_contentType');
                $annCrossOrigin = AnnotationReader::getAnnotationMethod($callback[0], $callback[1], 'EF_crossOrigin');

                if ($annHttpStatus) {
                    header("HTTP/1.1 {$annHttpStatus}");
                }
                if ($annContentType) {
                    header("Content-Type: {$annContentType}");
                }
                if ($annReturnType == 'mixed') {
                    echo $return;
                    exit();
                }

                if ((is_string($return) || is_null($return))) {
                    $this->response(array('message' => (trim($content . ' ' . $return))));
                } elseif (is_array($return) || is_object($return)) {
                    $this->response($return);
                }
                exit();
            }
        } catch (EasyFastException $e) {
            $code = empty($e->getCode()) ? 412 : $e->getCode();
            $this->response('status => error | message => ' . $e->getMessage(), $code);
        }

        return false;
    }


    /**
     * Method crossOrigin
     * Habilita crossOrigin
     * @author Bruno Oliveira <bruno@salluzweb.com.br>
     * @access public
     * @param bool $bool
     */
    public static function crossOrigin($bool, $keys = null)
    {
        if ($bool) {
            if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
                if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']) && (
                        $_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'] == 'GET' ||
                        $_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'] == 'POST' ||
                        $_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'] == 'DELETE' ||
                        $_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'] == 'PUT')
                ) {
                    $sKeys = 'Origin, X-Requested-With, Content-Type, Accept';
                    if (!is_null($keys)) {
                        $sKeys .= ', ' . $keys;
                    }
                    header('Access-Control-Allow-Origin: *');
                    header("Access-Control-Allow-Headers: $sKeys");
                    header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT');
                    header('Access-Control-Max-Age: 86400');
                }
                exit;
            } else {
                header('Access-Control-Allow-Origin: *');
            }
        }
    }

    /**
     * check Url request
     *
     * @author Bruno Oliveira <bruno@salluzweb.com.br>
     * @param String $url
     * @throws EasyFastException
     * @return array
     */
    public function checkUrl($url)
    {
        $url = array_filter(explode('/', $url));
        $queryString = array_filter(explode('/', isset($_GET['url']) ? $_GET['url'] : null));
        $this->queryString = array();

        if (count($url) != count($queryString)) {
            return false;
        }

        foreach ($url as $key => $val) {
            if (preg_match('/^:/', $val)) {
                $newKey = str_replace(':', '', $val);
                $this->queryString[$newKey] = $queryString[$key];
            } elseif ($queryString[$key] != $val) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get QueryString format
     *
     * @return array
     */
    public function getQueryString()
    {
        return $this->queryString;
    }

    /**
     * Method response
     * Return response in json, HTTP Status and exit system
     * @author Bruno Oliveira <bruno@salluzweb.com.br>
     * @param $response
     * @param $httpStatus
     * @param $break
     * @access public
     * @return string
     */
    public static function response($response, $httpStatus = 200, $break = true)
    {
        header("HTTP/1.1 {$httpStatus}");
        header('Content-Type: application/json');
        echo Utils::jsonEncode($response);
        if ($break) {
            exit();
        }
    }

}
