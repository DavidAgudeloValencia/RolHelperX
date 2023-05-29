<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
        $inventory = new Inventory;
        $inventory->user_id = $request->user()->id;
        $inventory->tittle = $request->tittle;
        $inventory->description = $request->description;
        $inventory->amount = $request->amount;

        $inventory->save();
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
        $inventory = User::find(1)->inventories;
        return Inertia::render('Inventory', [
            'inventories' => $inventory
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
        $inventory = Inventory::find($request->id);
        $inventory->user_id = $request->user()->id;
        $inventory->tittle = $request->tittle;
        $inventory->description = $request->description;
        $inventory->amount = $request->amount;

        $inventory->save();
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
        $inventory = Inventory::find($request->id);
        $inventory->delete();
        return redirect()->back()
        ->with('message', 'Item Delete Successfully.');
    }
}
