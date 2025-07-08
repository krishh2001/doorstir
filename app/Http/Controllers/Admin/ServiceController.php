<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Category;

class ServiceController extends Controller
{
    // Display all services
    public function index()
    {
        $services = Service::latest()->get();
        return view('admin.services.index', compact('services'));
    }

    // Show create form
    public function create()
{
    $categories = Category::all();
    return view('admin.services.create', compact('categories'));
}

    // Store new service
    public function store(Request $request)
    {
       $request->validate([
    'name' => 'required|string',
    'category_id' => 'required|exists:categories,id',
    'price' => 'required|numeric|min:0',
]);


Service::create($request->only('name', 'category_id', 'price'));


        return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
    }

    // Show edit form
   public function edit($id)
{
    $service = Service::findOrFail($id);
    $categories = Category::all();
    return view('admin.services.edit', compact('service', 'categories'));
}


    // Update service
    public function update(Request $request, $id)
    {
       $request->validate([
    'name' => 'required|string',
    'category_id' => 'required|exists:categories,id',
    'price' => 'required|numeric|min:0',
]);

$service = Service::findOrFail($id);
$service->update($request->only('name', 'category_id', 'price'));


        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    // View single service
    public function view($id)
    {
        $service = Service::findOrFail($id);
        return view('admin.services.view', compact('service'));
    }

    // Delete service
     public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'Service Deleted successfully!');
    }
}
