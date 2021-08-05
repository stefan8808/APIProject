<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UsersResource;
use App\Http\Requests\UsersRequest;
use App\Http\Requests\InputRequest;
use App\Imports\ImportUsers;
use Excel;

class UsersController extends Controller
{
  /**
  *Display a listing of the resource
  *@return \Illuminate\Http\Response
  */
  public function index()
  {
    return UsersResource::collection(User::paginate(5));
  }
  /**
  *@return \Illuminate\Http\Response
  */
  public function create()
  {

  }
  /**
  * store a new created resource
  * @param \Illuminate\Http\Request $request
  * @return \Illuminate\Http\Response
  */
  public function store(InputRequest $request)
  {
   $user = new User;
   $user->name = $request->name;
   $user->password = $request->password;
   $user->email = $request->email;
   if($request)
   {
   return new UsersResource($user);
   }
   else
   {
     return 'Invalid input: 422';
   }
  }
  /**
  *Display the specific resource
  * @param \App\Models\User $user
  *@return \Illuminate\Http\Response
  */
  public function show(User $user)
  {
    return new UsersResource($user);
  }
  /**
  *Show the form for editing data
  * @param \App\Models\User $user
  *@return \Illuminate\Http\Response
  */
  public function edit(User $user)
  {

  }
  /**
  *Update the specific resource n storage
  * @param \Illuminate\Http\Request $request
  * @param \App\Models\User $user
  * @return \Illuminate\Http\Response
  */
  public function update(UsersRequest $request, User $user)
  {
    $user->update([
      'name' => $request->input('name')
    ]);
    return new UsersResource($user);
  }

  /**
  *@param \App\Models\User $user
  *@return \Illuminate\Http\Response
  */
  public function destory(User $user)
  {
    $user->delete();
    return response(null, 204);
  }
  public function import(Request $request)
  {
    $files = $request->file('file');
    Excel::import(new ImportUsers, $files);
    return "Import successfully";
  }

}
