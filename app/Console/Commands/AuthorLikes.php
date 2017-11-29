<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Page\AuthorLike;
use App\Models\Admin\ExpertDetail;
use User;

class AuthorLikes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'author:likes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Count Likes for Authors';

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
    public function handle()
    {
        $authors = User::where('level','adviser')->where('approved',1)->get();
        
        foreach($authors as $author)
        {
            $likes = AuthorLike::where('author_id', $author->id)->count();
            $expertdetail = ExpertDetail::where('user_id', $author->id)->first();
            $expertdetail->likes = $likes;
            $expertdetail->save();
        }
        
        $this->info('Author Likes updation done!');
    }
}
