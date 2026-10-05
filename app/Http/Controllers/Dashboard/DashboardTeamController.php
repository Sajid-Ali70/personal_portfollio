<?php
// app/Http/Controllers/Admin/TeamController.php
namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardTeamController extends Controller
{
    public function index()
    {
        $teams = DB::table('teams')->orderBy('id', 'desc')->paginate(10);
        return view('dashboard.team.index', compact('teams'));
    }

    public function create()
    {
        return view('dashboard.team.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName(); // unique name
            $file->move(public_path('uploads/team'), $filename);       // move to public/uploads/team
            $photoPath = 'uploads/team/' . $filename;                 // save path in DB
        }

        DB::table('teams')->insert([
            'name' => $request->name,
            'role' => $request->role,
            'photo' => $filename,
            'description' => $request->description,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('dashboard.team.index')->with('success', 'Team member added successfully');
    }

    public function edit($id)
    {
        $team = DB::table('teams')->where('id', $id)->first();
        return view('dashboard.team.edit', compact('team'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
        ]);

        $team = DB::table('teams')->where('id', $id)->first();
        $filename = $team->photo;

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName(); // unique name
            $file->move(public_path('uploads/team'), $filename);       // move to public/uploads/team
            $photoPath = 'uploads/team/' . $filename;  
        }

        DB::table('teams')->where('id', $id)->update([
            'name' => $request->name,
            'role' => $request->role,
            'photo' => $filename,
            'description' => $request->description,
            'updated_at' => now(),
        ]);

        return redirect()->route('dashboard.team.index')->with('success', 'Team member updated successfully');
    }

    public function destroy($id)
    {
        DB::table('teams')->where('id', $id)->delete();
        return redirect()->route('dashboard.team.index')->with('success', 'Team member deleted successfully');
    }
}