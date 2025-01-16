<?php

namespace App\Http\Controllers;

use App\Models\Repair;
use Illuminate\Http\Request;

class WorkerRepairController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:worker');
    }

    public function index()
    {
        $repairs = Repair::where('worker_id', auth()->user()->id)->get();

        return view('worker.repairs.index', compact('repairs'));
    }
}
