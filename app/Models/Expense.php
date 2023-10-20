<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $table = 'expenses'; // Specify the table name if it's different from the model name

    protected $fillable = ['title', 'description', 'amount', 'date', 'user_id']; // Define the fillable fields

    // You can define relationships here if needed, for example:
    // public function category()
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // You can also add custom methods for querying data or performing actions related to expenses.
}

