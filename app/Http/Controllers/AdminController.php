<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected function getRecentPosts($limit = 5)
    {
        return Post::with(['user' => function($query) {
                $query->select('id', 'name');
            }])
            ->latest()
            ->take($limit)
            ->get(['id', 'title', 'user_id', 'created_at']);
    }
    public function Dashboard(){
       
        $users = User::all();
        $posts = Post::all();
        $Comments = Comment::all();
        $recentPosts = $this->getRecentPosts(5);
        $months = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];

        $growthData = DB::table('users')
            ->selectRaw("MONTH(created_at) as month_number, COUNT(*) as total")
            ->groupByRaw("MONTH(created_at)")
            ->pluck('total', 'month_number');

        // build array of 12 months with 0 where no data
        $data = [];
        foreach (range(1, 12) as $i) {
            $data[] = $growthData->get($i, 0);
        }
        $labels = $months;
        return view("adminpart.dashboard",[
            "users"=>$users,
            "comments"=>$Comments,
            "posts"=>$posts,
            "recentPosts"=>$recentPosts,
            "labels"=>$labels,
            "data"=>$data,
            //"users"=>$users,
            ]);
    }
   
    
}
