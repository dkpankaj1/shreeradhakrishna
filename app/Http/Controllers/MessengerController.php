<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Messenger;
use App\Models\WaTemplate;
use App\Services\WhatsAppService;
use Illuminate\Http\Request;

class MessengerController extends Controller
{
    public function index(Request $request)
    {
        $messengers = Messenger::with(['customer','waTemplate'])->latest()->paginate(20);
        return view('massager.index', [
            'messengers' => $messengers
        ]);
    }
    public function create(Request $request)
    {
        $customers = Customer::withCount('purchases')
            ->orderBy('purchases_count', 'DESC')
            ->orderBy('name', 'ASC')
            ->get();
        $messageTemplates = WaTemplate::select(['id', 'template_id'])->get();
        return view('massager.create', ['customers' => $customers, 'messageTemplates' => $messageTemplates]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:customers,id',
            'template_id' => 'required|exists:wa_templates,id'
        ]);
        try {
            $status = [];

            $ids = $request->input('ids');
            $customers = Customer::whereIn('id', $ids)->get();
            $template = WaTemplate::find($request->template_id);

            foreach ($customers as $customer) {
                $msg = new Messenger();
                $msg->customer_id = $customer->id;
                $msg->wa_template_id = $request->template_id;
                $msg->attachment = "";
                $msg->save();

                $whatsappService = new WhatsAppService();
                $status[] = $whatsappService->sendNormalText($customer->phone, $template->template_id);

            }
            return redirect()->route('messenger.index')->with('success', 'message sending in queue,');
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', $e->getMessage());
        }
    }
}
