<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\ImageUploadTrait;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    use ImageUploadTrait;
    public function index(){
        return view('backoffice.profile.profile');
    }

    public function update(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        $id = auth()->user()->id;
        $data = User::findOrFail($id);
 
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
        $data->save();
        return redirect()->back()->with('success', 'User updated successfully.');
    }

    //change password
    public function changePassword(Request $request){
        $this->validate($request, [
            'password' => 'min:8',
            'password_confirmation' => 'required_with:password|same:password|min:8'
        ]);
        $data = User::findOrFail(auth()->user()->id);

        $data->password = Hash::make($request->password);

        $data->save();

        return redirect()->back()->with('success', 'Password updated successfully.');
        
    }
}
