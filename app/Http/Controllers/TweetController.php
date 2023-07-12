<?php

namespace App\Http\Controllers;

use App\Http\Resources\TweetUserResource;
use App\Models\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TweetController extends Controller
{
    public function index() {
        $tweet = Tweet::all();
        return TweetUserResource::collection($tweet->loadMissing(['writer:id,name']));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tweet_content' => 'required',
        ]);
        if ($request->file) 
        {
            $filename = $this->generateRandomString();
            $extension = $request->file->extension();
            $image = $filename.'.'.$extension;

            Storage::putFileAs('image', $request->file, $image);
        }
        $request['image'] = $image;
        $request['author']=Auth::user()->id;
        $tweet = Tweet::create($request->all());
        return new TweetUserResource($tweet->loadMissing('writer:id,name'));
    }
    public function destroy($id)
    {
        $tweet = Tweet::findOrFail($id);
        $tweet->delete();
        return new TweetUserResource($tweet->loadMissing('writer:id,name'));
    }

    function generateRandomString($length = 30) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}
