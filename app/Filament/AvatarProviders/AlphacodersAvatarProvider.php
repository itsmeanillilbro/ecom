<?php

namespace App\Filament\AvatarProviders;

use Filament\AvatarProviders\Contracts\AvatarProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class AlphacodersAvatarProvider implements AvatarProvider
{
    public function get(Model | Authenticatable $record): string
    {
        return 'https://avatarfiles.alphacoders.com/375/375473.jpeg';
    }
}
