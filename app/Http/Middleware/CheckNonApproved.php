<?php

namespace App\Http\Middleware;

use Closure;

class CheckNonApproved
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $instr =  $request->route('instruction');
        if($instr->is_approved){
            return $next($request);
        }
        return redirect('/');
    }
}
