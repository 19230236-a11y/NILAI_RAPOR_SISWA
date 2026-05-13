<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rapor {{ $student->name }}</title>
    <title>Arsip Rapor {{ $student->name }}</title>
        body {
        @page {
            margin: 24px 28px;
        }

            font-family: DejaVu Sans, sans-serif;
            <meta charset="UTF-8">
            <title>Arsip Rapor {{ $student->name }}</title>
            color: #1f2937;
                @page {
                    margin: 22px 26px;
        .header {
        .sheet {
            width: 100%;
                    font-size: 11px;
        .title {
        .header {
            text-align: center;
            border-bottom: 2px solid #111827;
            padding-bottom: 10px;
                    display: table;
                    width: 100%;
                    border-bottom: 2px solid #111827;
                    padding-bottom: 10px;
                    margin-bottom: 14px;
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
            margin: 0;

        .class-title {
        .subtitle {
            margin: 2px 0 0;
            font-size: 11px;
            color: #4b5563;
        }

        .title {
            font-size: 14px;
        }
            margin: 0;
                    margin: 0;
                    font-size: 14px;
                    font-weight: bold;
                    letter-spacing: 0.35px;
            <!DOCTYPE html>
            <html lang="id">
            <head>
                <meta charset="UTF-8">
                <title>Arsip Rapor {{ $student->name }}</title>
                <style>
                    @page {
                        margin: 24px 28px;
                    }

                    body {
                        font-family: DejaVu Sans, sans-serif;
                        font-size: 11px;
                        line-height: 1.45;
                        color: #1f2937;
                    }

                    .sheet {
                        width: 100%;
                    }

                    .header {
                        text-align: center;
                        border-bottom: 2px solid #111827;
                        padding-bottom: 10px;
                        margin-bottom: 14px;
                    }

                    .school-name {
                        font-size: 16px;
                        font-weight: bold;
                        text-transform: uppercase;
                        margin: 0;
                    }

                    .subtitle {
                        margin: 2px 0 0;
                        font-size: 11px;
                        color: #4b5563;
                    }

                    .title {
                        margin: 4px 0 0;
                        font-size: 14px;
                        font-weight: bold;
                        letter-spacing: 0.3px;
                    }

                    .student-box {
                        border: 1px solid #cbd5e1;
                        margin-bottom: 12px;
                    }

                    .student-box table {
                        width: 100%;
                        border-collapse: collapse;
                    }

                    .student-box td {
                        padding: 6px 8px;
                        border: 1px solid #cbd5e1;
                    }

                    .student-label {
                        width: 120px;
                        font-weight: bold;
                        background: #f8fafc;
                    }

                    .section-title {
                        margin: 12px 0 6px;
                        font-size: 12px;
                        font-weight: bold;
                        color: #111827;
                    }

                    .summary-grid {
                        width: 100%;
                        border-collapse: collapse;
                        margin-bottom: 10px;
                    }

                    .summary-grid td {
                        width: 25%;
                        border: 1px solid #d1d5db;
                        background: #f8fafc;
                        padding: 6px 8px;
                        vertical-align: top;
                    }

                    .summary-grid .label {
                        display: block;
                        font-size: 10px;
                        color: #6b7280;
                        margin-bottom: 2px;
                    }

                    .summary-grid .value {
                        font-size: 12px;
                        font-weight: bold;
                    }

                    .period-title {
                        margin: 8px 0 6px;
                        font-weight: bold;
                        color: #1d4ed8;
                    }

                    .class-block {
                        margin-bottom: 12px;
                        page-break-inside: avoid;
                    }

                    .page-break {
                        page-break-after: always;
                    }

                    table.detail {
                        width: 100%;
                        border-collapse: collapse;
                        margin-bottom: 10px;
                    }

                    table.detail th,
                    table.detail td {
                        border: 1px solid #d1d5db;
                        padding: 5px 6px;
                    }

                    table.detail th {
                        background: #e8eefc;
                        font-size: 10px;
                        text-align: left;
                    }

                    .text-center {
                        text-align: center;
                    }
                </style>
            </head>
            <body>
                <div class="sheet">
                    <div class="header">
                        <p class="school-name">Sistem Rapor Siswa</p>
                        <p class="subtitle">Arsip nilai rapor sekolah</p>
                        <p class="title">DOKUMEN RAPOR SISWA</p>
                    </div>

                    <div class="student-box">
                        <table>
                            <tr>
                                <td class="student-label">Nama Siswa</td>
                                <td>{{ $student->name }}</td>
                                <td class="student-label">NIS</td>
                                <td>{{ $student->nis }}</td>
                            </tr>
                            <tr>
                                <td class="student-label">Tanggal Cetak</td>
                                <td>{{ now()->format('d-m-Y H:i') }}</td>
                                <td class="student-label">Keterangan</td>
                                <td>Arsip nilai kelas 10-12</td>
                            </tr>
                        </table>
                    </div>

                    @foreach($gradesByClass as $classLabel => $classData)
                        <div class="class-block">
                            <div class="section-title">{{ $classLabel }}</div>
                            <table class="summary-grid">
                                <tr>
                                    <td><span class="label">Rata-rata</span><span class="value">{{ number_format($classData['summary']['avg'] ?? 0, 2) }}</span></td>
                                    <td><span class="label">Tertinggi</span><span class="value">{{ number_format($classData['summary']['max'] ?? 0, 2) }}</span></td>
                                    <td><span class="label">Terendah</span><span class="value">{{ number_format($classData['summary']['min'] ?? 0, 2) }}</span></td>
                                    <td><span class="label">Total Nilai</span><span class="value">{{ $classData['summary']['count'] }}</span></td>
                                </tr>
                            </table>

                            @foreach($classData['periods'] as $period => $periodGrades)
                                <div class="period-title">{{ $period }}</div>
                                <table class="detail">
                                    <thead>
                                        <tr>
                                            <th>Mapel</th>
                                            <th>Guru</th>
                                            <th class="text-center">Tugas</th>
                                            <th class="text-center">UTS</th>
                                            <th class="text-center">UAS</th>
                                            <th class="text-center">Nilai Akhir</th>
                                            <th class="text-center">Grade</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($periodGrades as $grade)
                                            @php
                                                $predikat = 'E';
                                                if ($grade->nilai_akhir >= 85) $predikat = 'A';
                                                elseif ($grade->nilai_akhir >= 75) $predikat = 'B';
                                                elseif ($grade->nilai_akhir >= 65) $predikat = 'C';
                                                elseif ($grade->nilai_akhir >= 55) $predikat = 'D';
                                            @endphp
                                            <tr>
                                                <td>{{ $grade->subject->name }}</td>
                                                <td>{{ $grade->teacher->name }}</td>
                                                <td class="text-center">{{ number_format($grade->nilai_tugas, 2) }}</td>
                                                <td class="text-center">{{ number_format($grade->nilai_uts, 2) }}</td>
                                                <td class="text-center">{{ number_format($grade->nilai_uas, 2) }}</td>
                                                <td class="text-center">{{ number_format($grade->nilai_akhir, 2) }}</td>
                                                <td class="text-center">{{ $predikat }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </body>
            </html>
