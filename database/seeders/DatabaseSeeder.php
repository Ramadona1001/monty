<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RolePermissionSeeder::class,
            AdminUserSeeder::class,
            GeneralSettingsSeeder::class,
            UiTranslationSeeder::class,
            PageSeeder::class,
            MenuItemSeeder::class,
            HeroSlideSeeder::class,
            FeatureSeeder::class,
            ServiceSeeder::class,
            WorkProcessStepSeeder::class,
            StatisticSeeder::class,
            AboutSettingSeeder::class,
            WhyUsSettingSeeder::class,
            BranchSeeder::class,
            ServiceRequestTypeSeeder::class,
            GalleryItemSeeder::class,
            SocialLinkSeeder::class,
            TestimonialSeeder::class,
            TeamMemberSeeder::class,
            FaqSeeder::class,
            BlogCategorySeeder::class,
            BlogTagSeeder::class,
            BlogPostSeeder::class,
            PortfolioCategorySeeder::class,
            PortfolioSeeder::class,
            ClientSeeder::class,
            NewsletterSubscriberSeeder::class,
            ContactMessageSeeder::class,
        ]);
    }
}
