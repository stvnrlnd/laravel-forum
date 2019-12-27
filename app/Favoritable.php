<?php

namespace App;

trait Favoritable
{
    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favorited');
    }

    public function favorite()
    {
        $attributes = ['user_id' =>auth()->id()];
        if (! $this->favorites()->where($attributes)->exists()) {
            return $this->favorites()->create([
                'user_id' => auth()->id(),
            ]);
        }
    }

    public function unfavorite()
    {
        $attributes = ['user_id' =>auth()->id()];
        $this->favorites()->where($attributes)->delete();
    }

    public function isFavorited()
    {
        return (bool) $this->favorites->where('user_id', auth()->id())->count();
    }

    public function getIsFavoritedAttribute()
    {
        return $this->isFavorited();
    }

    public function getFavoritesCountAttribute()
    {
        return $this->favorites->count();
    }
}
