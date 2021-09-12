<?php

namespace App\Http\Controllers;

use App\Models\QuizeGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuizeController extends Controller
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
    public function create($quize_group_id)
    {
        $group = QuizeGroup::find($quize_group_id, ['title', 'has_content']);

        if ($group->has_content != 0) {
            return redirect()->route('quize_group.menu');
        }

        return view('quize.create');
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
    // クイズ単体
    public function show($group_id, $sort_num)
    {
        if ($sort_num <= 0) {
            abort('404');
        }

        $quize_quantity = DB::table('quizes')->select(DB::raw('count(*) as quantity'))->where('quize_group_id', $group_id)->get()[0]->quantity;

        if ($quize_quantity != 0 && $sort_num <= $quize_quantity) {
            $quize = DB::table('quizes')->where('quize_group_id', $group_id)->where('sort_num', $sort_num)->get()[0];
            $isLast = $sort_num == $quize_quantity ? 'true' : 'false';
        } else {
            abort('404');
        }

        return view('quize.show', compact('quize', 'isLast'));
    }
    public function edit($id)
    {
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
