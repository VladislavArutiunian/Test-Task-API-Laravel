<?php

namespace App\Models;

use Closure;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $full_name
 * @property mixed $first_name
 * @property mixed $last_name
 * @method when(mixed $order_by, Closure $param)
 * @method static firstOrCreate(array $checkAndModifyEntryData)
 * @method static find(string $id)
 * @method paginate(mixed $perPage)
 * @method static findOrFail(string $id)
 */
class NotepadContact extends Model
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
     * Model table
     *
     * @var string
     */
    protected $table = 'notepad_contacts';

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

    /**
     * Get the contact's photo path.
     *
     * @return Attribute
     */
    public function photo(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => !$value ? $value : url('/storage') . '/' . $value,
        );
    }
}
