<?php

namespace App\Http\Controllers\Page;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Page\Message;
use App\User;
use Auth;
use DB;
use Session;
use App\Events\MessagePosted;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
      return view('chat');
    }

    public function fetchMessages($userId)
    {
      $authUserId = Auth::user()->id;
      $output = DB::table('messages')
        ->leftJoin('users','users.id',	'=',	'messages.user_id')
        ->join('receivers','receivers.message_id','=','messages.id')
        ->where('messages.user_id','=',$authUserId)
        ->where('receivers.user_id','=',$userId)
        ->orWhere('messages.user_id','=',$userId)
        ->where('receivers.user_id','=',$authUserId)
        ->select('users.name as user','users.image','users.image_path','users.id as userId','messages.message','messages.file_path','messages.file_name','messages.type','messages.created_at as time','receivers.user_id as r_user_id')
        ->orderBy("messages.id","asc")
        ->get();
      return $output;
    }

    public function sendMessage($userId)
    {
      $user = Auth::user();
      $message = $user->messages()->create([
        'message'=>request()->get('message'),
        'type'=>request()->get('type'),
      ]);

      $message->receivers()->create([
          'user_id'=>$userId
        ]);
      // // new message has beed posted
      broadcast(new MessagePosted($message,$user,$userId))->toOthers();
      $output['message'] = $message;
      $output['user'] = $user;
      return ['output'=> $output];
    }

    public function fileupload($userId)
    {
      $file = request('file');
      $user = Auth::user();
      if (!empty($file)) {
            $fileName = $file->getClientOriginalName();
            // file with path
            $filePath = url('uploads/chats/'.$fileName);
            //Move Uploaded File
            $destinationPath = 'uploads/chats';
            if($file->move($destinationPath,$fileName)) {
                $request['file_path'] = $filePath;
                $request['file_name'] = $fileName;
                $request['message'] = 'file';
                $request['type'] = request('type');
            }

            $message = $user->messages()->create($request);

        $message->receivers()->create([
            'user_id'=>$userId
          ]);

        $output = [];
        broadcast(new MessagePosted($message,$user,$userId))->toOthers();

        $output['message'] = $message;
        $output['user'] = $user;
        return ['output'=> $output];

        }
    }

    public function users()
    {
      $authUserId = Auth::user()->id;

      if(Auth::user()->level == 'adviser') {
        $users = DB::table('users')->where('users.level','=',NULL)->where('users.id','!=',$authUserId)->get();
      }
      else {
        $users = DB::table('users')->where('users.level','=','adviser')->where('users.id','!=',$authUserId)->get();
      }
    	// $users = DB::table('users')->where('users.id','!=',$authUserId)->get();
    	return $users;
    }

}
