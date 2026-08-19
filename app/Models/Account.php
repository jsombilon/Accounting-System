<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Account extends Model
{
    protected $fillable = [
        'code',
        'name',
        'description',
        'parent_id',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // ==================== RELATIONSHIPS ====================

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Account::class, 'parent_id')->orderBy('sort_order');
    }

    public function descendants(): HasMany
    {
        return $this->children()->with('descendants');
    }

    public function ancestors(): BelongsTo
    {
        return $this->parent()->with('ancestors');
    }

    // ==================== TYPE ACCESSOR ====================

    /**
     * Get the account type by walking up the parent chain.
     * Type is determined by the top-level account's code prefix:
     * 1 = Asset, 2 = Liability, 3 = Equity, 4 = Income, 5 = Expense
     */
    public function getTypeAttribute(): string
    {
        $current = $this;
        while ($current->parent) {
            $current = $current->parent;
        }

        return $this->getTypeFromCode($current->code);
    }

    private function getTypeFromCode(string $code): string
    {
        $firstDigit = substr($code, 0, 1);

        return match ($firstDigit) {
            '1' => 'asset',
            '2' => 'liability',
            '3' => 'equity',
            '4' => 'income',
            '5' => 'expense',
            default => 'unknown',
        };
    }

    // ==================== OTHER ACCESSORS ====================

    public function getFullPathAttribute(): string
    {
        if ($this->parent) {
            return $this->parent->full_path . ' > ' . $this->name;
        }
        return $this->name;
    }

    public function getDepthAttribute(): int
    {
        if ($this->parent) {
            return $this->parent->depth + 1;
        }
        return 1;
    }

    // ==================== SCOPES ====================

    public function scopeTopLevel($query)
    {
        return $query->whereNull('parent_id');
    }

    public function scopeLeaf($query)
    {
        return $query->whereDoesntHave('children');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // ==================== HELPER METHODS ====================

    public function hasChildren(): bool
    {
        return $this->children()->exists();
    }

    public function isTopLevel(): bool
    {
        return is_null($this->parent_id);
    }

    public function isLeaf(): bool
    {
        return !$this->hasChildren();
    }
}
