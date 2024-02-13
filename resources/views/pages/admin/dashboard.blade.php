@extends('layout.app')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard</h1>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Pengajuan Direview</h4>
                            </div>
                            <div class="card-body">
                                {{ $prosesCuti }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-check-double"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Pengajuan Disetujui</h4>
                            </div>
                            <div class="card-body">
                                {{ $approveCuti }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Pengajuan Pending</h4>
                            </div>
                            <div class="card-body">
                                {{ $pendingCuti }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="fas fa-times"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Pengajuan Ditolak</h4>
                            </div>
                            <div class="card-body">
                                {{ $rejectCuti }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Calendar</h4>
                        </div>
                        <div class="card-body">
                            <div class="fc-overflow">
                                <div id="myEvent"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Pengajuan Terbaru</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled list-unstyled-border">
                                @foreach ($pendingLeaves->sortByDesc('updated_at')->take(5) as $index => $leave)
                                    <li class="media">
                                        <a>
                                            @if ($leave->user->photo)
                                                <img alt="image" src="{{ asset('files/photo/' . $leave->user->photo) }}"
                                                    class="mr-3 rounded-circle" width="50">
                                            @else
                                                <img alt="image" src="{{ asset('assets/img/avatar/avatar-1.png') }}"
                                                    class="mr-3 rounded-circle" width="50">
                                            @endif
                                            <div class="media-body">
                                                <div class="float-right text-primary">{{ $leave->time_difference }}</div>
                                                <a href="{{ route('request-leave.index') }}"
                                                    data-leaves-id="{{ $leave->id }}"
                                                    class="media-title">{{ $leave->user->full_name }}</a>
                                                <div class="text-small text-danger mb-1 mt-1">
                                                    @php
                                                        $startDate = \Carbon\Carbon::parse($leave->start_date);
                                                        $endDate = \Carbon\Carbon::parse($leave->end_date);
                                                    @endphp

                                                    @if ($startDate->isSameMonth($endDate) && $startDate->isSameYear($endDate))
                                                        {{ $startDate->format('j') }} - {{ $endDate->format('j F Y') }}
                                                    @else
                                                        {{ $startDate->format('j F') }} - {{ $endDate->format('j F Y') }}
                                                    @endif
                                                </div>
                                                <span class="text-small text-muted mt-2">{{ $leave->reason }}</span>
                                                <span class="badge"></span>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="text-center pt-1 pb-1">
                                <a href="{{ route('request-leave.index') }}" class="btn btn-primary btn-lg btn-round">
                                    View All
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>

    @push('script-dashboard')
        <script src="{{ asset('assets/js/page/index-0.js') }}"></script>
        {{-- <script src="{{ asset('assets/modules/fullcalendar/fullcalendar.min.js') }}"></script>
        <script src="{{ asset('assets/js/page/modules-calendar.js') }}"></script> --}}
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>
        {{-- <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/interaction@5.11.3/main.min.js"></script> --}}

        {{-- <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script> --}}

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('myEvent');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    locale: 'id',
                    selected: true,
                    // editable: true,

                    events: {
                        url: '/dashboard/calendar',
                        method: 'GET'
                    },
                    eventContent: function(arg) {
                        var title = arg.event.title;
                        var reason = arg.event.extendedProps.reason;
                        var type = arg.event.extendedProps.type;

                        
                        var content = '';
                        // judul
                        content += '<div style="font-weight: bold; text-align: left; margin-left:5px; padding: 5px;">' + title + '</div>';

                        // alasan
                        if (reason) {
                            content += '<div style="text-align: left; margin-left: 5px; padding: 5px;">' + reason + ' ('+ type +')</div>';
                        }

                        return {
                            html: content
                        };
                    }

                });

                calendar.render();
            });
            
        </script>
    @endpush
@endsection
