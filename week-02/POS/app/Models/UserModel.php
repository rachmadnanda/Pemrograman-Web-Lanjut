<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserModel extends Model
{
    use HasFactory;

    protected $table = 'm_user'; 
    protected $primaryKey = 'user_id'; 
    protected $fillable = ['level_id', 'username', 'nama', 'password'];

    // --- Tambahkan method ini di bawah ---
    public function level(): BelongsTo
    {
        // Artinya: UserModel berelasi dengan LevelModel berdasarkan kolom 'level_id'
        return $this->belongsTo(LevelModel::class, 'level_id', 'level_id');
    }
}