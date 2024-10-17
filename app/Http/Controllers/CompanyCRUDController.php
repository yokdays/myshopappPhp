<?php

namespace App\Http\Controllers;

use App\Models\company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class CompanyCRUDController extends Controller
{
    // Create Index
    public function index(){
        $data['companies'] = Company::orderBy('id', 'desc',)->paginate(5);
        return view('companies.index', $data);
    }

    // Create resource
    public function create(){
        return view('companies.create');
    }

    // Store resource
    public function store(Request $request){
        $file = Storage::disk('public')->put('images', $request->image);
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
        ]);
        $company = new Company;
        $company->name = $request->name;
        $company->email = $request->email;
        $company->address = $request->address;
        $company->image = $file;
        $company->save();
        return redirect()->route('companies.index')->with('success','Company has been created successfully');
    }

    // Sent data for edit
    public function edit(Company $company){
        return view('companies.edit', compact('company'));
    }

    // Update data
    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required'
        ]);
        $company = Company::find($id);
        $company->name = $request->name;
        $company->email = $request->email;
        $company->address = $request->address;
        $company->save();
        return redirect()->route('companies.index')->with('success','Company has been update successfully');
    }

    //Delete data
    public function destroy(Company $company){
        $company->delete();
        return redirect()->route('companies.index')->with('success','Company has been delete successfully');
    }
}
