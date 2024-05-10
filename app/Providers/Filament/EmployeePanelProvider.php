<?php

namespace App\Providers\Filament;

use App\Filament\Employee\Pages\Dashboard;
use App\Filament\Employee\Resources\CoachTourResource;
use App\Filament\Employee\Resources\TourResource;
use App\Filament\Employee\Resources\VipServiceResource;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;

use App\Filament\Components;
use Filament\Widgets;
use Hasnayeen\Themes\Http\Middleware\SetTheme;
use Hasnayeen\Themes\ThemesPlugin;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class EmployeePanelProvider extends PanelProvider
{
    protected static string $name = 'employee';

    public function panel(Panel $panel): Panel
    {
        $capFirstName = ucfirst(self::$name);
        return $panel
            ->default()
            ->brandName(config('app.name') . ' ' . ucfirst(self::$name) . ' Panel')
            ->id(self::$name)
            ->path(self::$name)
//            ->brandLogo(asset('favicon.png'))
            ->login()
            ->favicon(asset('favicon.png'))
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(
                in: app_path("Filament/$capFirstName/Resources"),
                for: "App\\Filament\\$capFirstName\\Resources")
            ->discoverPages(
                in: app_path("Filament/$capFirstName/Pages"),
                for: "App\\Filament\\$capFirstName\\Pages"
            )
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(
                in: app_path("Filament/$capFirstName/Widgets"),
                for: "App\\Filament\\$capFirstName\\Widgets"
            )
            ->widgets([
                Widgets\AccountWidget::class,
                Components\QusaiNasrInfoWidget::class,
            ])
            ->navigationGroups([
            ])
            ->plugin(ThemesPlugin::make())
            ->middleware([
                SetTheme::class,
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
