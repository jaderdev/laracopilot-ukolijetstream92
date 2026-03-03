<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Composition extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'lyrics',
        'audio_path',
        'video_url',
        'isrc',
        'status',
        'user_id',
    ];

    protected $casts = [
        'status' => 'string',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isRegistered(): bool
    {
        return $this->status === 'registered';
    }

    public function getYouTubeEmbedUrl(): ?string
    {
        if (!$this->video_url) {
            return null;
        }

        // Handle standard youtube.com/watch?v= URLs
        if (preg_match('/[?&]v=([^&]+)/', $this->video_url, $m)) {
            return 'https://www.youtube.com/embed/' . $m[1];
        }

        // Handle youtu.be short URLs
        if (preg_match('/youtu\.be\/([^?]+)/', $this->video_url, $m)) {
            return 'https://www.youtube.com/embed/' . $m[1];
        }

        // Handle already-embed URLs
        if (str_contains($this->video_url, 'youtube.com/embed/')) {
            return $this->video_url;
        }

        return null;
    }
}