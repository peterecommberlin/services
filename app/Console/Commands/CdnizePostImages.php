<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Eventjuicer\Jobs\CdnizePostImagesJob as Job;
use Eventjuicer\Models\PostImage;

class CdnizePostImages extends Command {


    protected $signature = 'posts:cdnize';
    protected $description = 'migrate post images to cloudinary';

    public function __construct(){
        parent::__construct();
    }

    public function handle() {

        $not_yet_uploaded = PostImage::where("cloudinary_uploaded", 0)->get();

        foreach( $not_yet_uploaded as $model) {

            dispatch(new Job($model));

        }
    }
}
