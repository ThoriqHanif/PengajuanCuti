@can('edit request-leave')
    
@if (auth()->user()->position->level == 3)
    @if ($leaves->status_manager == 0)
        <a class="btn btn-sm bg-primary text-white font-weight-bold text-xs detail-user" data-toggle="tooltip"
            data-placement="top" title="Detail & Review" data-leaves-id="{{ $leaves->id }}"
            href="{{ route('request-leave.edit', $leaves->id) }}">
            <i class="fas fa-eye"></i> Detail & Review
        </a>
    @elseif ($leaves->status_manager == 1)
        <a class="btn btn-sm bg-info text-white font-weight-bold text-xs" data-toggle="tooltip" data-placement="top"
            title="Sedang Direview COO" data-leaves-id="{{ $leaves->id }}"
            href="{{ route('request-leave.edit', $leaves->id) }}" <i class="fas fa-search mr-2"></i> Sedang Direview
            {{ $leaves->user->manager->position->name }}
        </a>
        <a class="btn btn-sm bg-primary text-white font-weight-bold text-xs" data-toggle="tooltip" data-placement="top"
            title="Sedang Direview COO" data-leaves-id="{{ $leaves->id }}"
            href="{{ route('request-leave.show', $leaves->id) }}">
            <i class="fas fa-eye"></i>
        </a>
    @elseif ($leaves->status_manager == 2 && $leaves->status_coo == 0)
        <a class="btn btn-sm bg-primary text-white font-weight-bold text-xs" data-toggle="tooltip" data-placement="top"
            title="Sedang Direview COO" @disabled(true)>
            <i class="fas fa-clock mr-2"></i> Pending oleh {{ $leaves->user->coo->position->name }}
        </a>
        <a class="btn btn-sm bg-warning text-white font-weight-bold text-xs" data-toggle="tooltip" data-placement="top"
            title="Sedang Direview COO" data-leaves-id="{{ $leaves->id }}"
            href="{{ route('request-leave.edit', $leaves->id) }}">
            <i class="fas fa-pencil-alt"></i>
        </a>
        <a class="btn btn-sm bg-primary text-white font-weight-bold text-xs" data-toggle="tooltip" data-placement="top"
            title="Sedang Direview COO" data-leaves-id="{{ $leaves->id }}"
            href="{{ route('request-leave.show', $leaves->id) }}">
            <i class="fas fa-eye"></i>
        </a>
    @elseif ($leaves->status_manager == 2 && $leaves->status_coo == 1)
        <a class="btn btn-sm bg-info text-white font-weight-bold text-xs" data-toggle="tooltip" data-placement="top"
            title="Sedang Direview COO" @disabled(true)>
            <i class="fas fa-clock mr-2"></i> Sedang Direview {{ $leaves->user->coo->position->name }}
        </a>
        <a class="btn btn-sm bg-primary text-white font-weight-bold text-xs" data-toggle="tooltip" data-placement="top"
            title="Sedang Direview COO" data-leaves-id="{{ $leaves->id }}"
            href="{{ route('request-leave.show', $leaves->id) }}">
            <i class="fas fa-eye"></i>
        </a>
    @elseif ($leaves->status_manager == 3)
        <a class="btn btn-sm bg-danger text-white font-weight-bold text-xs" data-toggle="tooltip" data-placement="top"
            title="You Rejected" data-leaves-id="{{ $leaves->id }}"
            href="{{ route('request-leave.edit', $leaves->id) }}">
            <i class="fas fa-times mr-2"></i> Ditolak oleh {{ $leaves->user->manager->position->name }}
        </a>
        <a class="btn btn-sm bg-primary text-white font-weight-bold text-xs" data-toggle="tooltip" data-placement="top"
            title="Sedang Direview COO" data-leaves-id="{{ $leaves->id }}"
            href="{{ route('request-leave.show', $leaves->id) }}">
            <i class="fas fa-eye"></i>
        </a>
    @elseif ($leaves->status_coo == 2)
        <a class="btn btn-sm bg-success text-white font-weight-bold text-xs" data-toggle="tooltip" data-placement="top"
            title="Approved" @disabled(true)>
            <i class="fas fa-check mr-2"></i> Disetujui oleh {{ $leaves->user->coo->position->name }}
        </a>
        <a class="btn btn-sm bg-primary text-white font-weight-bold text-xs" data-toggle="tooltip" data-placement="top"
            title="Sedang Direview COO" data-leaves-id="{{ $leaves->id }}"
            href="{{ route('request-leave.show', $leaves->id) }}">
            <i class="fas fa-eye"></i>
        </a>
    @elseif ($leaves->status_coo == 3)
        <a class="btn btn-sm bg-danger text-white font-weight-bold text-xs" data-toggle="tooltip" data-placement="top"
            title="Rejected" href="{{ route('leaves.show', $leaves->id) }}">
            <i class="fas fa-times mr-2"></i> Ditolak oleh {{ $leaves->user->coo->position->name }}
        </a>
        <a class="btn btn-sm bg-primary text-white font-weight-bold text-xs" data-toggle="tooltip" data-placement="top"
            title="Sedang Direview COO" data-leaves-id="{{ $leaves->id }}"
            href="{{ route('request-leave.show', $leaves->id) }}">
            <i class="fas fa-eye"></i>
        </a>
    @endif
