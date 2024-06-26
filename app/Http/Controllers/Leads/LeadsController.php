<?php

namespace App\Http\Controllers\Leads;

use App\Enums\Leads\InspetionTypes;
use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeResource;
use App\Http\Resources\Leads\LeadResource;
use App\Models\Employee;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

class LeadsController extends Controller
{
    private function rules()
    {
        return [
            'number' => ["required", "numeric"],
            'employee_id' => ["nullable", "exists:employees,id"],
            'date_sale' => ["nullable", "date"],
            'date_sale_term' => ["nullable", "date"],
            'date_sent_documents' => ["nullable", "date"],
            'date_sent_documents_actual' => ["nullable", "date"],
            'date_inspection' => ["nullable", "date"],
            'date_inspection_actual' => ["nullable", "date"],
            'date_remeasurement' => ["nullable", "date"],
            'date_remeasurement_actual' => ["nullable", "date"],
            'date_start' => ["nullable", "date"],
            'date_start_actual' => ["nullable", "date"],
            'inspection_types' => ["nullable", "array"],
            'inspection_types.*' => [new Enum(InspetionTypes::class)],
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leads = Lead::where('user_id', auth()->id())
            ->orderByDesc('id')
            ->paginate(30);

        return LeadResource::collection($leads);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::where('user_id', auth()->id())
            ->orderBy('lastname')
            ->limit(20)
            ->get();

        return response()->json([
            'employees' => EmployeResource::collection($employees),
            'inspections' => InspetionTypes::options(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate($this->rules());

        $lead = new Lead;
        $lead->fill($data);
        $lead->user_id = $request->user()->id ?? null;
        $lead->save();

        return new LeadResource($lead);
    }

    /**
     * Display the specified resource.
     */
    public function show(Lead $lead)
    {
        return new LeadResource($lead);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lead $lead)
    {
        $employees = Employee::where('user_id', auth()->id())
            ->orderBy('lastname')
            ->limit(20)
            ->get();

        if ($lead->employee) {
            $employees->prepend($lead->employee);
        }

        return response()->json([
            'lead' => new LeadResource($lead),
            'employees' => EmployeResource::collection($employees->unique('id')->values()),
            'inspections' => InspetionTypes::options(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lead $lead)
    {
        $data = $request->validate($this->rules());

        $lead->fill($data);
        $lead->save();

        return new LeadResource($lead->refresh());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
