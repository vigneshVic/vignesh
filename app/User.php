<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;
use App\Traits\DefaultTrait;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, HasRoles, DefaultTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'userType', 'status', 'deleted_at', 'created_by', 'updated_by', 'deleted_by'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    // protected $casts = [
    //     'deleted_at' => 'datetime',
    // ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at'
    ];

    /**
     * The number of models to return for pagination.
     *
     * @var  int
     */
    protected $perPage = 5;

    /**
     * Set the user's first name.
     *
     * @param  string  $value
     * @return void
     */
    public function setPasswordAttribute($password) {
        $this->attributes['password'] = bcrypt($password);
    }

     /**
     * get the user's Mutators
     *
     * @param  string  $value
     * @return string
     */
    public function getStatusAttribute($value) {
        return $value === 1 ? 'Active' : 'InActive';
    }

    /**
     * Scope check
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeIsAdmin() {
        return $this->userType === 1;
    }

    public function scopeIsUser() {
        return $this->userType === 2;
    }

    /**
     * Scope a query
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query) {
        return $query->where('status', 1);
    }

    public function scopeUsers($query) {
        return $query->where('userType', 2);
    }

    public function scopeAdmin($query) {
        return $query->where('userType', 1);
    }

    /**
     * Add post
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function addPost($fields) {
        return $this->posts()->create($fields);
    }

    /**
     * Eloquent's
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function posts() {
        return $this->hasMany('App\Post');
    }

    public function comments() {
        return $this->hasMany('App\Comment');
    }
}
