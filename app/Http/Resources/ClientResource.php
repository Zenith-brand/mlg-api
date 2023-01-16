<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'ref_number' => $this->ref_number,
            'address' => $this->addresses,
            // 'address' => $this->addresses,
            // 'postcode' => $this->postcode,
            // 'country' => $this->country,
            // 'region' => $this->region,
            // 'area' => $this->area,
            'tel_number' => $this->tel_number,
            'fax_number' => $this->ref_number,
            'date_registered' => $this->date_registered,
            'sector' => $this->sector,
            'clients_status' => $this->clients_status,
            'notes' => $this->notes,
            'word' => $this->word,
            'sms' => $this->sms,
            'notes' => $this->notes,
            'consultant' => $this->consultant,
            'devision' => $this->devision,
            'last_contact_log' => $this->last_contact_log,
            'date_registered' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at,
            'timesheet' => $this->timesheets,
          ];
    }
}
