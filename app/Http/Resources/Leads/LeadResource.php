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
            'date_remeasurement' => $this->date_remeasurement,
            'date_remeasurement_actual' => $this->date_remeasurement_actual,
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
                ->map(
                    fn ($item, $key) => trim((InspetionTypes::tryFrom($key)?->name() ?? "")
                        . " "
                        . match ($item) {
                            true => "Да",
                            false => "Нет",
                            default => "",
                        })
                )
                ->filter()
                ->sort()
                ->values()
                ->all(),
            'remeasurements' => $this->remeasurements_resource,
        ];
    }
}
