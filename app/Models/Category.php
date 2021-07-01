<?php

namespace App\Models;

use App\Models\User;
use App\Models\Contact;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'user_id'
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
    ];

    /*  Table Relationships  */
    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
