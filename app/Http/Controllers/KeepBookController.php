<?php

namespace App\Http\Controllers;

use App\Models\KeepBook;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class KeepBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $keepbook = new KeepBook();
        $keepbook->user_id = $request->user()->id;
        $keepbook->tittle = $request->tittle;
        $keepbook->description = $request->description;

        $keepbook->save();
        return redirect()->back()
        ->with('message', 'Item Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $keepbook = User::find(1)->keepbooks;
        return Inertia::render('Keepbook', [
            'keepbooks' => $keepbook
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $keepbook = KeepBook::find($request->id);
        $keepbook->user_id = $request->user()->id;
        $keepbook->tittle = $request->tittle;
        $keepbook->description = $request->description;

        $keepbook->save();
        return redirect()->back()
        ->with('message', 'Item Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $keepbook = KeepBook::find($request->id);
        $keepbook->delete();
        return redirect()->back()
        ->with('message', 'Item Delete Successfully.');
    }
}
