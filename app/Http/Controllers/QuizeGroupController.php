<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuizeGroupController extends Controller
{
    public function create()
    {
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
    public function show($id)
    {
        $group = DB::table('quize_groups')
            ->select(DB::row('users.id as user_id, users.name as username, categories.name as category_name, information, good_count, title'))
            ->join('categories', '=', 'quize_groups.category_id')
            ->join('users', 'users.id', '=', 'quize_groups.user_id')
            ->where('quize_groups.id', '=', $id)
            ->get();

        dd($group);
        if ($group->isEmpty()) {
            abort('404');
        }
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
    public function destroy($id)
    {
        //
    }
}
