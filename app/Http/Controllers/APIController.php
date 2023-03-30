<?php

namespace App\Http\Controllers;
use App\Models\customer;
use App\Models\product;
use Illuminate\Http\Request;

class APIController extends Controller
{
    public function index()
    {
        return product::all();
        
    }

    public function login()
    {
        return customer::all();
    }
}
