<?php

namespace App\Http\Middleware;

use App\Models\Leave;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckManagerStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // $user = auth()->user();
        $leaveId = $request->route('request_leave');
        $leave = Leave::findOrFail($leaveId);

        if (Auth::user()->position->level === 2 && $leave->status_manager !== 2) {
            return response()->view('pages.error.error-status-manager', [], 403); // Kode status 403 menunjukkan akses ditolak
        }

        if (Auth::user()->position->level == 4 && $leave->status_manager !== 0) 
        {
            return response()->view('pages.error.error-status-manager', [], 403); // Kode status 403 menunjukkan akses ditolak

        }

        return $next($request);
    }
}
