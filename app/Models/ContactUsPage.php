<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ContactUsPage extends PageModel
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $with = [
        'contactSection',
        'faqs'
    ];

    public function faqs(): HasMany
    {
        return $this->hasMany(Faq::class);
    }

    public function contactSection(): BelongsTo
    {
        return $this->belongsTo(ContactSection::class);
    }
}
