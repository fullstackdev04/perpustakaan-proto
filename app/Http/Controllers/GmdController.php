<?php

namespace App\Http\Controllers;

use App\Gmd;
use Illuminate\Http\Request;

class GmdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.master.gmd.home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.master.gmd.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kode_gmd' => 'required|unique:gmd',
            'nama_gmd' => 'required',
        ]);

        Gmd::create($request->all());

        return response()->json([
            'message' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Gmd  $gmd
     * @return \Illuminate\Http\Response
     */
    public function show(Gmd $gmd)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gmd  $gmd
     * @return \Illuminate\Http\Response
     */
    public function edit(Gmd $gmd)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gmd  $gmd
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gmd $gmd)
    {
       $gmd->update($request->all());
        
        return response('data berhasil diupdate', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gmd  $gmd
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gmd $gmd)
    {
        $gmd->delete();
    }
}
