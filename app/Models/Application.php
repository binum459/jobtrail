<?php

namespace App\Models;
use App\Enums\ApplicationStatus;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = ['company_name','job_role','location','salary','job_source','job_url','applied_on','status','position','notes'];

   
    protected function casts():array
    {
        return ['applied_on' => 'date','status'=> ApplicationStatus::class];
    }
}
