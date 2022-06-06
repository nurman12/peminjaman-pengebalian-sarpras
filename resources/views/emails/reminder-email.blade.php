@component('mail::message')
# Pengingat

Kepada Yth,<br>

{{$users->name}},<br>

Polinema PSDKU di Kediri

Saya memberitahukan bahwa peminjaman dengan keterangan:

@component('mail::table')
|Keperluan|Mulai kegiatan|Akhir Kegiatan|Pengambilan sarpras|
|:--------|:-------------|:-------------|:------------------|
@foreach($reminders as $reminder)
<?php
$peminjaman = App\Models\Pengembalian::where('validasi_id', $reminder['id'])->first();
?>
|{{$reminder['keperluan']}}|{{ date('l, d F Y', strtotime($reminder['tanggal_start'])) }}|{{ date('l, d F Y', strtotime($reminder['tanggal_finish'])) }}|{{ date('l, d F Y', strtotime($peminjaman['date_ambil']))}}|
<?php
$draft = App\Models\Draft::where('validasi_id', $reminder['id'])->get();
?>

|Nama|Jumlah|
|:---|:-----|
@foreach($draft as $data)
|{{$data->sarpras->nama}}|{{$data->qty}}|
@endforeach
@endforeach

Akan berakhir hari ini, mohon untuk mengembalikan sarpras tepat waktu
@endcomponent

Terima Kasih,<br>
BMN
@endcomponent