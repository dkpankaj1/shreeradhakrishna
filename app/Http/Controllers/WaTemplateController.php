<?php

namespace App\Http\Controllers;

use App\Models\Messenger;
use App\Models\WaTemplate;
use Illuminate\Http\Request;

class WaTemplateController extends Controller
{
    public function index()
    {
        $waTemplates = WaTemplate::all();
        return view('we-template.index', [
            'waTemplates' => $waTemplates
        ]);
    }
    public function create()
    {
        return view('we-template.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'template_id' => 'required',
            'template' => 'required',
        ]);

        WaTemplate::create([
            "template_id" => $request->template_id,
            "template" => $request->template,
            "status" => 1
        ]);

        return redirect()->route('wa-template.index')->with('success', 'template add success.');
    }
    public function edit(WaTemplate $wa_template)
    {
        return view('we-template.edit', ['waTemplate' => $wa_template]);
    }
    public function update(Request $request, WaTemplate $wa_template)
    {
        $request->validate([
            'template_id' => 'required',
            'template' => 'required',
        ]);

        $wa_template->update([
            "template_id" => $request->template_id,
            "template" => $request->template,
            "status" => 1
        ]);

        return redirect()->route('wa-template.index')->with('success', 'template update success.');
    }
    public function destroy(WaTemplate $wa_template)
    {
        $count = $wa_template->messengers()->count();

        if ($count > 0) {
            return redirect()->route('wa-template.index')->with('danger', 'template could not be deleted.');
        } else {
            $wa_template->delete();
            return redirect()->route('wa-template.index')->with('success', 'template deleted.');
        }

    }
}
