<?php

// app/Http/Middleware/Authenticate.php  

namespace App\Http\Middleware;  

use Illuminate\Auth\Middleware\Authenticate as Middleware;  

class Authenticate extends Middleware  
{  
    /**  
     * Get the path the user should be redirected to when they are not authenticated.  
     *  
     * @param  \Illuminate\Http\Request  $request  
     * @return string|null  
     */  
    protected function redirectTo($request)  
    {  
        if (! $request->expectsJson()) {  
            // Almacenar mensaje en la sesión  
            $request->session()->flash('error', 'You must be logged in to access this page.');  
            
            return route('login.login');  
        }  
    }  
}
