<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Carbon;
use App\Models\User;
use App\Models\ToDo;
use App\Models\Like;
use App\Models\Share;

class ToDOController extends Controller
{
   /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userId   = Auth::user()->id;
        $todoData = DB::table('todo')->leftJoin('users', 'users.id', '=', 'todo.user_id')->where('todo.user_id',$userId)->orderBy('todo.created_at', 'desc')
                    ->select('todo.id as id', 'todo.title as title','todo.due_date as due_date', 'todo.description as description', 'todo.status as status', 'todo.created_at', 'users.name as name')->paginate(10);
        return view('todo.todo-list', ['todoData' => $todoData]); 
    }
    /**
     * show the application of  create page
     *
     * @return void
    */
    public function create()
    {
        return view('todo.todo-add');
    }
    /**
     * Create a new controller instance.
     *
     * @return void
    */
    public function store(Request $request)
    { 
        $input = $request->all();
        $today     = Carbon\Carbon::now();

        $validatedData = $request->validate([
            'name'      => 'required',
            'dueDate'   => 'required',
            'status'    => 'required',
        ]);
        
        $todo              = new ToDo;
        $todo->title       = $input['name'];
        $todo->user_id     = Auth::user()->id;
        $todo->due_date    = $input['dueDate'];
        $todo->status      = ($input['status'] == 1) ? 'pending' : 'completed';
        $todo->description = $input['description'];
        $todo->created_at  = $today;
        $todo->updated_at  = $today;
        $todo->save();

        return response()->json(['status'=>'success']); 
    }
    /**
    * Display the specified resource.
    *
    * @param  \App\request  $request
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        $todo = DB::table('todo')->find($id);
        return view('todo.todo-edit')->with([ 'todo' => $todo ]);
    } 
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserData  $userData
     * @return \Illuminate\Http\Response
    */
    public function update(Request $request)
    {
        $input = $request->all();
        $today     = Carbon\Carbon::now();

        $validatedData = $request->validate([
            'name'      => 'required',
            'dueDate'   => 'required',
            'status'    => 'required',
        ]);
      
        $aUpdate     =  [];
        $id          =  $input['id'];

        $status  =  ($input['status'] == 1) ? 'pending' : 'completed';
        $aUpdate     = [
            'title'       =>  $input['name'],
            'due_date'    =>  $input['dueDate'],
            'status'      =>  $status,
            'description' =>  $input['description'],
        ];
      

        $todo = DB::table('todo')
            ->where('id', $id)
            ->update($aUpdate);
        return response()->json(['status'=>'success']); 
        
    }
    /**
    * Display the specified resource.
    *
    * @param  \App\request  $request
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        $todo = DB::table('todo')->find($id);
        return view('todo.todo-show')->with([ 'todo' => $todo ]);
    } 
    /**
    * delete the specified resource.
    *
    * @param  \App\request  $request
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        $todo = ToDo::find( $id )->delete();
        return redirect()->back();
    }

    /**
    * share the all resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function share()
    {
        $userId   = Auth::user()->id;
    /*    $todoData = DB::table('todo')
                    ->leftJoin('users', 'users.id', '=', 'todo.user_id')
                    ->leftJoin('shares', 'shares.todo_id', '=', 'todo.id')
                    ->where('shares.user_id',$userId)->orderBy('todo.created_at', 'desc')
                    ->select('todo.id as id', 'todo.title as title','todo.due_date as due_date', 'todo.description as description', 'todo.status as status', 'todo.created_at', 'users.name as name')->paginate(10); */

                    $todoData = DB::table('todo')
                    ->leftJoin('users', 'users.id', '=', 'todo.user_id')
                    ->leftJoin('shares', 'shares.todo_id', '=', 'todo.id')
                    ->leftJoin('likes', 'likes.todo_id', '=', 'todo.id') // Join likes table
                    ->where('shares.user_id', $userId)
                    ->select(
                        'todo.id as id',
                        'todo.title as title',
                        'todo.due_date as due_date',
                        'todo.description as description',
                        'todo.status as status',
                        'todo.created_at',
                        'users.name as name',
                        DB::raw('COUNT(likes.id) as likes_count') // Count likes
                    )
                    ->groupBy(
                        'todo.id',
                        'todo.title',
                        'todo.due_date',
                        'todo.description',
                        'todo.status',
                        'todo.created_at',
                        'users.name'
                    ) // Group by all selected fields
                    ->orderBy('todo.created_at', 'desc')
                    ->paginate(10);
                
        return view('todo.todo-share-list', ['todoData' => $todoData]); 
    }
    /**
    * shareAdd the specified resource.
    *
    * @param  \App\request  $request
    * @return \Illuminate\Http\Response
    */
    public function shareAdd($id)
    {
        $loggedInUserId = auth()->id(); 
        $users = User::where('id', '!=', $loggedInUserId)->get(['id', 'name']);
        $shareData = DB::table('shares')
                        ->where('shares.todo_id', '=',$id )
                        ->pluck('user_id');
        $shareArray = $shareData->toArray();
      
        return view('todo.todo-share-add',["id" => $id,"users" => $users,"shareArray" =>$shareArray ]);
    }
    /**
     * Create a new share users instance.
     *
     * @return void
    */
    public function storeShareData(Request $request)
    { 
        $input = $request->all();
        $today = Carbon\Carbon::now();
        $validatedData = $request->validate([
            'id'        => 'required',
            'usershare' => 'required|array',
        ]);
    
        $usershare = [];

        $currentShares = Share::where('todo_id', $request->id)->pluck('user_id')->toArray();
        
        if(!empty($currentShares)){
            $toRemove = array_diff($currentShares, $request->usershare ?? []);

            if ($toRemove) {
                Share::where('todo_id', $request->id)
                ->whereIn('user_id', $toRemove)
                ->delete();
            }
        }
       
        foreach ($request->usershare as $userId) {
            $exists = Share::where('todo_id', $request->id)
                           ->where('user_id', $userId)
                           ->exists();
            if (!$exists) {
                $usershare[] = [
                    'todo_id'    => $request->id,
                    'user_id'    => $userId,
                    'created_at' => $today,
                    'updated_at' => $today,
                ];
            } 
        }
        Share::insert($usershare);
        return response()->json(['status'=>'success']); 
    }
     /**
     * Create a new like users instance.
     *
     * @return void
    */
    public function likeUnLike(Request $request)
    {
        $input = $request->all();
        $today = Carbon\Carbon::now();
        $loggedInUserId = auth()->id(); 
        $liked = Like::where('todo_id',  $request->todoId)
                    ->where('user_id', $loggedInUserId)
                    ->exists();
        if ($liked) {
            Like::where('todo_id', $request->todoId)
            ->where('user_id', $loggedInUserId)
            ->delete();
        } else{
            Like::create([
                'todo_id' => $request->todoId,
                'user_id' => $loggedInUserId,
            ]);   
        }
        $likesCount = Like::where('todo_id', $request->todoId)->count();
        return response()->json(['status'=>'success', 'count' => $likesCount]);
        
    }
}
