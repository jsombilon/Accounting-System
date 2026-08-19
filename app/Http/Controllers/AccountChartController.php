<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;

class AccountChartController extends Controller
{
    public function coa()
    {
        $accountsTable = $this->buildAccountsTable();
        $accountsJson = $accountsTable->map(function ($account) {
            return [
                'id' => $account->id,
                'code' => $account->code,
                'name' => $account->name,
                'description' => $account->description,
                'parent_id' => $account->parent_id,
                'depth' => $account->depth,
                'is_active' => $account->is_active,
                'root_id' => $this->getRootId($account), // New: top-level ancestor's ID
            ];
        })->values()->toJson();

        return view('coa.dashboard', compact('accountsTable', 'accountsJson'));
    }

    private function getRootId($account)
    {
        $current = $account;
        while ($current->parent_id !== null) {
            $current = Account::find($current->parent_id);
            if (!$current) break;
        }
        return $current ? $current->id : $account->id;
    }

    private function buildAccountsTable($parentId = null): Collection
    {
        $accounts = Account::where('parent_id', $parentId)
            ->orderBy('code')
            ->get();

        $rows = collect();
        foreach ($accounts as $account) {
            $rows->push($account);

            $children = $this->buildAccountsTable($account->id);
            $rows = $rows->merge($children);
        }

        return $rows;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|string|max:50|unique:accounts,code',
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:accounts,id',
            'description' => 'nullable|string|max:1000',
        ], [
            'code.required' => 'Account code is required.',
            'code.unique' => 'This account code already exists.',
            'name.required' => 'Account name is required.',
            'parent_id.exists' => 'Selected parent account is invalid.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $account = Account::create($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Account created successfully!',
                'account' => $account,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create account. Please try again.',
            ], 500);
        }
    }

    public function getTopLevel()
    {
        $accounts = Account::topLevel()
            ->active()
            ->orderBy('code')
            ->get(['id', 'code', 'name']);

        return response()->json($accounts);
    }

    public function getChildren(Account $account)
    {
        $children = $account->children()
            ->active()
            ->orderBy('code')
            ->get(['id', 'code', 'name']);

        return response()->json($children);
    }

    public function getNextCode(Request $request)
    {
        $parentId = $request->input('parent_id');

        if ($parentId === null || $parentId === '') {
            $existingCodes = Account::whereNull('parent_id')
                ->whereRaw('LENGTH(code) = 1')
                ->pluck('code')
                ->map(fn($code) => (int) $code)
                ->toArray();

            $nextCode = 1;
            while (in_array($nextCode, $existingCodes) && $nextCode < 10) {
                $nextCode++;
            }

            if ($nextCode >= 10) {
                return response()->json([
                    'success' => false,
                    'message' => 'Maximum top-level accounts reached.',
                ], 400);
            }

            return response()->json([
                'success' => true,
                'code' => (string) $nextCode,
            ]);
        }

        $parent = Account::find($parentId);
        if (!$parent) {
            return response()->json([
                'success' => false,
                'message' => 'Parent account not found.',
            ], 404);
        }

        $existingCodes = Account::where('parent_id', $parentId)
            ->pluck('code')
            ->toArray();

        $parentCode = $parent->code;
        $suffixes = [];

        foreach ($existingCodes as $code) {
            $suffix = str_replace($parentCode . '-', '', $code);
            if (is_numeric($suffix)) {
                $suffixes[] = (int) $suffix;
            }
        }

        $nextSuffix = 1;
        while (in_array($nextSuffix, $suffixes) && $nextSuffix < 100) {
            $nextSuffix++;
        }

        if ($nextSuffix >= 100) {
            return response()->json([
                'success' => false,
                'message' => 'Maximum children reached.',
            ], 400);
        }

        $formattedSuffix = str_pad($nextSuffix, 2, '0', STR_PAD_LEFT);

        return response()->json([
            'success' => true,
            'code' => $parentCode . '-' . $formattedSuffix,
        ]);
    }
}
