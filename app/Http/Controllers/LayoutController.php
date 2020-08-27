<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Layout;

class LayoutController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ['layouts' => Layout::all()];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return ['layout'  => Layout::with('keys')->where('id', $id)->get()];
    }
}
