<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $full_name
 */
class NotebookEntry extends Model
{
    use HasFactory;

    /**
     * Mass assignment
     *
     * @var string[]
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'patronymic',
        'company_name',
        'phone_number',
        'email',
        'birth_date',
        'photo',
    ];

    /**
     * Get the contact's full name.
     *
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        $fullName = $this->first_name . ' ' . $this->last_name;
        if (isset($this->patronymic)) {
            $fullName .= ' ' . $this->patronymic;
        }
        return $fullName;
    }
}
