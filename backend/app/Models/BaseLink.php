<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;

class BaseLink extends Model{
    use Authenticatable, Authorizable;


    protected  $fillable =[
        'name',
        'link',
        'clicks',
        'max_clicks',
        'user_id'
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function Childs (){
        return $this->hasMany(ChildLink::class, 'base_id');
    }
}