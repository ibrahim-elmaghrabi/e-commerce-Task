<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StoreResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

     public function checkVatIncluded()
     {
         if($this->vat_included)
            {
                $this->vat_percentage  = ($this->vat_percentage * 100).'%';
            }
            return '00.00';

     }
    public function toArray(Request $request): array
    {
        return [
            'id' => (string)$this->id,
            'name' => $this->name,
            'product include vat' => $this->vat_included ? 'yes' : 'no',
            'vat percentage' => $this->vat_included ? ($this->vat_percentage * 100 ).'%': 00.00,
            'shipping cost' => $this->shipping_cost,
        ];
    }
}
