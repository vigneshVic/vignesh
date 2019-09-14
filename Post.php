<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\DefaultTrait;

class Post extends Model
{
	use SoftDeletes, DefaultTrait;
	
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'title', 'description', 'status', 'deleted_at', 'created_by', 'updated_by', 'deleted_by'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function comments() {
        return $this->morphMany('App\Comment', 'commentable');
    }
}
