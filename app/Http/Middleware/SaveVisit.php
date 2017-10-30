<?php

namespace App\Http\Middleware;

use Closure;

use UAParser\Parser;



class SaveVisit
{

    function __construct()
    {
        
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return $next($request);
    }

    public function terminate($request, $response)
    {

        $parser = Parser::create()->parse($request->header('User-Agent'));

        $ua = $parser->ua->family ."@" .$parser->os->family;




    }

}
