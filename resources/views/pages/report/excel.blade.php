<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $year }} - {{ $divisionName }}</title>
</head>

<body>
    @foreach ($groupedLeaves as $month => $leaves)
        <div class="container">
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td style="font-weight: bold; background-color: #6777EF; color: #FFFFFF;">LAPORAN PENGAJUAN CUTI</td>

                    </tr>
                    <tr>
                        <td></td>
                        <td style="font-weight: bold; background-color: #6777EF; color: #FFFFFF;">{{ $month }} {{ $year }} - Divisi {{ $divisionName }}</td>
                    </tr>
                    
                </tbody>
            </table>

            {{-- <table></table> --}}

            <table border="1" style="border: 1px solid black;">
                <thead>
                    <tr>
                        <th></th>
                        <th style="font-weight: bold; background-color: #6777EF; color: #FFFFFF; border: 1px solid black; text-align: center;">No</th>
                        <th style="font-weight: bold; background-color: #6777EF; color: #FFFFFF; border: 1px solid black;">Kode</th>
                        <th style="font-weight: bold; background-color: #6777EF; color: #FFFFFF; border: 1px solid black;">Nama</th>
                        <th style="font-weight: bold; background-color: #6777EF; color: #FFFFFF; border: 1px solid black;">Tipe</th>
                        <th style="font-weight: bold; background-color: #6777EF; color: #FFFFFF; border: 1px solid black;">Tanggal Pengajuan</th>
                        <th style="font-weight: bold; background-color: #6777EF; color: #FFFFFF; border: 1px solid black;">Tanggal Mulai</th>
                        <th style="font-weight: bold; background-color: #6777EF; color: #FFFFFF; border: 1px solid black;">Tanggal Selesai</th>
                        <th style="font-weight: bold; background-color: #6777EF; color: #FFFFFF; border: 1px solid black;">Lama Hari</th>
                        <th style="font-weight: bold; background-color: #6777EF; color: #FFFFFF; border: 1px solid black;">Alasan</th>
                        <th style="font-weight: bold; background-color: #6777EF; color: #FFFFFF; border: 1px solid black;">Status</th>
                        <th style="font-weight: bold; background-color: #6777EF; color: #FFFFFF; border: 1px solid black;">Kepala Divisi</th>
                        <th style="font-weight: bold; background-color: #6777EF; color: #FFFFFF; border: 1px solid black;">Kepala Operasional</th>
                        <th style="font-weight: bold; background-color: #6777EF; color: #FFFFFF; border: 1px solid black;">Tanggal Approval Divisi</th>
                        <th style="font-weight: bold; background-color: #6777EF; color: #FFFFFF; border: 1px solid black;">Tanggal Approval Operasional</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $nomor = 1;
                    @endphp
                    @foreach ($leaves as $leave)
                        <tr>
                            <td></td>
                            <td style="border: 1px solid black; text-align: center;">{{ $nomor++ }}</td>
                            <td style="border: 1px solid black;">#{{ $leave->code }}</td>
                            <td style="border: 1px solid black;">{{ $leave->user->full_name ?? '-' }}</td>
                            <td style="border: 1px solid black;">{{ $leave->type->name ?? '-' }}</td>
                            <td style="border: 1px solid black;">{{ \Carbon\Carbon::parse($leave->created_at)->isoFormat('D MMMM Y') ?? '-' }}</td>
                            <td style="border: 1px solid black;">{{ \Carbon\Carbon::parse($leave->start_date)->isoFormat('D MMMM Y') ?? '-' }}</td>
                            <td style="border: 1px solid black;">{{ \Carbon\Carbon::parse($leave->end_date)->isoFormat('D MMMM Y') ?? '-' }}</td>
                            <td style="border: 1px solid black;">{{ $leave->duration ?? '-' }} Hari</td>
                            <td style="border: 1px solid black;">{{ $leave->reason ?? '-' }}</td>
                            <td style="border: 1px solid black;">
                                @php
                                    switch ($leave->status_coo) {
                                        case 0:
                                            echo 'Pending';
                                            break;
                                        case 1:
                                            echo 'Direview';
                                            break;
                                        case 2:
                                            echo 'Disetujui';
                                            break;
                                        case 3:
                                            echo 'Ditolak';
                                            break;
                                        default:
                                            echo 'Unknown';
                                            break;
                                    }
                                @endphp
                            </td>
                            <td style="border: 1px solid black;">{{ $leave->manager->full_name ?? '-' }}</td>
                            <td style="border: 1px solid black;">{{ $leave->coo->full_name ?? '-' }}</td>
                            <td style="border: 1px solid black;">{{ \Carbon\Carbon::parse($leave->date_manager)->isoFormat('D MMMM Y') ?? '-' }}</td>
                            <td style="border: 1px solid black;">{{ \Carbon\Carbon::parse($leave->date_coo)->isoFormat('D MMMM Y') ?? '-' }}</td>

                        </tr>
                    @endforeach

                    <!-- Tambahkan data lainnya di sini -->
                </tbody>
            </table>
        </div>
    @endforeach

</body>

</html>
