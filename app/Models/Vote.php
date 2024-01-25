<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;
    protected $table = 'votes';

    protected $fillable = [
      'id',
      'user_id',
      'feedback_id',
      'is_like',
    ];

    
    public function user() {
      return $this->belongsTo(User::class, 'user_id');
    }

    public function feedback() {
      return $this->belongsTo(Feedback::class, 'feedback_id');
    }
}
