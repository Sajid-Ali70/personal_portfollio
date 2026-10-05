<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class DashboardServiceController extends Controller
{
    // Show all services
    public function index()
    {
        $services = DB::table('services')->orderBy('id', 'desc')->paginate(10);
        return view('dashboard.services.index', compact('services'));
    }

    // Show create form
    public function create()
    {
        return view('dashboard.services.create');
    }

    // Store new service
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048', // proper image validation
            'description' => 'nullable|string',
        ]);

        $filename = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/services'), $filename);
        }

        DB::table('services')->insert([
            'title' => $request->title,
            'image' => $filename,
            'description' => $request->description,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('dashboard.services.index')->with('success', 'Service added successfully');
    }

    // Show edit form
    public function edit($id)
    {
        $service = DB::table('services')->where('id', $id)->first();
        return view('dashboard.services.edit', compact('service'));
    }

    // Update service
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // optional on update
            'description' => 'nullable|string',
        ]);

        $service = DB::table('services')->where('id', $id)->first();
        $filename = $service->image; // keep existing if no new file

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/services'), $filename);
        }

        DB::table('services')->where('id', $id)->update([
            'title' => $request->title,
            'image' => $filename,
            'description' => $request->description,
            'updated_at' => now(),
        ]);

        return redirect()->route('dashboard.services.index')->with('success', 'Service updated successfully');
    }

    // Delete service
    public function destroy($id)
    {
        // Optionally, delete the image file from server
        $service = DB::table('services')->where('id', $id)->first();
        if ($service && $service->image && file_exists(public_path('uploads/services/' . $service->image))) {
            unlink(public_path('uploads/services/' . $service->image));
        }

        DB::table('services')->where('id', $id)->delete();

        return redirect()->route('dashboard.services.index')->with('success', 'Service deleted successfully');
    }
}