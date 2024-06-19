<?php

namespace App\View\Components\Temp\Blog;

use App\AppPlugin\BlogPost\Models\BlogCategory;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class SideBlogCategories extends Component {

    public $row;
    public $isactive;
    public $option_1;
    public $option_2;
    public $option_3;


    public function __construct(
        $row = array(),
        $isactive = true,
        $option_1 = null,
        $option_2 = null,
        $option_3 = null,

    ) {
        $this->row = $row;
        $this->isactive = $isactive;
        $this->option_1 = $option_1;
        $this->option_2 = $option_2;
        $this->option_3 = $option_3;

    }

    public function render(): View|Closure|string {

        $categories = Cache::remember('CashSideBlogCategories', cashDay(7), function () {
            return BlogCategory::DefWebquery()->withcount('blogs')->get();
        });

        return view('components.temp.blog.side-blog-categories')->with([
            'categories' => $categories,
        ]);
    }
}
