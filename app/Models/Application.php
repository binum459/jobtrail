<?php

namespace App\Models;

use App\Enums\ApplicationStatus;
use App\Observers\ApplicationObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[ObservedBy([ApplicationObserver::class])]
class Application extends Model
{
    use HasFactory;

    protected $fillable = ['company_name', 'job_role', 'location', 'salary', 'job_source', 'job_url', 'applied_on', 'status', 'position', 'notes'];

    protected function casts(): array
    {
        return ['applied_on' => 'date', 'status' => ApplicationStatus::class];
    }

    public function statusChanges(): HasMany
    {
        return $this->hasMany(StatusChange::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
