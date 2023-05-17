<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    //
    public function index(){
        $events=Event::paginate(5);
        return view('event.index',compact('events'));
    }

    public function create(){
        return view('event.create');

    }
    public function show(Request $request){
        // dd($request->all());
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'videos.*' => 'mimes:mp4,ogx,oga,ogv,ogg,webm',
            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $event = new Event();
        $event->title = $validatedData['title'];
        $event->description = $validatedData['description'];

        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $image) {

                $filename = $image->hashName();
                $path = Storage::disk('public')->putFileAs('images', $image, $filename);
                $images[] = $path;
            }
            $event->images = json_encode($images);
        }

        if ($request->hasFile('videos')) {
            $videos = [];
            foreach ($request->file('videos') as $video) {
                $filename = $video->hashName();
                $path = Storage::disk('public')->putFileAs('videos', $video, $filename);
                $videos[] = $path;
            }
            $event->videos = json_encode($videos);
        }


        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $thumbnailPath = Storage::disk('public')->putFile('thumbnails', $thumbnail);

            // Generate thumbnail using Intervention Image package
            $thumbnailImage = Image::make($thumbnail)->resize(200, 200)->encode();
            Storage::disk('public')->put($thumbnailPath, $thumbnailImage);

            $event->thumbnail = $thumbnailPath;
        }

        $event->status = true; // Set the status to true

        $event->save();





         return redirect('/event')->with('message','Product Added Successfully');

    }

    public function edit($id){
        $event=Event::findOrFail($id);

        return view('event.edit',compact('event'));

    }

    public function update(Request $request,$id){
        $event = Event::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'videos.*' => 'mimes:mp4,ogx,oga,ogv,ogg,webm',
        ]);

        $event->title = $validatedData['title'];
        $event->description = $validatedData['description'];
        $event->status = $request->has('status');
        // Update thumbnail if a new thumbnail is uploaded
if ($request->hasFile('thumbnail')) {
    $thumbnail = $request->file('thumbnail');
    $thumbnailPath = Storage::disk('public')->putFile('thumbnails', $thumbnail);

    // Generate thumbnail using Intervention Image package
    $thumbnailImage = Image::make($thumbnail)->resize(200, 200)->encode();
    Storage::disk('public')->put($thumbnailPath, $thumbnailImage);

    // Delete previous thumbnail
    Storage::disk('public')->delete($event->thumbnail);

    $event->thumbnail = $thumbnailPath;
}

        $event->save();

        // Retrieve existing images and videos
        $images = json_decode($event->images, true) ?? [];
        $videos = json_decode($event->videos, true) ?? [];

        // Add new images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = $image->hashName();
                $path = Storage::disk('public')->putFileAs('images', $image, $filename);
                $images[] = $path;
            }
        }

        // Add new videos
        if ($request->hasFile('videos')) {
            foreach ($request->file('videos') as $video) {
                $filename = $video->hashName();
                $path = Storage::disk('public')->putFileAs('videos', $video, $filename);
                $videos[] = $path;
            }
        }

        // Save the updated images and videos
        $event->images = json_encode($images);
        $event->videos = json_encode($videos);

        $event->save();

        return redirect('/event')->with('message', 'Event updated successfully');




    }

    public function delete($id){
        $event = Event::findOrFail($id);

// Delete images
$images = json_decode($event->images, true) ?? [];
foreach ($images as $image) {
    Storage::disk('public')->delete($image);
}

// Delete videos
$videos = json_decode($event->videos, true) ?? [];
foreach ($videos as $video) {
    Storage::disk('public')->delete($video);
}

// Delete thumbnail
if ($event->thumbnail) {
    Storage::disk('public')->delete($event->thumbnail);
}

// Delete the event
$event->delete();

return redirect('/event')->with('message', 'Event deleted successfully');

    }
//     public function deleteFile(Request $request)
// {
//     $file = $request->input('file');
//     // dd($file);

//     // Delete the file from storage
//     Storage::disk('public')->delete($file);

//     // Respond with a success message
//     return response()->json(['message' => 'File deleted successfully']);
// }

public function deleteFile(Request $request)
{
    $file = $request->input('file');
    $eventId = $request->input('event_id');

    // Delete the file from storage
    Storage::disk('public')->delete($file);

    // Retrieve the event record
    $event = Event::findOrFail($eventId);

    // Remove the file reference from the JSON column
    $images = json_decode($event->images, true);
    $videos = json_decode($event->videos, true);

    if (($key = array_search($file, $images)) !== false) {
        unset($images[$key]);
    }

    if (($key = array_search($file, $videos)) !== false) {
        unset($videos[$key]);
    }

    $event->images = json_encode(array_values($images));
    $event->videos = json_encode(array_values($videos));

    // Save the updated event record
    $event->save();

    // Respond with a success message
    return response()->json(['message' => 'File deleted successfully']);
}


}
