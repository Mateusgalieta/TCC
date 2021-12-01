<?php

namespace App\Models;

use App\Models\User;
use App\Models\Animal;
use App\Models\Address;
use App\Models\Organization;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rescue extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'reporter', 'animal_name', 'organization_id', 'address_id', 'observations'
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

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }
}
