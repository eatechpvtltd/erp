<?php

namespace App;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Zizaco\Entrust\Entrust;
use Zizaco\Entrust\Traits\EntrustUserTrait;

use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Contracts\UserResolver;

class User extends Authenticatable implements AuditableContract
{
    //use HasApiTokens, Notifiable, EntrustUserTrait, Auditable;
    use HasApiTokens, Notifiable, EntrustUserTrait, Auditable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','last_login_at','last_login_ip', 'profile_image', 'contact_number', 'address',  'role_id', 'hook_id', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function userRole()
    {
        return $this->belongsToMany(Role::class);
    }

    public function userRoleId()
    {
        return $this->hasone(Entrust::class);
    }

    public function getStatusAttribute($value)
    {
        return $value == 1?'active':'in-active';
    }

    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = $value == 'active'?1:0;
    }


    //activity tracking
    public static function resolveId()
    {
        return Auth::check() ? Auth::user()->getAuthIdentifier() : null;
    }




}
