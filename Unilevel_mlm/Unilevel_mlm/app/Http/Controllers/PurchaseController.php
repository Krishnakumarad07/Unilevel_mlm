<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Services\CommissionService;

class PurchaseController extends Controller
{
    protected $commissionService;

    public function __construct(CommissionService $commissionService)
    {
        $this->commissionService = $commissionService;
    }

    // Show demo purchase form
    public function create()
    {
        return view('purchase');
    }

    // Handle purchase
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        $user = auth()->user(); // logged-in user
        $amount = $request->amount;

        // Here you can save purchase details in 'purchases' table (optional)
        // Purchase::create([...]);

        // Distribute commissions
        $this->commissionService->distribute($user->id, $amount);

        return redirect()->back()->with('success', 'Purchase successful and commissions distributed!');
    }
}
