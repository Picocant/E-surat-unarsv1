<?php

namespace App\Models;

use App\Traits\UUIDPrimaryKey;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, UUIDPrimaryKey;

    const ROLE_KEPALA_TU = 'Super Admin ';
    const ROLE_LP2M = 'LP2M';
    const ROLE_BIRO_1 = 'Biro 1';
    const ROLE_BIRO_2 = 'Biro 2';
    const ROLE_BIRO_3 = 'Biro 3';
    const ROLES = [
        self::ROLE_KEPALA_TU,
        self::ROLE_LP2M,
        self::ROLE_BIRO_1,
        self::ROLE_BIRO_2,
        self::ROLE_BIRO_3,
    ];

    const GENDER_MALE = 'Laki-laki';
    const GENDER_FEMALE = 'Perempuan';
    const GENDERS = [
        self::GENDER_MALE,
        self::GENDER_FEMALE,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'position_id',
        'email',
        'password',
        'is_active',
        'role',
        'name',
        'nip',
        'date_of_bird',
        'gender',
        'address',
        'avatar'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_active' => 'boolean',
        'date_of_bird' => 'date',
    ];

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function given_sppd_letters()
    {
        return $this->hasMany(SppdLetter::class, 'from_user_id');
    }

    public function received_sppd_letters()
    {
        return $this->hasMany(SppdLetterRecipient::class, 'user_id');
    }

    public function leave_permit_letters()
    {
        return $this->hasMany(LeavePermitLetter::class);
    }

    public function school_documents()
    {
        return $this->hasMany(SchoolDocument::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function verifyPassword($password)
    {
        return Hash::check($password, $this->password);
    }

    public function isActive()
    {
        return $this->is_active == true;
    }

    public function avatar()
    {
        if ($this->avatar) return asset('storage/' . $this->avatar);

        return 'https://www.gravatar.com/avatar/' . md5(strtolower($this->email)) . '?s=200';
    }

    public static function active()
    {
        return self::where('is_active', true);
    }
}
