<?php

namespace App\Http\Controllers;

use App\Models\VehiclePlate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VehiclePlateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    // Scanner Interface
    public function index()
    {
        return view('vehicle-scanner.index');
    }
    
    // Scan Plate API
    public function scan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'plate_number' => 'required|string|max:20',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }
        
        $plate_number = strtoupper(trim($request->plate_number));
        $plate = VehiclePlate::where('plate_number', $plate_number)->first();
        
        if ($plate) {
            $plate->update([
                'scanned_at' => now(),
                'scanned_by' => auth()->user()->name
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Vehicle found in database',
                'is_new' => false,
                'data' => $plate
            ]);
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Vehicle not found. You can add it manually.',
            'is_new' => true,
            'plate_number' => $plate_number
        ]);
    }
    
    // Store new plate
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'plate_number' => 'required|string|max:20|unique:vehicle_plates,plate_number',
            'owner_name' => 'nullable|string|max:255',
            'owner_phone' => 'nullable|string|max:20',
            'vehicle_type' => 'nullable|string|max:50',
            'status' => 'required|in:active,stolen,expired,suspended'
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        VehiclePlate::create([
            'plate_number' => strtoupper($request->plate_number),
            'owner_name' => $request->owner_name,
            'owner_phone' => $request->owner_phone,
            'owner_email' => $request->owner_email,
            'address' => $request->address,
            'vehicle_type' => $request->vehicle_type,
            'color' => $request->color,
            'make' => $request->make,
            'model' => $request->model,
            'year' => $request->year,
            'status' => $request->status,
            'notes' => $request->notes,
            'scanned_by' => auth()->user()->name
        ]);
        
        return redirect()->route('dashboard.vehicle.plates.list')
            ->with('success', 'Vehicle plate added successfully!');
    }
    
    // List all plates
    public function list(Request $request)
    {
        $query = VehiclePlate::query();
        
        if ($request->search) {
            $query->where('plate_number', 'LIKE', "%{$request->search}%")
                  ->orWhere('owner_name', 'LIKE', "%{$request->search}%")
                  ->orWhere('owner_phone', 'LIKE', "%{$request->search}%");
        }
        
        if ($request->status && $request->status != 'all') {
            $query->where('status', $request->status);
        }
        
        $plates = $query->orderBy('created_at', 'desc')->paginate(15);
        
        return view('vehicle-scanner.list', compact('plates'));
    }
    
    // Show edit form
    public function edit($id)
    {
        $plate = VehiclePlate::findOrFail($id);
        return view('vehicle-scanner.edit', compact('plate'));
    }
    
    // Update plate
    public function update(Request $request, $id)
    {
        $plate = VehiclePlate::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'owner_name' => 'nullable|string|max:255',
            'owner_phone' => 'nullable|string|max:20',
            'vehicle_type' => 'nullable|string|max:50',
            'status' => 'required|in:active,stolen,expired,suspended'
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        $plate->update($request->all());
        
        return redirect()->route('dashboard.vehicle.plates.list')
            ->with('success', 'Vehicle plate updated successfully!');
    }
    
    // Delete plate
    public function destroy($id)
    {
        $plate = VehiclePlate::findOrFail($id);
        $plate->delete();
        
        return redirect()->route('dashboard.vehicle.plates.list')
            ->with('success', 'Vehicle plate deleted successfully!');
    }
    
    // Get recent scans (for AJAX)
    public function recentScans()
    {
        $recentScans = VehiclePlate::orderBy('scanned_at', 'desc')
            ->limit(10)
            ->get();
            
        $html = view('vehicle-scanner.recent_scans', compact('recentScans'))->render();
        
        return response()->json(['html' => $html]);
    }
    
    // Dashboard stats
    public function dashboard()
    {
        $totalPlates = VehiclePlate::count();
        $activePlates = VehiclePlate::where('status', 'active')->count();
        $stolenPlates = VehiclePlate::where('status', 'stolen')->count();
        $scannedToday = VehiclePlate::whereDate('scanned_at', today())->count();
        $recentScans = VehiclePlate::orderBy('scanned_at', 'desc')->limit(10)->get();
        
        return view('vehicle-scanner.dashboard', compact(
            'totalPlates', 'activePlates', 'stolenPlates', 
            'scannedToday', 'recentScans'
        ));
    }
}