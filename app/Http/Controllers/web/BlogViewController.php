<?php

namespace App\Http\Controllers\web;

use App\AppPlugin\BlogPost\Models\Blog;
use App\AppPlugin\BlogPost\Models\BlogCategory;
use App\AppPlugin\BlogPost\Models\BlogTags;
use App\AppPlugin\Product\Models\Product;
use App\Helpers\AdminHelper;
use App\Http\Controllers\WebMainController;
use App\Models\User;


class BlogViewController extends WebMainController {

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     BlogList
    public function BlogList() {

        $meta = parent::getMeatByCatId('blog');
        parent::printSeoMeta($meta, 'BlogList');

        $pageView = $this->pageView;
        $pageView['SelMenu'] = 'BlogList';
        $pageView['page'] = 'page_BlogPostList';

        $postForBanner = Blog::defhomequery()->take(10)->get();

        $topPostId = $postForBanner->pluck('id');
        $posts = Blog::defhomequery()->whereNotIn('id', $topPostId)->paginate(12);


        if($posts->isEmpty() and isset($_GET['page'])) {
            self::abortError404('Empty');
        }

        return view('web.blog.list')->with([
            'pageView' => $pageView,
            'postForBanner' => $postForBanner,
            'posts' => $posts,
        ]);

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   BlogCategoryView
    public function BlogCategoryView($slug) {

        try {
            $slug = AdminHelper::Url_Slug($slug);
            $category = BlogCategory::whereTranslation('slug', $slug)->with('translation')
                ->firstOrFail();
        } catch (\Exception $e) {
            self::abortError404('root');
        }

        parent::printSeoMeta($category, 'BlogCategoryView');

        $pageView = $this->pageView;
        $pageView['SelMenu'] = 'BlogList';
        $pageView['page'] = 'page_BlogPostList';


        $catid = $category->id;

        $posts = Blog::defhomequery()
            ->whereHas('categories', function ($query) use ($catid) {
                $query->where('category_id', $catid);
            })->orderby('created_at', 'desc')->paginate(12);


        if($posts->isEmpty() and isset($_GET['page'])) {
            self::abortError404('Empty');
        }

        return view('web.blog.category')->with([
            'pageView' => $pageView,
            'category' => $category,
            'posts' => $posts,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     BlogAuthorView
    public function BlogAuthorView($slug) {

        try {
            $slug = AdminHelper::Url_Slug($slug);
            $user = User::where('slug', $slug)->firstOrFail();
        } catch (\Exception $e) {
            self::abortError404('root');
        }

        $meta = parent::getMeatByCatId('home');
        parent::printSeoMeta($meta, null);

        $pageView = $this->pageView;
        $pageView['SelMenu'] = 'BlogList';
        $pageView['page'] = 'page_BlogPostList';

        $posts = Blog::defhomequery()->where('user_id', $user->id)->paginate(12);

        if($posts->isEmpty() and isset($_GET['page'])) {
            self::abortError404('Empty');
        }

        return view('web.blog.user')->with([
            'pageView' => $pageView,
            'user' => $user,
            'posts' => $posts,
        ]);

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     BlogTagView
    public function BlogTagView($slug) {

        try {
            $slug = AdminHelper::Url_Slug($slug);
            $tags = BlogTags::whereTranslation('slug', $slug)->with('translation')
                ->firstOrFail();
        } catch (\Exception $e) {
            self::abortError404('root');
        }

        parent::printSeoMeta($tags, 'BlogTagView');

        $pageView = $this->pageView;
        $pageView['SelMenu'] = 'BlogList';
        $pageView['page'] = 'page_BlogPostList';

        $catid = $tags->id;

        $posts = Blog::defhomequery()
            ->whereHas('tags', function ($query) use ($catid) {
                $query->where('tag_id', $catid);
            })->orderby('created_at', 'desc')->paginate(12);

        if($posts->isEmpty() and isset($_GET['page'])) {
            self::abortError404('Empty');
        }

        return view('web.blog.tags')->with([
            'pageView' => $pageView,
            'tags' => $tags,
            'posts' => $posts,
        ]);

    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     BlogView
    public function BlogView($slug) {

        try {
            $slug = AdminHelper::Url_Slug($slug);
            $blog = Blog::whereTranslation('slug', $slug)->translatedIn()
                ->with('translation')
                ->with('categories')
                ->with('tags')
                ->with('user')
                ->firstOrFail();

            $blog->withoutTimestamps(function () use ($blog) {
                $blog->increment('view_count');
            });
        } catch (\Exception $e) {
            self::abortError404('root');
        }

        parent::printSeoMeta($blog, 'BlogView');

        $pageView = $this->pageView;
        $pageView['SelMenu'] = 'BlogList';
        $pageView['page'] = 'SinglePost';

        if(count($blog->translations) == 1) {
            $pageView['go_home'] = route('page_index');
        } else {
            $pageView['slug'] = $blog->translate(webChangeLocale())->slug;
        }

        $catid = $blog->categories->first()->id;

        $RelatedBlog = Blog::definRandomOrder()->where('id', '!=', $blog->id)
            ->whereHas('categories', function ($query) use ($catid) {
                $query->where('category_id', $catid);
            })->inRandomOrder()->take(10)->get();


        if($blog->brand_id) {
            $related_products = Product::defWepAll()->where('brand_id', $blog->brand_id)->take(6)->get();
        } else {
            $related_products = Product::defWepAll()->inRandomOrder()->take(6)->get();
        }

        return view('web.blog.blog_view')->with([
            'pageView' => $pageView,
            'blog' => $blog,
            'RelatedBlog' => $RelatedBlog,
            'related_products' => $related_products,
        ]);

    }

}
