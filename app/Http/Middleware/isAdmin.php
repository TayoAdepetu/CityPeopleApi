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
   * @return mixedif ($user->scope != UserRole::ADMIN || UserRole::SUPERADMIN) {if ($user->scope != UserRole::ADMIN || UserRole::SUPERADMIN) {
   */
  public function handle(Request $request, Closure $next)
  {
    $user = $request->user();
    if ($user->scope != UserRole::ADMIN) {
      return $this->authorizationError("The logged in user is not authorized to carry out the request. Only admin is allowed");
    }else{
      return $next($request);
    }
  }
}
