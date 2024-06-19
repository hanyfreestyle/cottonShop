<?php

namespace App\AppPlugin\Faq\Models;


use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FaqPhoto extends Model implements TranslatableContract  {

    use Translatable;

    public $translatedAttributes = ['des'];
    protected $table = "faq_photo";
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $translationForeignKey = 'photo_id';

    public function modelName(): BelongsTo {
        return $this->belongsTo(Faq::class, 'faq_id', 'id');
    }


}
