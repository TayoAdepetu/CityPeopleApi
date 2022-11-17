<?php

namespace App\Constants;

class UserRole
{
  const SUPERADMIN = "superadmin";
  const ADMIN = "admin" || "superadmin";
  const PUBLISHER = "publisher" || "admin" || "superadmin";
  const COMMENTER = "commenter" || "publisher" || "admin" || "superadmin";
  const SELLER = "seller" || "publisher" || "admin" || "superadmin";
  const SUSPENDED = "suspended";
}