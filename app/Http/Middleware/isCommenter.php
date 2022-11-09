<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Constants\UserRole;
use App\Traits\ReturnsJsonResponses;

class isAdmin
{
  use ReturnsJsonResponses;

  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle(Request $request, Closure $next)
  {
    $user = $request->user();
    if ($user->scope != UserRole::COMMENTER || $user->scope != UserRole::ADMIN || $user->scope != UserRole::SUPERADMIN || $user->scope != UserRole::PUBLISHER) {
      return $this->authorizationError("The logged in user is not authorized to carry out the request. Only admin is allowed");
    }else{
      return $next($request);
    }
  }
}
