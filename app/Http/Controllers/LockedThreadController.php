<?php

namespace App\Http\Controllers;

use App\Thread;
use Illuminate\Http\Request;

class LockedThreadController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Thread $thread)
    {
        $thread->update(['locked' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Thread $thread)
    {
        $thread->update(['locked' => false]);
    }
}
