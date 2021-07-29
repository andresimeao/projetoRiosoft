<?php
/**
 * Created by PhpStorm.
 * User: hiago
 * Date: 24/12/2016
 * Time: 11:25
 */

namespace EasyFast\Http;


class StatusCode
{
    //region Informational 1xx
    public static $Continue = 100;
    public static $SwitchingProtocols = 101;
    //endregion

    //region Successful 2xx
    public static $OK = 200;
    public static $Created = 201;
    public static $Accepted = 202;
    public static $NonAuthoritativeInformation = 203;
    public static $NoContent = 204;
    public static $ResetContent = 205;
    public static $PartialContent = 206;
    //endregion

    //region Redirection 3xx
    public static $MultipleChoices = 300;
    public static $Ambiguous = 300;
    public static $MovedPermanently = 301;
    public static $Moved = 301;
    public static $Found = 302;
    public static $Redirect = 302;
    public static $SeeOther = 303;
    public static $RedirectMethod = 303;
    public static $NotModified = 304;
    public static $UseProxy = 305;
    public static $Unused = 306;
    public static $TemporaryRedirect = 307;
    public static $RedirectKeepVerb = 307;
    //endregion

    //region Client Error 4xx
    public static $BadRequest = 400;
    public static $Unauthorized = 401;
    public static $PaymentRequired = 402;
    public static $Forbidden = 403;
    public static $NotFound = 404;
    public static $MethodNotAllowed = 405;
    public static $NotAcceptable = 406;
    public static $ProxyAuthenticationRequired = 407;
    public static $RequestTimeout = 408;
    public static $Conflict = 409;
    public static $Gone = 410;
    public static $LengthRequired = 411;
    public static $PreconditionFailed = 412;
    public static $RequestEntityTooLarge = 413;
    public static $RequestUriTooLong = 414;
    public static $UnsupportedMediaType = 415;
    public static $RequestedRangeNotSatisfiable = 416;
    public static $ExpectationFailed = 417;
    public static $UpgradeRequired = 426;
    public static $InternalServerError = 500;
    public static $NotImplemented = 501;
    public static $BadGateway = 502;
    public static $ServiceUnavailable = 503;
    public static $GatewayTimeout = 504;
    public static $HttpVersionNotSupported = 505;
    //endregion
}