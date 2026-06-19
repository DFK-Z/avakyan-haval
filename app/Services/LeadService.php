<?php

namespace App\Services;

use App\Enums\LeadStatus;
use App\Models\Lead;
use App\Models\User;
use App\Notifications\NewLeadNotification;
use Illuminate\Support\Facades\Notification;

class LeadService
{
    /**
     * @param  array<string, mixed>  $data
     */
    public function create(array $data): Lead
    {
        $lead = Lead::query()->create([
            ...$data,
            'status' => LeadStatus::New,
        ]);

        $admins = User::query()->get();

        if ($admins->isNotEmpty()) {
            Notification::send($admins, new NewLeadNotification($lead));
        }

        return $lead;
    }
}
