<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;


use Eventjuicer\Repositories\CompanyDataRepository;
use Eventjuicer\Repositories\Criteria\WhereIn;
use Eventjuicer\Repositories\Criteria\BelongsToGroup;

use Eventjuicer\Jobs\SendImageToCloudinaryJob;
use Eventjuicer\Services\Resolver;

class CdnizeCompanyImages extends Command
{

    protected $fieldsWithImageUrl = [
        "logotype",
        "opengraph_image"
    ];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'companies:cdnize {host}';

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

        $route = new Resolver($this->argument("host"));
        $groupId =  $route->getGroupId();
        $this->info("Group id: " . $groupId);


        $repo->pushCriteria(new WhereIn("name", $this->fieldsWithImageUrl));
        $repo->pushCriteria(new BelongsToGroup($groupId));

        $all = $repo->all();

        $this->info("Found " . $all->count());

        foreach($all as $cd)
        {
           try {

                 dispatch(new SendImageToCloudinaryJob($cd));
                
            } catch (Exception $e) {
                    
                 $this->error("Error with Company data id:" . $cd->id);
            }
        }

    }
}
