<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\UserRequest;
use App\Services\UserService;
use App\Traits\ResponseAPI;
use App\User;
use Auth;

class UserApiController extends Controller
{
    use ResponseAPI;

    protected $service;
    protected $myAuth;

	public function __construct(UserService $service)
	{
        $this->service = $service;
        $this->myAuth = Auth::guard('api')->user();
    }
    
    public function index()
    {
        $object = $this->service->getAllLatest();
        return $this->response("All User", $object);
    }

    public function indexAdmin(){
        $object = $this->service->getAllLatestAdmin();
        return $this->response("All User Admin", $object);
    }
    
    public function indexKaryawan(){
        $object = $this->service->getAllLatestKaryawan();
        return $this->response("All User Karyawan", $object);
    }

    public function create()
    {
        //
    }

    public function store(UserRequest $request)
    {
        if($request->role == "admin"){
            if($this->myAuth->role != "admin"){
                $request->role = "karyawan";
            }
        }

        $object = $this->service->insert($request->all());

        return $this->response(
            "User Inserted", $object, 201 
        );
    }

    public function show($id)
    {
        $object = $this->service->getById($id);
        if(!$object){
            return $this->response("No user with ID $id", null, 404);
        }

        return $this->response(
            "User Detail", $object 
        );
    }

    public function edit($id)
    {
        //
    }

    public function update(UserRequest $request, $id)
    {
        $request->all();

        $check = $this->service->getById($id);
        if(!$check){
            return $this->response("No user with ID $id", null, 404);
        }

        $user['name'] = $request->name;
        $user['email'] = $request->email;

        if($request->password != null){
            $user['password'] = $request->password;
        }

        $object = $this->service->update($user, $id);
        return $this->response(
            "User Updated", $check, 200
        );
    }

    public function destroy($id)
    {
        $object = $this->service->delete($id);
        
        if(!$object){
            return $this->response("No user with ID $id", null, 404);        
        }

        return $this->response("User Deleted", $object);
    }
}
