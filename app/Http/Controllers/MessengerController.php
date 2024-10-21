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
        $messengers = Messenger::with(['customer', 'waTemplate'])->latest()->paginate(15);
        return view('massager.index', [
            'messengers' => $messengers
        ]);
    }
    public function create(Request $request)
    {
        $templateId = $request->query('template_id', "");

        $customers = Customer::withCount('purchases')
            // ->orderBy('purchases_count', 'DESC')
            ->orderBy('name', 'ASC')
            ->get();

        $messageTemplate = WaTemplate::where('approve', 1)
            ->where('template_id', $templateId)
            ->first();

        if ($templateId === 'offers_alert') {
            return view('massager.template.offers_alert', ['customers' => $customers, 'messageTemplate' => $messageTemplate]);
        }

        if ($templateId === 'reware_ad') {
            return view('massager.template.reware_ad', ['customers' => $customers, 'messageTemplate' => $messageTemplate]);
        }

        if ($templateId === 'welcome_srke') {
            return view('massager.template.welcome_srke', ['customers' => $customers, 'messageTemplate' => $messageTemplate]);
        }

        if ($templateId === 'wishing_festival') {
            return view('massager.template.wishing_festival', ['customers' => $customers, 'messageTemplate' => $messageTemplate]);
        }

        return abort(404);
    }
    public function store(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:customers,id',
            'template_id' => 'required|exists:wa_templates,template_id',
            'params' => ['nullable', 'array'],
        ]);

        try {
            $mobiles = [];
            $data = [];
            $ids = $request->input('ids');
            $customers = Customer::whereIn('id', $ids)->get();
            $template = WaTemplate::where('template_id', $request->template_id)->first();
            $whatsappService = new WhatsAppService();

            foreach ($customers as $customer) {
                $mobiles[] = $customer->phone;
            }

            if ($template->has_param === 1) {
                $whatsappService->sendTextWithParams($mobiles, $request->template_id, $request->params);
            } else {
                $whatsappService->sendNormalText($mobiles, $request->template_id);
            }

            foreach ($customers as $customer) {
                $data[] = [
                    'customer_id' => $customer->id,
                    'wa_template_id' => $template->id,
                    'attachment' => '',
                    'status' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            Messenger::insert($data);

            return redirect()->route('messenger.index')->with('success', 'message sending in queue,');
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', $e->getMessage());
        }

    }

}
