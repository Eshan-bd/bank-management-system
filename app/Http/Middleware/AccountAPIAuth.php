<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use DateTime;
use App\Models\UserToken;

class AccountAPIAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header("Authorization");
        $check_token = UserToken::Where('userkey', $token)->first();
        
        if($check_token){

            $current_time = new DateTime();
            $expired = new DateTime($check_token->expired_at);


            if($current_time < $expired){

                return $next($request);

            }else{
                return response()->json([
                    'autherror' => 'Login Timed Out! Login Again...',
                ]);
            }

        }else{
            return response()->json([
                'autherror' => 'Please Login First!!!',
            ]);
        }
    }
}
