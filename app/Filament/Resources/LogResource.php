<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LogResource\Pages;
use Rmsramos\Activitylog\Resources\ActivitylogResource;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;

class LogResource extends ActivitylogResource implements HasShieldPermissions
{
    public static function getPermissionPrefixes(): array
    {
        return [
            'view',
            'view_any',
        ];
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLogs::route('/'),
            'create' => Pages\CreateLog::route('/create'),
            'edit' => Pages\EditLog::route('/{record}/edit'),
        ];
    }
}
