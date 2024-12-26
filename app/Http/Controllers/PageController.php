<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PageController extends Controller
{
    public function show($slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();

        // Dynamically load the view based on the template
        return view('pages.' . $page->template, [
            'content' => $page->content
        ]);
    }

    // Update a page
        public function update(Request $request, Page $page)
        {	
    		
            // Apply validation rules
            $request->validate([
                'slug' => [
                	'required',
                	Rule::unique('pages', 'slug')->ignore($page->id),
                ], 
                'title' => 'required', // Add other validation rules for your fields
                'content' => 'nullable', // Add validation for the content field if needed
                // Add any other validation rules for fields like 'template', etc.
            ]);

            // If validation passes, update the page with the request data
            $page->update($request->all());

            // Redirect after update
            return redirect()->route('pages.index')->with('success', 'Page updated successfully!');
        }
}

