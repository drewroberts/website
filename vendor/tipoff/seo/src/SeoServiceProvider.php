<?php

declare(strict_types=1);

namespace Tipoff\Seo;

use Tipoff\Seo\Commands\CheckRankingCommand;
use Tipoff\Seo\Commands\CheckSearchVolumeCommand;
use Tipoff\Seo\Commands\PullSearchLocales;
use Tipoff\Seo\Models\BusinessCategory;
use Tipoff\Seo\Models\Company;
use Tipoff\Seo\Models\Domain;
use Tipoff\Seo\Models\Keyword;
use Tipoff\Seo\Models\Place;
use Tipoff\Seo\Models\Ranking;
use Tipoff\Seo\Models\SearchVolume;
use Tipoff\Seo\Models\Webpage;
use Tipoff\Seo\Policies\BusinessCategoryPolicy;
use Tipoff\Seo\Policies\CompanyPolicy;
use Tipoff\Seo\Policies\DomainPolicy;
use Tipoff\Seo\Policies\KeywordPolicy;
use Tipoff\Seo\Policies\PlacePolicy;
use Tipoff\Seo\Policies\RankingPolicy;
use Tipoff\Seo\Policies\SearchVolumePolicy;
use Tipoff\Seo\Policies\WebpagePolicy;
use Tipoff\Support\TipoffPackage;
use Tipoff\Support\TipoffServiceProvider;

class SeoServiceProvider extends TipoffServiceProvider
{
    public function configureTipoffPackage(TipoffPackage $package): void
    {
        $package
            ->hasPolicies([
                Company::class => CompanyPolicy::class,
                Keyword::class => KeywordPolicy::class,
                Domain::class => DomainPolicy::class,
                Place::class => PlacePolicy::class,
                Ranking::class => RankingPolicy::class,
                SearchVolume::class => SearchVolumePolicy::class,
                Webpage::class => WebpagePolicy::class,
                BusinessCategory::class => BusinessCategoryPolicy::class,
            ])
            ->hasNovaResources([
                \Tipoff\Seo\Nova\Company::class,
                \Tipoff\Seo\Nova\CompanyUser::class,
                \Tipoff\Seo\Nova\Domain::class,
                \Tipoff\Seo\Nova\Keyword::class,
                \Tipoff\Seo\Nova\Place::class,
                \Tipoff\Seo\Nova\PlaceDetails::class,
                \Tipoff\Seo\Nova\PlaceHours::class,
                \Tipoff\Seo\Nova\Ranking::class,
                \Tipoff\Seo\Nova\Result::class,
                \Tipoff\Seo\Nova\SearchVolume::class,
                \Tipoff\Seo\Nova\Webpage::class,
                \Tipoff\Seo\Nova\BusinessCategory::class,
                \Tipoff\Seo\Nova\SearchLocale::class,
            ])
            ->hasCommands([
                CheckRankingCommand::class,
                PullSearchLocales::class,
                CheckSearchVolumeCommand::class,
            ])
            ->name('seo')
            ->hasConfigFile();
    }
}
