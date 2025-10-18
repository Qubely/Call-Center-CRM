<?php

namespace App\Http\Middleware\Admin;

use Closure;
use App\Models\AdminUser;
use App\Traits\BaseTrait;
use Auth;
class HasAdminUserAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure  $next
     * @return mixed
     */
    use BaseTrait;
    public function handle($request, Closure $next)
    {
        $user = Auth::guard('admin')->user() ?? AdminUser::where('uuid', $request->auth_uuid)->first();
        if (! $user) {
            return $this->response([
                'type' => 'noUpdate',
                'title' => $request->filled('auth_uuid') ? 'No authenticated user found' : 'Authentication required',
            ]);
        }
        $request->merge(['auth' => $user]);
        return $next($request);
    }
}
