<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WaitingVisitor;

class WaitingVisitorController extends Controller
{
    public function create(Request $request)
    {
        return view('waitingvisitors.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'nullable',
            'email' => 'required|email',
        ]);

        WaitingVisitor::create($validatedData);
    
        $request->session()->flash('status', 'Thank you! We will let you know once our service is available!');
        return back();
    }
    
}
