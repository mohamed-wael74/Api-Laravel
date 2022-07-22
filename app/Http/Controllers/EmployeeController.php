<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{

    public function index()
    {
        return Employee::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|string",
            "salary" => "required|numeric"
        ]);

        return Employee::create($request->all());;
    }

    public function show($id)
    {
        return Employee::find($id);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "name" => "required|string",
            "salary" => "required|numeric"
        ]);
        $emp = Employee::find($id);
        $emp->update($request->all());
        return $emp;
    }

    public function destroy($id)
    {
        return Employee::destroy($id);
    }
}
