<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WaTemplate;

class MassageComposerController extends Controller
{
    public function index()
    {
        $messageTemplates = WaTemplate::where('approve', 1)
            ->where("is_system_call", 0)
            ->get();
        return view('massager.create', [
            "messageTemplates" => $messageTemplates
        ]);

    }
}
