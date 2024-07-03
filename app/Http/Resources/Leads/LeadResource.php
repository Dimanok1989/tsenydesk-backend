<?php

namespace App\Http\Resources\Leads;

use App\Enums\Leads\InspetionTypes;
use App\Http\Resources\EmployeResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LeadResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'number' => $this->number,
            'employee_id' => $this->employee_id,
            'employee' => $this->employee ? new EmployeResource($this->employee) : null,
            'date_inspection' => $this->date_inspection,
            'date_inspection_actual' => $this->date_inspection_actual,
            'dismantling_date' => $this->dismantling_date,
            'dismantling_employee_id' => $this->dismantling_employee_id,
            'dismantling_employee' => $this->dismantling_employee ? new EmployeResource($this->dismantling_employee) : null,
            'dismantling_comment' => $this->dismantling_comment,
            'date_sale' => $this->date_sale,
            'date_sale_term' => $this->date_sale_term,
            'days_sale_term' => $this->date_sale_term > now() ? ceil(now()->diffInDays($this->date_sale_term)) : null,
            'date_sent_documents' => $this->date_sent_documents,
            'date_sent_documents_actual' => $this->date_sent_documents_actual,
            'date_start' => $this->date_start,
            'date_start_actual' => $this->date_start_actual,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'inspection_types' => $this->inspection_types ?: [],
            'inspections' => collect($this->inspection_types ?: [])
                ->filter(fn ($item) => is_bool($item))
                ->map(fn ($item, $key) => [
                    'title' => InspetionTypes::tryFrom($key)?->name() ?? null,
                    'value' => match ($item) {
                        true => "Да",
                        false => "Нет",
                        default => null,
                    },
                    'color' => match ($item) {
                        true => "green",
                        false => "orange",
                        default => "gray",
                    },
                ])
                ->filter()
                ->sort()
                ->values()
                ->all(),
            'remeasurements' => $this->remeasurements_resource,
        ];
    }
}
