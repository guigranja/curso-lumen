<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SeriesController
{
    public function index()
    {
        return [
            'Friends',
            'Peaky Blinders',
            'That 70s Show'
        ];
    }
}
