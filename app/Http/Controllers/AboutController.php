<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AboutController extends Controller
{
    /**
     * Show About page on frontend
     */
    public function index()
    {
        $about = DB::table('pages')->where('slug', 'about')->first();

        // If not found, create default
        if (!$about) {
            $about = $this->createDefaultAbout();
        }

        // Decode accordion JSON for frontend display
        $accordion = json_decode($about->accordion_json, true) ?? [];

        return view('pages.about', compact('about', 'accordion'));
    }

    /**
     * Show admin edit page
     */
    public function edit()
    {
        $about = DB::table('pages')->where('slug', 'about')->first();

        if (!$about) {
            $about = $this->createDefaultAbout();
        }

        // Decode accordion JSON for admin edit form
        $accordion = json_decode($about->accordion_json, true) ?? [];

        return view('admin.about.edit', compact('about', 'accordion'));
    }

    /**
     * Update About page
     */
    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'cta_text' => 'nullable|string|max:255',
            'cta_link' => 'nullable|string|max:255',
            'accordion.*.question' => 'required|string|max:255',
            'accordion.*.answer' => 'required|string',
        ]);

        DB::table('pages')->updateOrInsert(
            ['slug' => 'about'],
            [
                'title' => $request->input('title'),
                'content' => $request->input('content'),
                'cta_text' => $request->input('cta_text'),
                'cta_link' => $request->input('cta_link'),
                'accordion_json' => json_encode($request->input('accordion')),
                'updated_at' => now(),
            ]
        );

        return redirect()->route('about.edit')->with('success', 'About page updated successfully!');
    }

    /**
     * Create default About page in DB
     */
    private function createDefaultAbout()
    {
        $id = DB::table('pages')->insertGetId([
            'slug' => 'about',
            'title' => 'What makes us the best academy online?',
            'content' => 'Write something about your academy here...',
            'accordion_json' => json_encode([
                ['question' => 'Where shall we begin?', 'answer' => 'Lorem ipsum dolor sit amet...'],
                ['question' => 'How do we work together?', 'answer' => 'Lorem ipsum dolor sit amet...'],
                ['question' => 'Why SCHOLAR is the best?', 'answer' => 'Lorem ipsum dolor sit amet...'],
                ['question' => 'Do we get the best support?', 'answer' => 'Lorem ipsum dolor sit amet...'],
            ]),
            'cta_text' => 'Discover More',
            'cta_link' => '#',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return DB::table('pages')->where('id', $id)->first();
    }
}
