<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Work extends Model
{
    use HasFactory;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'work_content',
        'comment',
        'date',
        'work_start_time',
        'work_end_time',
        'break_time',
        'status_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