@elseif(auth()->user()->position->level == 2)
    @if ($leaves->status_manager == 0)
        <a class="btn btn-sm bg-warning text-white font-weight-bold text-xs detail-user" data-toggle="tooltip"
            data-placement="top" title="Detail & Review" data-leaves-id="{{ $leaves->id }}">
            <i class="fas fa-clock mr-2"></i> Menunggu Review {{ $leaves->user->manager->position->name }}
        </a>
        <a class="btn btn-sm bg-primary text-white font-weight-bold text-xs" data-toggle="tooltip"
        data-placement="top" title="Sedang Direview COO" data-leaves-id="{{ $leaves->id }}"
        href="{{ route('request-leave.show', $leaves->id) }}">
        <i class="fas fa-eye"></i>
    </a>
    @elseif($leaves->status_manager == 1)
        <a class="btn btn-sm bg-info text-white font-weight-bold text-xs detail-user" data-toggle="tooltip"
            data-placement="top" title="Detail & Review" data-leaves-id="{{ $leaves->id }}">
            <i class="fas fa-search mr-2"></i> Sedang Direview {{ $leaves->user->manager->position->name }}
        </a>
        <a class="btn btn-sm bg-primary text-white font-weight-bold text-xs" data-toggle="tooltip"
            data-placement="top" title="Sedang Direview COO" data-leaves-id="{{ $leaves->id }}"
            href="{{ route('request-leave.show', $leaves->id) }}">
            <i class="fas fa-eye"></i>
        </a>
    @elseif($leaves->status_manager == 2 && $leaves->status_coo == 0)
        <a class="btn btn-sm bg-primary text-white font-weight-bold text-xs detail-user" data-toggle="tooltip"
            data-placement="top" title="Detail & Review" data-leaves-id="{{ $leaves->id }}"
            href="{{ route('request-leave.edit', $leaves->id) }}">
            <i class="fas fa-eye"></i> Detail & Review
        </a>
    @elseif($leaves->status_manager == 2 && $leaves->status_coo == 1)
        <a class="btn btn-sm bg-info text-white font-weight-bold text-xs detail-user" data-toggle="tooltip"
            data-placement="top" title="Detail & Review" data-leaves-id="{{ $leaves->id }}"
            href="{{ route('request-leave.edit', $leaves->id) }}">
            <i class="fas fa-search mr-2"></i> Sedang Anda Review
        </a>
        <a class="btn btn-sm bg-primary text-white font-weight-bold text-xs" data-toggle="tooltip"
            data-placement="top" title="Sedang Direview COO" data-leaves-id="{{ $leaves->id }}"
            href="{{ route('request-leave.show', $leaves->id) }}">
            <i class="fas fa-eye"></i>
        </a>
    @elseif($leaves->status_manager == 2 && $leaves->status_coo == 2)
        <a class="btn btn-sm bg-success text-white font-weight-bold text-xs detail-user" data-toggle="tooltip"
            data-placement="top" title="Detail & Review" data-leaves-id="{{ $leaves->id }}"
            href="{{ route('request-leave.edit', $leaves->id) }}">
            <i class="fas fa-check mr-2"></i> Disetujui oleh COO
        </a>
        <a class="btn btn-sm bg-primary text-white font-weight-bold text-xs" data-toggle="tooltip"
            data-placement="top" title="Sedang Direview COO" data-leaves-id="{{ $leaves->id }}"
            href="{{ route('request-leave.show', $leaves->id) }}">
            <i class="fas fa-eye"></i>
        </a>
    @elseif($leaves->status_manager == 2 && $leaves->status_coo == 3)
        <a class="btn btn-sm bg-danger text-white font-weight-bold text-xs detail-user" data-toggle="tooltip"
            data-placement="top" title="Detail & Review" data-leaves-id="{{ $leaves->id }}"
            href="{{ route('request-leave.edit', $leaves->id) }}">
            <i class="fas fa-times mr-2"></i> Ditolak oleh COO
        </a>
        <a class="btn btn-sm bg-primary text-white font-weight-bold text-xs" data-toggle="tooltip"
            data-placement="top" title="Sedang Direview COO" data-leaves-id="{{ $leaves->id }}"
            href="{{ route('request-leave.show', $leaves->id) }}">
            <i class="fas fa-eye"></i>
        </a>
    @elseif($leaves->status_manager == 3)
        <a class="btn btn-sm bg-danger text-white font-weight-bold text-xs" data-toggle="tooltip"
            data-placement="top" title="Rejected by Manager">
            <i class="fas fa-times mr-2"></i> Ditolak oleh {{ $leaves->user->manager->position->name }}
        </a>
        <a class="btn btn-sm bg-primary text-white font-weight-bold text-xs" data-toggle="tooltip"
            data-placement="top" title="Sedang Direview COO" data-leaves-id="{{ $leaves->id }}"
            href="{{ route('request-leave.show', $leaves->id) }}">
            <i class="fas fa-eye"></i>
        </a>
    @endif
@endif
@endcan
