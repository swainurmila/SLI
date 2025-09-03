<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    function generateUniqueId($length = 4) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $uniqueId = '';
    
        for ($i = 0; $i < $length; $i++) {
            $uniqueId .= $characters[rand(0, strlen($characters) - 1)];
        }
    
        return $uniqueId;
    }
    
}
