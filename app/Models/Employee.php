<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class Employee extends Model implements Authenticatable
{
    use Notifiable;
    use AuthenticableTrait;

    protected $table = 'employees';
    public $timestamps = true;
    private $password;
    private $email;
    private $phone_number;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $dateFormat = 'Y-m-d H:i:s';

    public function getActiveAttribute($active)
    {
        return (bool) $active;
    }
}
