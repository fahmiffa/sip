<?php

namespace App\Http\Controllers;

use App\Models\Head;
use Illuminate\Http\Request;

class HeadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $da = Head::all();
        $data = "Dokumen";
        return view('document.index',compact('da','data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = "Tambah Dokumen";
        return view('document.create',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Head $head)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Head $head)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Head $head)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Head $head)
    {
        //
    }
}
