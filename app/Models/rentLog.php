<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class rentLog extends Model
{

    use HasFactory;

    protected $fillable = ['user_id', 'book_id', 'rent_code', 'rent_date', 'return_date', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
