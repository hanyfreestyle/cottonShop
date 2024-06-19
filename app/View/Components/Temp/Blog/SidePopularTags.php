<?php

namespace App\View\Components\Temp\Blog;

use App\AppPlugin\BlogPost\Models\BlogTags;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class SidePopularTags extends Component {

    public $row;
    public $isactive;
    public $option_1;
    public $option_2;


    public function __construct(
        $row = array(),
        $isactive = true,
        $option_1 = null,
        $option_2 = null,

    ) {
        $this->row = $row;
        $this->isactive = $isactive;
        $this->option_1 = $option_1;
        $this->option_2 = $option_2;

    }

    public function render(): View|Closure|string {
        $popularTags = Cache::remember('CashSidePopularTags', cashDay(7), function () {
            return BlogTags::with('translation')
                ->withcount('blogs')
                ->orderby('blogs_count', 'desc')
                ->take(10)
                ->get();;
        });

        return view('components.temp.blog.side-popular-tags')->with([
            'popularTags' => $popularTags,
        ]);
    }
}
