<?php

namespace App\Http\Controllers;

use App\Models\Repair;
use App\Models\Device;
use App\Models\RepairStatus;
use Illuminate\Http\Request;

class AdminRepairController extends Controller
{
    /**
     * Display a listing of repairs.
     */
    public function index()
    {
        \Log::info('Admin Repair Index accessed');
        $repairs = Repair::with(['device', 'status'])->paginate(10);
        return view('admin.repairs.index', compact('repairs'));
    }

    /**
     * Show the form for creating a new repair.
     */
    public function create()
    {
        $devices = Device::all();
        $statuses = RepairStatus::all();
        return view('admin.repairs.create', compact('devices', 'statuses'));
    }

    /**
     * Store a newly created repair in the database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'device_id' => 'required|exists:devices,id',
            'status_id' => 'required|exists:repair_statuses,id',
            'description' => 'required|string|max:255',
            'cost' => 'required|numeric|min:0',
        ]);

        try {
            Repair::create($validated);
            return redirect()->route('admin.repairs.index')->with('success', 'Repair created successfully.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Error creating repair: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified repair.
     */
    public function show(Repair $repair)
    {
        $repair->load(['device', 'status']); // Ensure related data is loaded
        return view('admin.repairs.show', compact('repair'));
    }

    /**
     * Show the form for editing the specified repair.
     */
    public function edit(Repair $repair)
    {
        $devices = Device::all();
        $statuses = RepairStatus::all();
        return view('admin.repairs.edit', compact('repair', 'devices', 'statuses'));
    }

    /**
     * Update the specified repair in the database.
     */
    public function update(Request $request, Repair $repair)
    {
        $validated = $request->validate([
            'device_id' => 'required|exists:devices,id',
            'status_id' => 'required|exists:repair_statuses,id',
            'description' => 'required|string|max:255',
            'cost' => 'required|numeric|min:0',
        ]);

        try {
            $repair->update($validated);
            return redirect()->route('admin.repairs.index')->with('success', 'Repair updated successfully.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Error updating repair: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified repair from the database.
     */
    public function destroy(Repair $repair)
    {
        try {
            $repair->delete();
            return redirect()->route('repairs.index')->with('success', 'Repair deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('repairs.index')->with('error', 'Error deleting repair: ' . $e->getMessage());
        }
    }
}
