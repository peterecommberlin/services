<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;


use Eventjuicer\Repositories\CompanyDataRepository;
use Eventjuicer\Repositories\Criteria\WhereIn;
use Eventjuicer\Jobs\SendImageToCloudinaryJob;

class CdnizeCompanyImages extends Command
{

    protected $fieldsWithImageUrl = [
        "logotype",
     //   "opengraph_image"
    ];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'companies:cdnize';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'fetch all image URLs and push them to cloudinary';

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
     * @return mixed
     */
    public function handle(CompanyDataRepository $repo)
    {
        $repo->pushCriteria(new WhereIn("name", $this->fieldsWithImageUrl));
        $all = $repo->all();

        $this->info("Found " . $all->count());

        foreach($all as $cd)
        {
            dispatch(new SendImageToCloudinaryJob($cd));
        }

    }
}
