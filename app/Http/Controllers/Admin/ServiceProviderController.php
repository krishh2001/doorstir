<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServiceProvider;

class ServiceProviderController extends Controller
{
    public function index()
    {
        $providers = ServiceProvider::latest()->get();
        return view('admin.service_provider.index', compact('providers'));
    }

    public function create()
    {
        return view('admin.service_provider.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|unique:service_providers,email',
            'phone'   => 'required|string|max:20',
            'service' => 'required|string|max:255',
        ]);

        $validated['status'] = $request->has('status') ? 1 : 0;

        ServiceProvider::create($validated);

        return redirect()->route('admin.service_provider.index')->with('success', 'Service Provider Created Successfully!');
    }

    public function edit($id)
    {
        $provider = ServiceProvider::findOrFail($id);
        return view('admin.service_provider.edit', compact('provider'));
    }

    public function update(Request $request, $id)
    {
        $provider = ServiceProvider::findOrFail($id);

        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|unique:service_providers,email,' . $id,
            'phone'   => 'required|string|max:20',
            'service' => 'required|string|max:255',
        ]);

        $validated['status'] = $request->has('status') ? 1 : 0;

        $provider->update($validated);

        return redirect()->route('admin.service_provider.index')->with('success', 'Service Provider Updated Successfully!');
    }

    public function view($id)
    {
        $provider = ServiceProvider::findOrFail($id);
        return view('admin.service_provider.view', compact('provider'));
    }

    public function destroy(ServiceProvider $provider)
    {
        $provider->delete();
        return redirect()->route('admin.service_provider.index')
                         ->with('success', 'Service Provider deleted successfully!');
    }
   
   
    public function toggleStatus($id)
{
    $provider = ServiceProvider::findOrFail($id);
    $provider->status = !$provider->status;
    $provider->save();

    return response()->json(['message' => 'Status updated successfully']);
}

}
