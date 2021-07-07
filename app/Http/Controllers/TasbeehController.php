<?php

namespace App\Http\Controllers;
use App\Models\Tasbeeh;
use App\Models\User;
use Illuminate\Http\Request;
use Exception;
use Session;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use ValidatesRequests;

class TasbeehController extends Controller
{
   public function tasbeeh(Request $request){
        $tasbeeh = new Tasbeeh;
        $tasbeeh->zikar    =    $request->zikar;
        $tasbeeh->counter  =    $request->counter;
       
        $result = $tasbeeh->save();

      if ($result){
         
         return response()->json([
             'status'=>200,
              'message' => 'Data Iserted successfully.',
         ], 200);
         
      }
      else{
         return response()->json([
             'status'=>400,
             'message' => 'Some field are not correct.',
         ], 400);
        
      }
  } 


   public function tasbeehview(Request $request){

      $tasbeeh = Tasbeeh::all();
      return response()->json(compact('tasbeeh'),200);
    }

    public function reset(Request $request){
        $tasbeeh = Tasbeeh::find($request->id);
        $tasbeeh->lap         =   1;
        $tasbeeh->counted     =   0;
        $tasbeeh->total_count =   0;
       
        $result = $tasbeeh->save();

      if ($result){
         
         return response()->json([
             'status'=>200,
              'message' => 'Data Reset successfully.',
         ], 200);
         
      }
      else{
         return response()->json([
             'status'=>400,
             'message' => 'Some field are not correct.',
         ], 400);
        
      }
  } 

  public function update_tasbeeh(Request $request){
    
        $tasbeeh = Tasbeeh::find($request->id);
        $tasbeeh->lap         =  $request->lap;
        $tasbeeh->counted     =  $request->counted;
        $tasbeeh->total_count =  $request->total_count;
       
        $result = $tasbeeh->save();

      if ($result){
         
         return response()->json([
             'status'=>200,
              'message' => 'Data Update successfully.',
         ], 200);
         
      }
      else{
         return response()->json([
             'status'=>400,
             'message' => 'Some field are not correct.',
         ], 400);
        
      }
  } 



     public function deletebyid(Request $request, $id){

      $tasbeeh = Tasbeeh::find($id);
      $result =$tasbeeh->delete();
     if ($result){
         
         return response()->json([
             'status'=>200,
              'message' => 'Data Deleted successfully.',
         ], 200);
         
      }
    }

   public function signup(Request $request){

        $users = new User;
        $users->name      =    $request->name;
        $users->number    =    $request->number;
        $users->email     =    $request->email;
        $users->password  =    Hash::make($request->input('password'));
        $users->remember_token     =str::random(10);
        // $users->image     =    $request->file('image')->store('images');
       
        // $new_name() = rand().'.'.$image->getClientOriginalExtension();
        //     $users->move(public_path('/uploads/images'),$new_name);
        //     return response()->json('$new_name');


        $result= $users->save();
           if ($result){
   
           return response()->json([
                  'status'=>200,
                   'message' => 'Data Iserted successfully.',
        ], 200);
   
          }
              else{
          return response()->json([
         'status'=>400,
         'message' => 'Some field are not correct.',
           ], 400);
  
        } 

    }



    public function login(Request $request){

      $user= User::where('email', $request->email)->first();
      if (!$user || !Hash::check($request->password, $user->password)) {
          return response([
              'message' => ['These credentials do not match our records.']
          ], 404);
      }
       $token = $user->createToken('my-app-token')->plainTextToken;
      $response = [
          'user' => $user,
          'token' => $token
      ];
       return response($response, 201);
    }

    public function forgot_password(Request $request)
    {
        $email = User::where('email',$request->email)->first();
        if($email){
            $credentials = request()->validate(['email' => 'required|email']);
            $response = Password::sendResetLink($credentials);
            return response()->json(["msg" => 'Reset password link sent on your email id.']);
        }else{
            return response()->json(["msg" => 'your email is not found']);
        }
    }
    
    public function change_password(Request $request)
    {
        $credentials = request()->validate([
            'email' => 'required',
            'token' => 'required|string',
            'password' => 'required|string'
        ]);
        $reset_password_status = Password::reset($credentials, function ($user, $password) {
            $user->password = Hash::make($password);
            $user->save();
        });
        if ($reset_password_status == Password::INVALID_TOKEN) {
            return response()->json(["msg" => "Invalid token provided"], 400);
        }
        return response()->json(["msg" => "Password has been successfully changed"]);
    }

    public function editprofile(Request $request,$id){
        $users = Tasbeeh::findOrFail($id);
       return $users;
    }

public function profileupdate(Request $request){

        $users = User::find($request->id);
        $users->name      =    $request->name;
        $users->email     =    $request->email;
        $users->password  =    Hash::make($request->password);
        $result= $users->save();
   if ($result){
   
           return response()->json([
                  'status'=>200,
                   'message' => 'Data Update successfully.',
        ], 200);
   
          }
              else{
          return response()->json([
         'status'=>400,
         'message' => 'Some field are not correct.',
           ], 400);
  
} 
}



}