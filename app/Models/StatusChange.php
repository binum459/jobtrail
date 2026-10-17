<?php

namespace App\Models;
use App\Enums\ApplicationStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StatusChange extends Model
{
    protected $fillable = ['application_id','from_status','to_status','changed_at'];

    protected function casts():array
    {
        return['from_status' => ApplicationStatus::class,
        'to_status' => ApplicationStatus::class,
        'changed_at' => 'datetime'];
    }

    public function application(): BelongsTo
{
    return $this->belongsTo(Application::class);
}
}
