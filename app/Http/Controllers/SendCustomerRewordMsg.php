<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Messenger;
use App\Models\WaTemplate;
use App\Services\WhatsAppService;
use Illuminate\Http\Request;

class SendCustomerRewordMsg extends Controller
{
    public function send(Request $request)
    {
        $request->validate(['customer_id' => 'required|exists:customers,id', 'reword' => "required"]);
        $whatsappService = new WhatsAppService();
        $customer = Customer::find($request->customer_id);

        try {
            $whatsappService->sendNormalText($customer->phone, "winning_reward");
            $whatsappService->sendTextWithParams(
                $customer->phone,
                'winning_reward',
                [$customer->name, $request->reword]
            );
            $waTemplate = WaTemplate::where('template_id', 'winning_reward')->first();
            $data = [
                'customer_id' => $customer->id,
                'wa_template_id' => $waTemplate->id,
                'attachment' => '',
                'status' => 1,
            ];
            Messenger::create($data);

            return back()->with('success', 'Message send Success');
        } catch (\Exception $e) {
            return back()->with('danger', $e->getMessage());
        }

    }
}
