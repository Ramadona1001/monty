<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\BlogTag;
use App\Models\User;
use Illuminate\Database\Seeder;

class BlogPostSeeder extends Seeder
{
    public function run(): void
    {
        $author = User::query()->where('email', 'admin@monty.test')->first();
        $category = BlogCategory::query()->where('slug', 'kitchen-tips')->first();
        $tags = BlogTag::query()->whereIn('slug', ['kitchens', 'wood'])->pluck('id');

        $post = BlogPost::query()->create([
            'blog_category_id' => $category?->id,
            'author_id' => $author?->id,
            'slug' => 'choosing-the-right-kitchen-wood',
            'title' => [
                'en' => 'Choosing the Right Kitchen Wood',
                'ar' => 'اختيار نوع الخشب المناسب للمطبخ',
            ],
            'excerpt' => [
                'en' => 'A quick guide to selecting durable, beautiful wood for your custom kitchen.',
                'ar' => 'دليل سريع لاختيار خشب متين وجميل لمطبخك المخصص.',
            ],
            'body' => [
                'en' => '<p>From red beech to oak and MDF, each wood type offers unique benefits for kitchen design.</p>',
                'ar' => '<p>من الزان الأحمر إلى الآرو و MDF، يقدم كل نوع خشب مزايا فريدة لتصميم المطبخ.</p>',
            ],
            'featured_image' => 'assets/img/services/kitchens/kitchen-1.webp',
            'seo_title' => [
                'en' => 'Choosing the Right Kitchen Wood | Monty',
                'ar' => 'اختيار نوع الخشب المناسب للمطبخ | مونتي',
            ],
            'status' => 'published',
            'published_at' => now(),
        ]);

        if ($tags->isNotEmpty()) {
            $post->tags()->sync($tags);
        }
    }
}
