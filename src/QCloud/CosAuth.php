<?php

/**
 * Created by PhpStorm.
 * User: lewis
 * Date: 2019/3/31
 * Time: 13:18
 */

namespace YueCode\Cos\QCloud;


/**
 * Class Auth
 * @package YueCode\Cos
 */
class CosAuth
{
    // Secret id or secret key is not valid.
    const AUTH_SECRET_ID_KEY_ERROR = -1;


    function __construct()
    {

    }

    /**
     * Create reusable signature for listDirectory in $bucket or uploadFile into $bucket.
     * If $file_path is not null, this signature will be binded with this $file_path.
     * This signature will expire at $expiration timestamp.
     * Return the signature on success.
     * Return error code if parameter is not valid.
     */
    public static function createReusableSignature($app_id, $secret_id, $secret_key, $expiration, $bucket, $file_path = null)
    {

        if (empty($app_id) || empty($secret_id) || empty($secret_key)) {
            return self::AUTH_SECRET_ID_KEY_ERROR;
        }

        if (empty($file_path)) {
            return self::createSignature($app_id, $secret_id, $secret_key, $expiration, $bucket, null);
        } else {
            if (preg_match('/^\//', $file_path) == 0) {
                $file_path = '/' . $file_path;
            }

            return self::createSignature($app_id, $secret_id, $secret_key, $expiration, $bucket, $file_path);
        }
    }

    /**
     * Create non_reusable signature for delete $file_path in $bucket.
     * This signature will expire after single usage.
     * Return the signature on success.
     * Return error code if parameter is not valid.
     */
    public static function createNonReusableSignature($app_id, $secret_id, $secret_key, $bucket, $file_path)
    {

        if (empty($app_id) || empty($secret_id) || empty($secret_key)) {
            return self::AUTH_SECRET_ID_KEY_ERROR;
        }

        if (preg_match('/^\//', $file_path) == 0) {
            $file_path = '/' . $file_path;
        }
        $fileId = '/' . $app_id . '/' . $bucket . $file_path;

        return self::createSignature($app_id, $secret_id, $secret_key, 0, $bucket, $fileId);
    }

    /**
     * A helper function for creating signature.
     * Return the signature on success.
     * Return error code if parameter is not valid.
     */
    private static function createSignature($appId, $secretId, $secretKey, $expiration, $bucket, $fileId, $method = 'post')
    {

        if (empty($secretId) || empty($secretKey)) {
            return self::AUTH_SECRET_ID_KEY_ERROR;
        }

        $now = time();
        $random = rand();
        $plainText = "a=$appId&k=$secretId&e=$expiration&t=$now&r=$random&f=$fileId&b=$bucket";
        $bin = hash_hmac('SHA1', $plainText, $secretKey, true);
        $bin = $bin . $plainText;

        $signature = base64_encode($bin);

        return $signature;


//        if (empty($secretId) || empty($secretKey)) {
//            return self::AUTH_SECRET_ID_KEY_ERROR;
//        }
//
//        $q_sign_time = (string)(time() - 60) . ';' . (string)(time() + 3600);
//        $q_key_time = $q_sign_time;
//
//        $http_string = strtolower($request->getMethod()) . "\n" . urldecode($request->getPath()) .
//            "\n\nhost=" . $request->getHost() . "\n";
//        $sha1HttpString = sha1($http_string);
//        $signKey = hash_hmac('sha1', $q_key_time, $secretKey);
//        $stringToSign = "sha1\n$q_sign_time\n$sha1HttpString\n";
//        $signature = hash_hmac('sha1', $stringToSign, $signKey);
//
//        $authorization = 'q-sign-algorithm=sha1&q-ak=' . $secretKey .
//            "&q-sign-time=$q_sign_time&q-key-time=$q_key_time&q-header-list=host&q-url-param-list=&" .
//            "q-signature=$signature";
//
//        return $authorization;
    }
}
