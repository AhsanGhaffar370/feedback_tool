<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;
    
    // table name to be used
    protected $table = 'feedbacks';

    // columns to be allowed in mass-assingment 
    protected $fillable = ['user_id', 'title', 'description', 'category_id', 'status_id'];



    public function user() {
    	return $this->belongsTo(User::class, 'user_id');
    }
    
    public function category() {
    	return $this->belongsTo(Category::class, 'category_id');
    }

    public function status() {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function comments()
    {
    	return $this->hasMany(Comment::class, 'feedback_id');
    }

    public function votes()
    {
    	return $this->hasMany(Vote::class, 'feedback_id');
    }

    public function vote_up_count()
    {
    	return $this->votes->where('is_like', 1)->count();
    }

    public function vote_down_count()
    {
    	return $this->votes->where('is_like', 0)->count();
    }

}
