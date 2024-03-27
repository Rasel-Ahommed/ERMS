<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\ImageUploadTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SiteUserController extends Controller
{
    use ImageUploadTrait;

    public function index(){
        $roles = DB::table('role')->get();
        $users = User::select('users.*', 'role.name as roleName')
                ->join('role', 'users.role', '=', 'role.id')
                ->get();
        return view('backoffice.users.users',compact('users','roles'));
    }

    // create site user
    public function create(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'role' => 'required',
            'team' => 'required'
        ]);
    
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'team' => $request->team,
        ];
    
        // Upload and handle image
        $path = $this->uploadImage($request, 'image', 'images');
    
        if ($path) {
            $relativePath = str_replace(public_path(), '', $path);
            
            $data['image'] = $relativePath;
        } else {
            // Default image path if no image is uploaded
            $data['image'] = '/images/avatar.png';
        }

        $user = User::create($data);
    
        if ($user) {
            return redirect()->back()->with('success', 'User created successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to create user.');
        }
    }
    
    // update user 
    public function update(Request $request){
        $data = User::findOrFail($request->id);
        
        if($data){
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'role' => 'required',
                'team' => 'required'
            ]);

           if($request->filled('password')){
                $data->password = Hash::make($request->password);
           }

           if($request->hasFile('image')){
                // Upload and handle image
                $path = $this->uploadImage($request, 'image', 'images');
                
                if ($path) {
                    $relativePath = str_replace(public_path(), '', $path);
                    
                    $imagePath = public_path($data->image);
                    
                    // Check if the image file exists and delete it
                    if (file_exists($imagePath) && $data->image != '/images/avatar.png') {
                        unlink($imagePath);
                    }
                    
                    $data->image = $relativePath;
                }
            }

            $data->name = $request->name;
            $data->email = $request->email;
            $data->role = $request->role;
            $data->team = $request->team;

            $data->save();

            return redirect()->back()->with('success', 'User updated successfully.');
        }
    }



    // destroy user 
    public function destroy($id){
        $id = decrypt($id);

        $data = User::findOrFail($id);
        $data->delete();

        $imagePath = public_path($data->image);

        // Check if the image file exists and delete it
        if (file_exists($imagePath) && $data->image != '/images/avatar.png') {
            unlink($imagePath);
        }

        return redirect()->back()->with('delete', 'User deleted successfully.');

    }
    
}
