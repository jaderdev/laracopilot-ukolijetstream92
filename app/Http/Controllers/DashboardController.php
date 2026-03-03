<?php

namespace App\Http\Controllers;

use App\Models\Composition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('admin')) {
            $totalCompositions  = Composition::count();
            $pendingCount       = Composition::where('status', 'pending')->count();
            $registeredCount    = Composition::where('status', 'registered')->count();
            $recentCompositions = Composition::with('user')->latest()->take(5)->get();

            return view('dashboard.admin', compact(
                'totalCompositions', 'pendingCount', 'registeredCount', 'recentCompositions'
            ));
        }

        if ($user->hasRole('composer')) {
            $myCompositions  = Composition::where('user_id', $user->id)->latest()->get();
            $myTotal         = $myCompositions->count();
            $myPending       = $myCompositions->where('status', 'pending')->count();
            $myRegistered    = $myCompositions->where('status', 'registered')->count();

            return view('dashboard.composer', compact(
                'myCompositions', 'myTotal', 'myPending', 'myRegistered'
            ));
        }

        // Singer dashboard
        $catalog   = Composition::with('user')->where('status', 'registered')->latest()->get();
        $allSongs  = Composition::with('user')->latest()->get();
        $genreCount = $allSongs->count();

        return view('dashboard.singer', compact('catalog', 'genreCount'));
    }
}