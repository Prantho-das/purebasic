<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriberController extends Controller
{

    public function index()
    {
        $subscribers = \App\Subscriber::orderBy('id', 'DESC')->paginate();
        return view('admin.subscriber.index', compact('subscribers'));
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
            'email' => 'nullable|string',
            'phone' => 'nullable|string',
        ]);
        if (!$request->email && !$request->phone) {
            session()->flash('error', 'Please provide at least an email or phone number to subscribe.');
            return redirect()->back();
        }
        
        \App\Subscriber::create([
            'email' => $request->email,
            'phone' => $request->phone,
            'is_active' => 1,
        ]);

        session()->flash('success', 'Thank you for subscribing!');

        return redirect()->back();
    }

    public function destroy(\App\Subscriber $subscriber)
    {
        $subscriber->delete();

        session()->flash('success', 'Subscriber deleted successfully!');
        return redirect()->back();
    }
}