<?php
namespace App\Classes;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use InvalidArgumentException;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class dlURL {

    /**
     * Create a signed route URL for a named route.
     *
     * @param  string  $name
     * @param  mixed  $parameters
     * @param  \DateTimeInterface|\DateInterval|int|null  $expiration
     * @param  bool  $absolute
     * @return string
     *
     * @throws \InvalidArgumentException
     */
    public static function signedRoute($name, $parameters = [], $absolute = true)
    {
        $parameters = Arr::wrap($parameters);

        if (array_key_exists('signature', $parameters)) {
            throw new InvalidArgumentException(
                '"Signature" is a reserved parameter when generating signed routes. Please rename your route parameter.'
            );
        }

        ksort($parameters);

        $key = config('app.key').'usr_'.Auth::id();

        $route = route($name, $parameters, $absolute);
        $pos = strpos($route,'?');
        if ($pos !== false) {
            $route = substr($route,0,strpos($route,'?'));
        }

        return route($name, $parameters + [
            'signature' => hash_hmac('sha256', $route, $key),
        ], $absolute);


        // return route($name, $parameters + [
        //     'signature' => hash_hmac('sha256', route($name, $parameters, $absolute), $key),
        // ], $absolute);
    }

    /**
     * Determine if the given request has a valid signature.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  bool  $absolute
     * @return bool
     */
    public static function hasValidSignature(Request $request, $absolute = true)
    {
        $url = $absolute ? $request->url() : '/'.$request->path();

        $original = rtrim($url.'?'.Arr::query(
            Arr::except($request->query(), 'signature')
        ), '?');

        $signature = hash_hmac('sha256', $url, config('app.key').'usr_'.Auth::id());

        return hash_equals($signature, (string) $request->query('signature', ''));
    }

}
