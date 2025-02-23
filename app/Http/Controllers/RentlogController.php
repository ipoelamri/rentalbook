<?php

namespace App\Http\Controllers;

use App\Models\book;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RentLog;
use Carbon\Carbon;




class RentlogController extends Controller
{
    public function index()
    {
        $rentLogs = RentLog::all();
        return view('rentlogs', compact('rentLogs'));
    }

    public function create(book $book)
    {
        return view('borrow', compact('book'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'return_date' => 'required|date|after:today|before_or_equal:' . now()->addDays(7)->format('Y-m-d'),
        ]);

        $rentLog = RentLog::create([
            'user_id' => Auth::id(),
            'book_id' => $request->book_id,
            'rent_code' => strtoupper(Str::random(10)),
            'rent_date' => now(),  // Menyertakan rent_date dengan nilai sekarang
            'return_date' => $request->return_date,
            'status' => 'On Process',
        ]);

        return redirect()->route('rent.receipt', ['rentLog' => $rentLog->id]);
    }
    public function receipt(RentLog $rentLog)
    {
        return view('receipt', compact('rentLog'));
    }

    public function confirm(RentLog $rentLog)
    {
        $rentLog->update(['status' => 'Ready']);
        return back()->with('success', 'Peminjaman dikonfirmasi');
    }
    public function returned($id)
    {
        $log = RentLog::findOrFail($id);
        $log->status = 'Completed';
        $log->save();

        return redirect()->back()->with('success', 'Status updated to Done');
    }
}
