<?php

namespace App\Models;

use App\Models\User;
use App\Models\Phone;
use App\Models\Address;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use Notifiable, SoftDeletes;


     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'created_by', 'avatar_url', 'category_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
    ];

    /**
     * The attributes that should be dates
     *
     * @var array
     */
    protected $dates = [
        'deleted_at', 'created_at'
    ];

     /*  Table Relationships  */
     public function user()
     {
         return $this->belongsTo(User::class, 'created_by');
     }

     public function category()
     {
         return $this->belongsTo(Category::class);
     }

     public function phones()
     {
         return $this->hasMany(Phone::class);
     }

     public function addresses()
     {
         return $this->hasMany(Address::class);
     }

}
