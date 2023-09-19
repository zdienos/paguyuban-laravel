<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    // use Notifiable;

    protected $primaryKey = 'id';


    protected $fillable = [
        'username',
        'full_name',
        'email',
        'password',
        'role'
    ];

    protected $hidden = [
        'password',
    ];

    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    public function role()
    {
        return $this->belongsTo('App\Models\Role','role');
    }


    public function hasRole($roles)
    {
        $this->have_role = $this->getUserRole();
        if(is_array($roles)){
            foreach ($roles as $role) {
                if($this->checkUserRole($role)){
                    return true;
                }
            }
        } else {
            return $this->checkUserRole($roles);
        }
        return false;
    }

    private function getUserRole()
    {
        return $this->role()->getResults();
    }

    private function checkUserRole($role)
    {
        if(isset($this->have_role)){
            return (strtolower($role)==strtolower($this->have_role->name)) ? true : false;
        }
        return false;
    }

    public function isSuperAdmin(){
        if($this->getUserRole()->name=='superadmin'){
            return true;
        } else {
            return false;
        }
    }
}
