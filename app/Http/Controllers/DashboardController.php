<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //

    public function index()
    {
        // dd(auth()->user()->roles[0]->permissions);
        // dd($roles->permissions);
        // dd(auth()->user()->roles[0]->hasPermissionTo('index divisions'));
        // dd(auth()->user()->can('index divisions'));
        // dd(auth()->user()->getPermissionsViaRoles());
        // \DB::enableQueryLog();
        // dd($user->permissions, $user->getAllPermissions(), $user->can('index divisions'), $user->roles[0]->hasPermissionTo('index divisions'));
        // $user->can('index divisions');
        // dd(\DB::getQueryLog());
        // dd($user->can('index divisions'));

        $user = auth()->user();

        $user_id = Auth::id();
        $userId = auth()->user()->id;
        $userLevel = $user->position->level;


        $totalReview1 = Leave::where('status_manager', '1')
            ->where('status_coo', '1')
            ->count();

        $totalPending1 = Leave::where('status_manager', '0')
            ->where('status_coo', '0')
            ->count();

        $totalSetuju1 = Leave::where('status_manager', '2')
            ->where('status_coo', '2')
            ->count();

        $totalTolak1 = Leave::where('status_manager', '3')
            ->where('status_coo', '3')
            ->count();
            

        $atasanId = User::where('manager_id', $user->id)->orWhere('coo_id', $user->id)->pluck('id');

        $totalReview = Leave::whereIn('user_id', $atasanId)
            ->where('status_manager', '1')
            ->where('status_coo', '1')
            ->count();

        $totalPending = Leave::whereIn('user_id', $atasanId)
            ->where('status_manager', '0')
            ->where('status_coo', '0')
            ->count();

        $totalSetuju = Leave::whereIn('user_id', $atasanId)
            ->where('status_manager', '2')
            ->where('status_coo', '2')
            ->count();

        $totalTolak = Leave::whereIn('user_id', $atasanId)
            ->where('status_manager', '3')
            ->where('status_coo', '3')
            ->count();

        // dd($summary);
        $prosesCuti = Leave::where('user_id', $user_id)
            ->where('status_manager', '1')
            ->where('status_coo', '1')
            ->count();

        $pendingCuti = Leave::where('user_id', $user_id)
            ->where('status_manager', '0')
            ->where('status_coo', '0')
            ->count();

        $approveCuti = Leave::where('user_id', $user_id)
            ->where('status_manager', '2')
            ->where('status_coo', '2')
            ->count();

        $rejectCuti = Leave::where('user_id', $user_id)
            ->where('status_manager', '3')
            ->where('status_coo', '3')
            ->count();

        $pendingLeaves = Leave::with(['user', 'type'])
            ->join('users', 'users.id', '=', 'leaves.user_id')
            ->select('leaves.*')
            ->where(function ($query) use ($userId) {
                $query->where('users.manager_id', $userId)
                    ->orWhere('users.coo_id', $userId);
            })
            ->where(function ($query) use ($userId) {
                $userLevel = auth()->user()->position->level; // Assuming level is stored in the users table
    
                if ($userLevel == 2) {
                    $query->where('leaves.status_manager', 2);
                }

            })
            ->get();

        $informasiUpdate = Leave::with(['user', 'type'])
            ->where('user_id', $userId)
            ->where(function ($query) use ($userId) {
                $query->where('status_manager', 2)
                    ->orWhere('status_coo', 2);
            })
            ->get();


        foreach ($pendingLeaves as $leave) {
            $createdAt = new Carbon($leave->updated_at);
            $now = Carbon::now();

            $differenceInMinutes = $now->diffInMinutes($createdAt);

            $leave->time_difference = $this->formatTimeDifference($differenceInMinutes);
        }

        if ($user->photo) {
            $photoUrl = asset('files/photo/' . $user->photo);
            $photoExtension = pathinfo($user->photo, PATHINFO_EXTENSION);
        } else {
            $photoUrl = null;
            $photoExtension = null;
        }

        return view('pages.admin.dashboard', compact('totalReview1','totalPending1','totalSetuju1','totalTolak1','informasiUpdate', 'userLevel', 'prosesCuti', 'pendingCuti', 'approveCuti', 'rejectCuti', 'pendingLeaves', 'photoUrl', 'totalReview', 'totalPending', 'totalSetuju', 'totalTolak'));
    }

    private function formatTimeDifference($differenceInMinutes)
    {
        if ($differenceInMinutes < 1) {
            return 'Now';
        } elseif ($differenceInMinutes < 60) {
            return $differenceInMinutes . ' minutes ago';
        } elseif ($differenceInMinutes < 1440) {
            // Convert to hours
            return floor($differenceInMinutes / 60) . ' hours ago';
        } else {
            // Convert to days
            return floor($differenceInMinutes / 1440) . ' days ago';
        }
    }

    public function calendar(Request $request)
    {
        $userId = Auth::id();
        $userLevel = auth()->user()->position->level;

        if ($userLevel == 4) {
            $events = Leave::with(['user', 'type'])
                ->where('user_id', $userId)->get();
        } elseif ($userLevel == 1) {
            $events = Leave::with(['user', 'type'])->get();
        } else {
            $events = Leave::with(['user', 'type'])
                ->where('user_id', $userId)
                ->orWhere(function ($query) use ($userId) {
                    $query->where('manager_id', $userId)
                        ->orWhere('coo_id', $userId);
                })
                ->get();
        }

        // dd($events);

        $eventsFormatted = [];
        foreach ($events as $event) {

            $endDate = Carbon::parse($event->end_date)->addDay()->format('Y-m-d');
            $startDate = Carbon::parse($event->start_date)->format('Y-m-d');

            $color = $this->generateColor($event->user_id);

            $eventsFormatted[] = [
                'title' => $event->user->full_name,
                'start' => $startDate,
                'end' => $endDate,
                'reason' => $event->reason,
                'type' => $event->type->name,
                'color' => $color
            ];
        }

        // dd($eventsFormatted);

        return response()->json($eventsFormatted);

    }

    private function generateColor($userId)
    {
        // ID
        $hash = md5($userId);
        $color = '#' . substr($hash, 0, 6);

        return $color;
    }

}
