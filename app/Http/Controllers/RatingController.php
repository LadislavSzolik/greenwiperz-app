<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\User;
use Illuminate\Http\Request;

class RatingController extends Controller
{

    public function create(Request $request)
    {       
        return view('ratings.create',['user'=> $request['user']]);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'level' => 'required',
            'user' => 'required',
            'comment' => 'nullable',
        ]);
        $user = User::find($validated ['user']);
        $user->ratings()->create([
            'level' =>  $validated['level'],
            'comment' =>  $validated['comment'],           
        ]);
        request()->session()->flash('status');
        return back();
    }

    
}
