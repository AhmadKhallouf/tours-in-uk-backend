<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\UserRole;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, HasPermissions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'is_active',
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

    protected $with = [
        'profile',
    ];

    protected $appends = [
        'is_partner'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function canAccessPanel(Panel $panel): bool
    {
        $panelId = $panel->getId();

        return $this->hasRole($panelId) && $this->is_active;
    }


    // User has many bookings
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    // User has many payment methods
    public function paymentMethods(): HasMany
    {
        return $this->hasMany(PaymentMethod::class);
    }

    function favorites(): HasMany
    {
        return $this->hasMany(Favorite::class)->with('favoritable');
    }

    // User has one profile
    public function profile(): HasOne
    {
        return $this->hasOne(UserProfile::class);
    }

    // User may have one partner record
    public function partner(): HasOne
    {
        return $this->hasOne(Partner::class);
    }

    public function getIsPartnerAttribute(): bool
    {
        return $this->partner()->exists();
    }
}
