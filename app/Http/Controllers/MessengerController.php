<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Messenger;
use Illuminate\Http\Request;

class MessengerController extends Controller
{
    public function index(Request $request)
    {
        $messengers = Messenger::latest()->paginate(20);
        return view('massager.index', [
            'messengers' => $messengers
        ]);
    }
    public function create(Request $request)
    {
        $customers = Customer::withCount('purchases')->orderBy('purchases_count', 'DESC')->get();
        return view('massager.create', ['customers' => $customers]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'ids' => 'required',
            'message' => 'required'
        ]);
        return redirect()->back()->with('success', 'message sending in queue,');
    }
}
