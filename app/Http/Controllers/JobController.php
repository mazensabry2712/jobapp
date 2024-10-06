<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Job;
use Illuminate\Support\Facades\Mail;

class JobController extends Controller
{
    public function apply(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'cover_letter' => 'required|string',
            'cv' => 'required|file|mimes:pdf,doc,docx|max:2048'
        ]);

        if ($request->hasFile('cv')) {
            $cvPath = $request->file('cv')->store('cvs');
        }

        $job = Job::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'cover_letter' => $validatedData['cover_letter'],
            'cv_path' => $cvPath,
        ]);

        Mail::raw('هذا لتأكيد أننا استلمنا طلب التقديم الخاص بك.', function ($message) use ($validatedData) {
            $message->to($validatedData['email'])
                    ->subject('تم استلام طلب التقديم');
        });

        return response()->json(['message' => 'تم إرسال طلب التقديم بنجاح.'], 200);
    }
}
