<?php

declare(strict_types=1);

namespace App\Helpers;



use Illuminate\Support\Facades\File;

class PocJwt
{
    public static function createToken(array $payload): string
    {
        $header = self::getHeader();
        $headerEncoded = self::base64url_encode(json_encode($header));
        $payloadEncoded = self::base64url_encode(json_encode($payload));
        $data = "$headerEncoded.$payloadEncoded";
        $signature = self::sign($header['alg'], $data);
        return "$data.$signature";
    }

    public static function verifyToken(string $jwt)
    {
        $header = self::getHeader();
        $tokenParts = explode('.', $jwt);
        $data = "$tokenParts[0].$tokenParts[1]";
        $signature_provided = $tokenParts[2];
        $signature = self::sign($header['alg'], $data);
        return $signature_provided === $signature;
    }

    public static function decodeToken(string $jwt)
    {
        $tokenParts = explode('.', $jwt);
        return json_decode(self::base64url_decode($tokenParts[1]));
    }

    protected static function sign(string $alg, string $data): string
    {
        $sign = '';
        $algorithm = self::getAlgorithm($alg);
        if(strncmp($alg, "HS", 2) === 0){
            $sign = hash_hmac($algorithm, $data, env('JWT_SECRET'), true);
        }
        if(strncmp($alg, "RS", 2) === 0){
            openssl_sign($data, $sign, File::get(base_path(env('JWT_PRIVATE_KEY'))), $algorithm);
        }
        return self::base64url_encode($sign);
    }

    protected static function base64url_encode( string $data ): string
    {
        return rtrim( strtr( base64_encode( $data ), '+/', '-_'), '=');
    }

    protected static function base64url_decode( string $data ): string
    {
        return base64_decode( strtr( $data, '-_', '+/') . str_repeat('=', 3 - ( 3 + strlen( $data )) % 4 ));
    }

    protected static function getAlgorithm(string $alg): string
    {
        $algorithms = [
            'HS256' => 'SHA256',
            'HS512' => 'SHA512',
            'RS256' => 'SHA256',
        ];
        return $algorithms[$alg];
    }

    protected static function getHeader(): array
    {
        return [
            'typ' => 'JWT',
            'alg' => env('JWT_ALG')
        ];
    }
}
