<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    // Tentukan tabel yang digunakan (opsional, jika sesuai dengan konvensi Laravel, bisa diabaikan)
    protected $table = 'galleries';

    // Tentukan atribut yang boleh diisi (mass assignment)
    protected $fillable = [
        'photo',
        'title',
        'description'
    ];
}

