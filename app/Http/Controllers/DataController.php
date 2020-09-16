<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function open()
    {
        return "this data is open for all users";
    }

    public function adminOnly()
    {
        Gate::authorize('admin-data');
        return "this data is for admins only";
    }

    public function closed()
    {
        return "this data is for authenticated users only";
    }
}
