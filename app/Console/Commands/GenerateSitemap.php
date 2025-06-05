<?php

namespace App\Console\Commands;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Page;
use App\Models\Project;
use HackerESQ\Settings\Facades\Settings;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Sitemap;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom-sitemap:generate {--custom-url=}';
    // Example : php artisan custom-sitemap:generate --custom-url=https://xprogroup.com.au/

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the sitemap for xpro group';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $categories = Category::select('slug', 'updated_at')->where('status', '1')->get();
        $blogs = Blog::select('slug', 'updated_at')->get();
        $projects = Project::select('slug', 'updated_at')->get();
        $pages = Page::select('slug', 'updated_at')->whereNotIn('slug', $categories->pluck('slug'))->get();
        foreach ($categories as $category) {
            $tag = Sitemap::addTag($this->option('custom-url') . $category->slug, $category->updated_at, 'daily', '0.8');
            $page = Page::where('category_id', $category->id)->first();
            if ($page) {
                foreach ($page->images as $key => $value) {
                    $tag->addImage(url('storage/uploads/' . $value->image), $page->name);
                }
            }
        }
        foreach ($blogs as $blog) {
            Sitemap::addTag($this->option('custom-url') . 'blog/' . $blog->slug, $blog->updated_at, 'daily', '0.8');
        }
        foreach ($projects as $project) {
            Sitemap::addTag($this->option('custom-url') . 'projects/' . $project->slug, $blog->updated_at, 'daily', '0.8');
        }
        foreach ($pages as $page) {
            $tag = Sitemap::addTag($this->option('custom-url') . $page->slug, $page->updated_at, 'daily', '0.8');
            foreach ($page->images as $key => $value) {
                $tag->addImage(url('storage/uploads/' . $value->image), $page->name);
            }
        }
        Sitemap::addTag($this->option('custom-url') . 'faq', now(), 'daily', '0.8');
        Sitemap::addTag($this->option('custom-url') . 'projects', now(), 'daily', '0.8');
        Sitemap::addTag($this->option('custom-url') . 'blog', now(), 'daily', '0.8');
        Sitemap::addTag($this->option('custom-url') . 'contact', now(), 'daily', '0.8');
        // $settings = Settings::get();
        // if (Settings::has(['terms_conditions_page'])) {
            // $page = Page::where('id', Settings::get('terms_conditions_page'))->first();
            // Sitemap::addTag($this->option('custom-url') . 'blog/' . $page->slug, $page->updated_at, 'daily', '0.8');
        // }
        // if (Settings::has(['privacy_policy_page'])) {
            // $page = Page::where('id', Settings::get('privacy_policy_page'))->first();
            // Sitemap::addTag($this->option('custom-url') . 'blog/' . $page->slug, $page->updated_at, 'daily', '0.8');
        // }
        // if (Settings::has(['footer_1'])) {
            // $page = Page::where('id', Settings::get('footer_1'))->first();
            // Sitemap::addTag($this->option('custom-url') . 'blog/' . $page->slug, $page->updated_at, 'daily', '0.8');
        // }
        // if (Settings::has(['footer_2'])) {
            // $page = Page::where('id', Settings::get('footer_2'))->first();
            // Sitemap::addTag($this->option('custom-url') . 'blog/' . $page->slug, $page->updated_at, 'daily', '0.8');
        // }
        // if (Settings::has(['footer_3'])) {
            // $page = Page::where('id', Settings::get('footer_3'))->first();
            // Sitemap::addTag($this->option('custom-url') . 'blog/' . $page->slug, $page->updated_at, 'daily', '0.8');
        // }
        // if (Settings::has(['footer_4'])) {
            // $page = Page::where('id', Settings::get('footer_4'))->first();
            // Sitemap::addTag($this->option('custom-url') . 'blog/' . $page->slug, $page->updated_at, 'daily', '0.8');
        // }


        file_put_contents(public_path('sitemap.xml'), Sitemap::xml());
        // $sitemap->writeToFile(public_path('sitemap.xml'));
    }
}
