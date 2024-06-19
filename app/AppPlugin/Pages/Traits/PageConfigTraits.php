<?php


namespace App\AppPlugin\Pages\Traits;

use App\Http\Traits\DefModelConfigTraits;

trait PageConfigTraits {

    public function LoadConfig() {
        $defConfig = DefModelConfigTraits::defConfig();
        $Config = [
            'DbCategory' => 'page_categories',
            'DbCategoryTrans' => 'page_category_translations',
            'DbPost' => 'page_pages',
            'DbPostTrans' => 'page_translations',
            'DbPostCatId' => 'page_id',
            'DbPhoto' => 'page_photos',
            'DbPhotoTrans' => 'page_photo_translations',
            'DbTags' => 'page_tags',
            'DbTagsTrans' => 'page_tags_translations',


            'TableCategory' => true,
            'TableTags' => false,
            'TableTagsOnFly' => true,
            'TableReview' => true,

            'TableMorePhotos' => true,
            'MorePhotosEdit' => true,

            'categoryTree' => false,
            'categoryDeep' => 2,
            'categoryPhotoAdd' => false,
            'categoryPhotoView' => false,
            'categoryIcon' => false,
            'categoryDelete' => false,
            'categorySort' => false,
            'categoryEditor' => false,
            'categoryDes' => false,
            'categorySeo' => false,
            'categorySlug' => true,
            'categoryShowLang' => true,
            'categoryFullRow' => false,


            'postPublishedDate' => false,
            'postPhotoAdd' => false,
            'postPhotoView' => false,
            'postFullRow' => false,
            'postShowLang' => true,
            'postEditor' => true,
            'postDes' => true,
            'postSeo' => false,
            'postSlug' => false,
            'postYoutube' => false,
            'postWebSlug' => null,

        ];

        $Config = array_merge($defConfig, $Config);

        foreach ($Config as $key => $value) {
            $this->$key = $value;
        }
        return $Config;
    }

    static function DbConfig() {

        $Config = new class {
            use PageConfigTraits;
        };

        return $Config->LoadConfig();
    }


}
