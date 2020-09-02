<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function comment()
    {
       return $this->hasMany(Comment::class, 'user_id_wall', 'id')->orderBy('created_at', 'DESC');
    }

    public static function getUserData(Int $id)
    {
        $user = User::find($id);
      
        for ($i=0; $i < count($user->comment); $i++) { 
            if (($id === Auth::user()->id) || ($user->comment[$i]->author_user_id === Auth::user()->id)) 
            {
                $user->comment[$i]->buttonDelete = true;
            }
            else
            {
                $user->comment[$i]->buttonDelete = false;
            }
            
            

        }
        
        
        //dd($user->comment);
        return $user;
        
    }
}
