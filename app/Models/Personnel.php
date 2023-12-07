<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Contracts\Auth\Authenticatable;
    use Illuminate\Notifications\Notifiable;

    class Personnel extends Model implements Authenticatable
    {
        use HasFactory;use Notifiable;
        public function getAuthIdentifierName()
        {
            return 'id'; // Replace with the primary key column name
        }

        public function getAuthIdentifier()
        {
            return $this->getKey();
        }

        public function getAuthPassword()
        {
            return $this->password;
        }

        public function getRememberToken()
        {
            return $this->remember_token;
        }

        public function setRememberToken($value)
        {
            $this->remember_token = $value;
        }

        public function getRememberTokenName()
        {
            return 'remember_token';
        }
        protected $fillable = [
            'name',
            'email',
            'password',
            'role',
            'status',
        ];

        protected $hidden = [
            'password',
        ];
    }
