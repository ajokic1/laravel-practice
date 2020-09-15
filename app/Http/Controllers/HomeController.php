<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return "test";
    }

    public function store(Request $request)
    {
        return $request->all();
    }

    public function update(Request $request, $id)
    {
        return "Updated id $id with data:" . json_encode($request->all());
    }

    public function delete($id)
    {
        return "Deleted $id";
    }
}
