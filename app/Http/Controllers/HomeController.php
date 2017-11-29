<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\NewUserWelcome;
use Auth;
use App\Mail\TestEmail;
use App\Models\Admin\Category;
use App\Models\Admin\Post;
use App\Models\Admin\BasicDetail;
use App\Models\Admin\ExpertDetail;
use App\Models\Admin\FirstShift;
use App\Models\Page\AuthorLike;
use App\Models\Page\Asks\Ask;
use Illuminate\Support\Facades\Input;
use Response;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
     public function welcome()
    {
       $categories = Category::all();
       $blogs = Post::limit(4)->get();
        return view('home')->withCategories($categories)->withBlogs($blogs);
    }
    
    public function index()
    {
       $categories = Category::all();
       $blogs = Post::limit(4)->get();
        return view('home')->withCategories($categories)->withBlogs($blogs);
    }

    public function mySearch()
    {
      return view('pages.adviceli.index');
    }

    public function search()
    {
        $output = "";
        $keyword = Input::get('keyword');
        
        $advisers = ExpertDetail::where('major_cat','LIKE', $keyword.'%')->get(); //->orwhere('major_subcat','LIKE', $keyword)->orwhere('other_cat','LIKE', $keyword)->orwhere('other_subcat','LIKE', $keyword)->get()
        $questions = Ask::where('question','LIKE', '%'.$keyword.'%')->get();
        $posts = Post::where('title','LIKE', '%'.$keyword.'%')->get();
        $users = BasicDetail::where('firstname','LIKE','%'.$keyword.'%')->orwhere('lastname','LIKE','%'.$keyword.'%')->get();
        
        foreach($advisers as $adviser){
            $output .= "<p style='margin:10px'><img style='width:30px' src='http://testserver.adviceli.com/public/website/images/userimg.png' data-toggle='tooltip' data-placement='left' title='Experties'> ";
            $output .= "<a href='http://testserver.adviceli.com/public/author/".$adviser->user_id."'>".$adviser->user->basicdetail->firstname." ".$adviser->user->basicdetail->lastname."</a>";
            $output .= "</p>";                
        }
        
        foreach($questions as $question){
          $output .= "<p style='margin:10px'> <i class='fa fa-question-circle' data-toggle='tooltip' data-placement='left' title='Ask Us'></i> ";    
          $output .= "<a href='http://testserver.adviceli.com/public/ask-us/questions/".$question->id."'>".$question->question."</a>";
          $output .= "</p>";
        }
        
        foreach($posts as $post){
          $output .= "<p style='margin:10px'> <i class='fa fa-rss' data-toggle='tooltip' data-placement='left' title='Blog Post'></i> ";        
          $output .= "<a href='http://testserver.adviceli.com/public/blog-posts/".$post->id."'>".$post->title."</a>";
          $output .= "</p>";
        }
        
        foreach($users as $user){
            $output .= "<p style='margin:10px'><img style='width:30px' src='http://testserver.adviceli.com/public/website/images/userimg.png' data-toggle='tooltip' data-placement='left' title='Adviser'> ";
            $output .= "<a href='http://testserver.adviceli.com/public/author/".$user->user_id."'>".$user->firstname." ".$user->lastname."</a>";
            $output .= "</p>";                
        }
        
        return Response($output);

    }


    public function newHit()
    {
      $uname = 'Adviseli';
      $pwd = 'adviseli@123';
      $sender = 'ADVCLI';
      $channel = 'trans';
      $mobile = '8447645580';
      $message = 'hiiii';
      $uri = 'http://www.clickinsms.com/Sendsms.aspx?Uname='.$uname.'&Pwd='.$pwd.'&sender='.$sender.'&channel='.$channel.'&DCS=0&flashsms=0&MobileNO='.$mobile.'&Message='.$message.'&route=15&messageType=Single&msgcount=1&GroupID=0';
      return $this->sendRequest($uri);
    }

    public function sendRequest($uri)
    {
      $curl = curl_init($uri);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
      curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
      $response = curl_exec($curl);
      curl_close($curl);
      return $response;
    }
    
    
    public function newTest()
    {
      $categories = Category::all();
      return view('test')->withCategories($categories);
    }
    
    public function newGet()
    {
        $cat_id = Input::get('cat_id');
        $subcategories = Category::find($cat_id)->subcategories;
        return Response::json($subcategories);
    }
    
    public function newTime()
    {
      $fsd = Input::get('fsd');
      $fsId = Input::get('fsId');
      $day = date('l',strtotime($fsd));
      //$fs = FirstShift::where('day', 'LIKE', '%'.$day.'%' )->get();
      $fs = FirstShift::where('availability_id',$fsId)->where('day','=', $day)->get();
      return Response::json($fs);
    }

}
