<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeRequest;
use App\Models\Employee;
use App\Models\Project;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with('project')->paginate(10);
        return view('employees.index', compact('employees'));
    }


    public function create()
    {
        return view('employees.create');
    }

    public function show(Employee $employee)
    {
        $this->authorize('view', $employee->project);
        return view('employees.show', compact('employee'));
    }
    
    public function store(StoreEmployeeRequest $request, Project $project)
    {
        $this->authorize('update', $project);

        $project->employees()->create($request->validated());

        return redirect()->route('projects.show', $project)->with('success', 'Employee added successfully.');
    }

    public function destroy(Project $project, $employeeId)
    {
        $this->authorize('update', $project);

        $employee = $project->employees()->findOrFail($employeeId);
        $employee->delete();

        return redirect()->route('projects.show', $project)->with('success', 'Employee removed successfully.');
    }

    public function edit(Employee $employee)
    {
        $this->authorize('update', $employee->project);
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        $this->authorize('update', $employee->project);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,'.$employee->id,
            'role' => 'nullable|string|max:255',
        ]);

        $employee->update($validated);

        return redirect()->route('projects.show', $employee->project)->with('success', 'Employee updated successfully.');
    }

    

    public function destroyEmployee(Employee $employee)
    {
        $this->authorize('delete', $employee->project);
        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }


}
