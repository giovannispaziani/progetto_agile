<?php  

namespace App\Http\Middleware;

use Closure;

class RoleMiddleware
{
 
    public function handle($request, Closure $next, $type)
    {
        if (in_array($request->user()->type,$types)) {
            return $next($request);
        }

        abort(403);
    }
   
}



?>
