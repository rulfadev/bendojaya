<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\SiteSetting;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function index(): View
    {
        $setting = SiteSetting::query()->first();

        $articles = Article::query()
            ->active()
            ->published()
            ->latest('published_at')
            ->paginate(9);

        return view('articles.index', [
            'setting' => $setting,
            'articles' => $articles,
            'title' => 'Artikel - Bendo Jaya Batik Fashion',
            'metaDescription' => 'Artikel, inspirasi, dan edukasi batik dari Bendo Jaya Batik Fashion.',
        ]);
    }

    public function show(Article $article): View
    {
        abort_unless($article->is_active, 404);

        $setting = SiteSetting::query()->first();

        return view('articles.show', [
            'setting' => $setting,
            'article' => $article,
            'title' => $article->meta_title ?: $article->title,
            'metaDescription' => $article->meta_description ?: $article->excerpt,
        ]);
    }
}
