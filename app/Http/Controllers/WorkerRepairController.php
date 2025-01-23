<?php

namespace App\Http\Controllers;

use App\Models\Repair;
use App\Models\Device;
use App\Models\RepairStatus;
use Illuminate\Http\Request;

class WorkerRepairController extends Controller
{
    /**
     * Display a list of repairs assigned to the authenticated worker.
     */
    public function index()
    {
        // Get repairs assigned to the authenticated worker along with device and status relationships
        $repairs = Repair::where('assigned_to', auth()->user()->id)->with(['device', 'status'])->get();

        return view('worker.repairs.index', compact('repairs'));
    }

    /**
     * Show the form for creating a new repair.
     */
    public function create()
    {
        // Get all devices and statuses for the repair creation form
        $devices = Device::all();
        $statuses = RepairStatus::all();

        return view('worker.repairs.create', compact('devices', 'statuses'));
    }

    /**
     * Store a new repair in the database.
     */
    public function store(Request $request)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'device_id' => 'required|exists:devices,id',
            'status_id' => 'required|exists:repair_statuses,id',
            'description' => 'required|string|max:255',
            'cost' => 'required|numeric|min:0',
        ]);

        try {
            // Create a new repair and assign it to the authenticated worker
            Repair::create([
                'device_id' => $validated['device_id'],
                'status_id' => $validated['status_id'],
                'description' => $validated['description'],
                'cost' => $validated['cost'],
                'assigned_to' => auth()->user()->id, // Assign to the authenticated worker
            ]);

            return redirect()->route('worker.repairs.index')->with('success', 'Repair created successfully.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Error creating repair: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing a specific repair.
     */
    public function edit(Repair $repair)
    {
        // Ensure the repair is assigned to the authenticated worker
        if ($repair->assigned_to !== auth()->user()->id) {
            return redirect()->route('worker.repairs.index')->with('error', 'Unauthorized access to this repair.');
        }

        // Get the available devices and statuses for the edit form
        $devices = Device::all();
        $statuses = RepairStatus::all();

        return view('worker.repairs.edit', compact('repair', 'devices', 'statuses'));
    }

    /**
     * Update a specific repair in the database.
     */
    public function update(Request $request, Repair $repair)
    {
        // Ensure the repair is assigned to the authenticated worker
        if ($repair->assigned_to !== auth()->user()->id) {
            return redirect()->route('worker.repairs.index')->with('error', 'Unauthorized access to this repair.');
        }

        // Validate the incoming data
        $validated = $request->validate([
            'device_id' => 'required|exists:devices,id',
            'status_id' => 'required|exists:repair_statuses,id',
            'description' => 'required|string|max:255',
            'cost' => 'required|numeric|min:0',
        ]);

        try {
            // Update the repair with the new values
            $repair->update([
                'device_id' => $validated['device_id'],
                'status_id' => $validated['status_id'],
                'description' => $validated['description'],
                'cost' => $validated['cost'],
            ]);

            return redirect()->route('worker.repairs.index')->with('success', 'Repair updated successfully.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Error updating repair: ' . $e->getMessage());
        }
    }

/**
 * Remove the specified repair from the database.
 */
public function destroy(Repair $repair)
{
    // Check if the repair belongs to the authenticated worker
    if ($repair->assigned_to != auth()->user()->id) {
        return redirect()->route('worker.repairs.index')->with('error', 'You cannot delete this repair.');
    }

    // Delete the repair
    $repair->delete();

    // Redirect back to the repairs index with a success message
    return redirect()->route('worker.repairs')->with('success', 'Repair deleted successfully.');
}
}