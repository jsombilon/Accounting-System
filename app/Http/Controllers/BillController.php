<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;

class BillController extends Controller
{
    public function dashboard()
    {
        return view('transactions.Bill.dashboard');
    }

    public function create()
    {
        $BillNo = 'BILL-' . str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);
        $BillDate = now()->format('Y-m-d');
        $accounts = Account::where('is_active', true)->get()->map(function ($account) {
            return [
                'name' => $account->name,
                'is_active' => $account->is_active,
            ];
        })->values()->all();

        return view('transactions.Bill.create', compact('BillNo', 'BillDate', 'accounts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_details' => ['required', 'array', 'min:1'],
            'category_details.*.account_name' => ['required', 'string', 'max:255'],
            'category_details.*.debit' => ['nullable', 'numeric', 'min:0'],
            'category_details.*.credit' => ['nullable', 'numeric', 'min:0'],
            'category_details.*.remarks' => ['nullable', 'string'],
            'category_details.*.billable' => ['required', 'boolean'],
            'category_details.*.affiliate' => ['nullable', 'string', 'max:255'],
        ]);

        dd($validated);
    }
}
