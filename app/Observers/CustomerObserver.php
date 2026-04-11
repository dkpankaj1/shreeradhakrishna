<?php

namespace App\Observers;

use App\Models\Customer;
use Illuminate\Support\Facades\Log;

class CustomerObserver
{
    public function created(Customer $customer)
    {
        // // $template = WaTemplate::where(['template_id' => 'welcome_srke'])->first();
        // $template = WaTemplate::where(['template_id' => 'new_welcome'])->first();
        // $whatsappService = new WhatsAppService();
        // $whatsappService->sendNormalText($customerData->phone, $template->template_id);

        // $cunnekt = new CunnektApiService();
        // $cunnekt->sendSimpleNotification($customerData->phone, '1955008095268377');
    }
}
