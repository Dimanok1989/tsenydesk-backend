<?php

namespace App\Http\Controllers;

use App\Http\Resources\EmployeResource;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeesContoller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Display a listing of the resource.
     */
    public function search(Request $request)
    {
        $employees = Employee::query()
            ->where('user_id', $request->user()->id ?? null)
            ->when(!empty($request->search), function ($query) use ($request) {
                $query->where(function ($query) use ($request) {
                    $query->where('lastname', 'ilike', "%{$request->search}%")
                        ->orWhere('name', 'ilike', "%{$request->search}%")
                        ->orWhere('patronymic', 'ilike', "%{$request->search}%");
                });
            })
            ->orderBy('lastname')
            ->paginate(20);

        return EmployeResource::collection($employees);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'lastname' => ["required", "string", "max:100"],
            'name' => ["nullable", "string", "max:100"],
            'patronymic' => ["nullable", "string", "max:100"],
        ]);

        $employee = new Employee;
        $employee->fill($data);
        $employee->user_id = $request->user()->id ?? null;
        $employee->save();

        return new EmployeResource($employee->refresh());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
