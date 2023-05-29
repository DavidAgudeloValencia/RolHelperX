<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserState;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserStateController extends Controller
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
        //
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
    public function edit($id)
    {
        //
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
        if ($request->id !== 0) {
            $userState = UserState::find($request->id);
            $userState->user_id = $request->user_id;
            $userState->life = $request->life;
            $userState->main_magic = $request->main_magic;
            $userState->secondary_magic = $request->secondary_magic;
            $userState->tertiary_magic = $request->tertiary_magic;
            $userState->dice_4 = $request->dice_4;
            $userState->dice_5 = $request->dice_5;
            $userState->dice_6 = $request->dice_6;

            $userState->save();
            return $userState;
        } else {
            $userState = new UserState;
            $userState->user_id = $request->user_id;
            $userState->life = $request->life;
            $userState->main_magic = $request->main_magic;
            $userState->secondary_magic = $request->secondary_magic;
            $userState->tertiary_magic = $request->tertiary_magic;
            $userState->dice_4 = $request->dice_4;
            $userState->dice_5 = $request->dice_5;
            $userState->dice_6 = $request->dice_6;

            $userState->save();
            return $userState;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
