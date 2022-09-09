<?php

    namespace App;

    use App\Notifications\UserRegistered;
    use Illuminate\Notifications\Notifiable;
    use Illuminate\Contracts\Auth\MustVerifyEmail;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use Illuminate\Support\Facades\Notification;
    use Spatie\Permission\Traits\HasRoles;

    class User extends Authenticatable
    {
        use Notifiable, HasRoles, LogsActivity, CausesActivity;

        protected $fillable = [
            'name', 'email', 'password',
        ];

        protected $hidden = [
            'password', 'remember_token',
        ];

        public static function boot()
        {
            parent::boot();

            static::created(function($model){


            });
        }

        public function blogs()
        {
            return $this->hasMany(Blog::class, 'author_id');
        }
    }
