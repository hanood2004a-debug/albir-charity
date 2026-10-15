<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'title_ar', 'description', 'description_ar', 'image',
        'goal_amount', 'raised_amount', 'status', 'start_date', 'end_date', 'created_by',
    ];

    protected $casts = [
        'goal_amount' => 'decimal:2',
        'raised_amount' => 'decimal:2',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function donations(): HasMany
    {
        return $this->hasMany(Donation::class);
    }

    public function volunteerOpportunities(): HasMany
    {
        return $this->hasMany(VolunteerOpportunity::class);
    }

    // نسبة إنجاز الهدف المالي (تستخدم بالواجهة لعرض progress bar)
    public function getProgressPercentAttribute(): float
    {
        if ((float) $this->goal_amount <= 0) {
            return 0;
        }

        return min(100, round(((float) $this->raised_amount / (float) $this->goal_amount) * 100, 1));
    }
}
