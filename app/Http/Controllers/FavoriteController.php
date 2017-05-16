<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;

class FavoriteController extends Controller
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
    public function store(Request $request, $mid)
    {
        $userid = \Auth::user()->id;
        \Auth::user()->favorite($userid, $mid);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = \Auth::user();
        $userid = $user->find($id);
        $favorites = DB::table('favorites')->select('micropost_id')->where('user_id', $userid['id'])->get();

        $favorite = array();
        foreach ($favorites as $value) {
            array_push($favorite, $value->micropost_id);
        }

        $microposts = $user->feed_microposts()->whereIn('id', $favorite)->orderBy('created_at', 'desc')->paginate(5);

        return view('users.favorites', [
            'microposts' => $microposts,
        ]);

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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($mid)
    {
        $userid = \Auth::user()->id;
        \Auth::user()->unfavorite($userid, $mid);
        return redirect()->back();
    }
}
