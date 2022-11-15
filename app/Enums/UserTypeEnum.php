<?php 
namespace App\Enums;

use App\Enums\BaseEnum;

class UserTypeEnum extends BaseEnum{
    public const ADMIN        = 'admin';
    public const STUDIO_OWNER = 'studio_owner';
    public const EMPLOYEE     = 'employee';
    public const CUSTOMER     = 'customer';
}