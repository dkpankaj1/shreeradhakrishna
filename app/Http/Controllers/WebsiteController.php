<?php

namespace App\Http\Controllers;

use App\Models\ContactUsMessages;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function index()
    {
        return view('frontend.home');
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function contact_store(Request $request)
    {
        $request->validate([
            'first_name' => "required",
            'last_name' => "required",
            'email' => "required|email",
            'phone' => "required",
            'message' => "required",
        ]);

        ContactUsMessages::create([
            "first_name" => $request->first_name,
            "last_name" => $request->last_name,
            "email" => $request->email,
            "phone" => $request->phone,
            "message" => $request->message,
        ]);
        return redirect()->back()->with('msgSend',"Thank You For Your Message. Out Team Connect You Shortly.");

    }
}
