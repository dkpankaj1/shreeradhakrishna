<?php

namespace App\Http\Controllers;

use App\Models\Messenger;
use Illuminate\Http\Request;

class MessengerController extends Controller
{
    public function index(Request $request)
    {
        $messengers = Messenger::latest()->paginate(20); 
        return view('massager.index');
    }
    public function create(Request $request)
    {
        return view('massager.create');
    }
    public function store(Request $request)
    {
    }
}
