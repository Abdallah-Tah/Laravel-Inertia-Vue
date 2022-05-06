<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Topics;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class TopicsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Topics/Index', [
            'topics' => Topics::all()->map(function ($topic) {
                return [
                    'id' => $topic->id,
                    'name' => $topic->name,
                    'description' => $topic->description,
                    'images' => asset('storage/image/' . $topic->images),
                ];
            }),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Topics/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'description' => 'required|min:3',
            'images' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time() . '.' . $request->images->getClientOriginalExtension();
        $request->images->move(public_path('storage/image'), $imageName);

        Topics::create([
            'name' => $request->name,
            'description' => $request->description,
            'images' => $imageName,
        ]);

        return redirect()->route('topics.index')->with('message', 'Topic has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Topics  $topics
     * @return \Illuminate\Http\Response
     */
    public function show(Topics $topics)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Topics  $topics
     * @return \Illuminate\Http\Response
     */
    public function edit(Topics $topic)
    {
        return Inertia::render('Topics/Edit', [
            'topic' => [
                'id' => $topic->id,
                'name' => $topic->name,
                'description' => $topic->description,
                'images' => asset('storage/image/' . $topic->images),
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Topics  $topics
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Topics $topic)
    {
        $image_name = Topics::where('id', $topic->id)->first()->images;

        if ($request->hasFile('images')) {
            $imageName = time() . '.' . $request->images->getClientOriginalExtension();
            $request->images->move(public_path('storage/image'), $imageName);
            $image_new = $imageName;
        }else{
            $image_new = $image_name;
        }

        $topic->name = $request->name;
        $topic->description = $request->description;
        $topic->images = $image_new;
        //dd($topic);
        $topic->update();

        return redirect()->route('topics.index')->with('success', 'Topic has been updated');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Topics  $topics
     * @return \Illuminate\Http\Response
     */
    public function destroy(Topics $topic)
    {
        Storage::delete('public/image/' . $topic->images);
        $topic->delete();

        return redirect()->route('topics.index')->with('message', 'Topic has been deleted');
    }
}
