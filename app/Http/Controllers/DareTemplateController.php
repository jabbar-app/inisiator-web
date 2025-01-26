<?php

namespace App\Http\Controllers;

use App\Models\DareTemplate;
use Illuminate\Http\Request;

class DareTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $templates = DareTemplate::all();
        return view('game.dare.templates.index', compact('templates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('game.dare.templates.create', [
            'oldOptions' => old('options', []),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'question' => 'required|string|max:255',
            'options' => 'required|array|min:2',
            'options.*.text' => 'required|string|max:255',
            'options.*.is_image' => 'required|in:true,false', // Menggunakan 'in' untuk menghindari error boolean
            'options.*.compressed_image' => 'nullable|string', // Base64 string
        ]);

        $options = [];
        foreach ($request->options as $key => $option) {
            $imagePath = null;

            if (!empty($option['compressed_image'])) {
                $imageData = $option['compressed_image'];
                $imageName = uniqid() . '.webp';
                $imagesFolder = public_path('game/dare/options');

                // Buat folder jika belum tersedia
                if (!is_dir($imagesFolder)) {
                    mkdir($imagesFolder, 0755, true);
                }

                // Decode Base64 image dan simpan ke dalam folder
                $decodedImage = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageData));
                $imagePath = 'game/dare/options/' . $imageName;

                if (!file_put_contents($imagePath, $decodedImage)) {
                    return redirect()->back()->withErrors(['error' => 'Failed to save image.']);
                }

                // Simpan path gambar relatif untuk database
                // $imagePath = 'options/' . $imageName;
            }


            $options[] = [
                'text' => $option['text'],
                'is_image' => filter_var($option['is_image'], FILTER_VALIDATE_BOOLEAN),
                'image_url' => $imagePath,
            ];
        }

        DareTemplate::create([
            'question' => $request->input('question'),
            'options' => json_encode($options),
            'correct_answer' => $request->input('correct_answer'),
        ]);

        return redirect()->route('dare-templates.index')->with('success', 'Template created successfully.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DareTemplate $dareTemplate)
    {
        return view('game.dare.templates.edit', compact('dareTemplate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DareTemplate $dareTemplate)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'options' => 'required|array|min:2',
            'options.*.text' => 'required|string|max:255',
            'options.*.is_image' => 'required|in:true,false',
            'options.*.compressed_image' => 'nullable|string',
        ]);

        $options = [];
        foreach ($request->options as $key => $option) {
            $imagePath = null;

            if (filter_var($option['is_image'], FILTER_VALIDATE_BOOLEAN)) {
                if (!empty($option['compressed_image'])) {
                    // Decode Base64 image and save to server
                    $imageData = explode(',', $option['compressed_image']);
                    $decodedImage = base64_decode($imageData[1]);
                    $imagePath = 'options/' . uniqid() . '.jpg';
                    file_put_contents(public_path($imagePath), $decodedImage);
                } elseif (!empty($option['image_url'] ?? null)) {
                    // Retain the existing image if no new image is uploaded
                    $imagePath = $option['image_url'];
                }
            }

            $options[] = [
                'text' => $option['text'],
                'is_image' => filter_var($option['is_image'], FILTER_VALIDATE_BOOLEAN),
                'image_url' => $imagePath,
            ];
        }

        $dareTemplate->update([
            'question' => $request->input('question'),
            'options' => json_encode($options),
            'correct_answer' => $request->input('correct_answer'),
        ]);

        return redirect()->route('dare-templates.index')->with('success', 'Template updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DareTemplate $dareTemplate)
    {
        $dareTemplate->delete();
        return redirect()->route('dare-templates.index')->with('success', 'Template deleted successfully.');
    }
}
