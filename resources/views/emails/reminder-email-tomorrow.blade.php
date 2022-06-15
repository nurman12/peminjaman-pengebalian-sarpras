@component('mail::message')
# Pengingat

Kepada Yth,<br>

{{$users->name}},<br>

Polinema PSDKU di Kediri

Saya memberitahukan bahwa peminjaman dengan keterangan:

@component('mail::table')
|Keperluan|Mulai kegiatan|Akhir Kegiatan|Pengambilan sarpras|
|:--------|:-------------|:-------------|:------------------|
@foreach($tomorrows as $reminder)
<?php
$peminjaman = App\Models\Pengembalian::where('validasi_id', $reminder['id'])->first();
?>
|{{$reminder['keperluan']}}|{{ date('d F Y', strtotime($reminder['tanggal_start'])) }}|{{ date('d F Y', strtotime($reminder['tanggal_finish'])) }}|{{ date('d F Y', strtotime($peminjaman['date_ambil']))}}|
<?php
$draft = App\Models\Draft::where('validasi_id', $reminder['id'])->get();
?>

|Nama|Jumlah|
|:---|:-----|
@foreach($draft as $data)
|{{$data->sarpras->nama}}|{{$data->qty}}|
@endforeach
@endforeach

Akan berakhir besok, mohon untuk mengembalikan sarpras tepat waktu
@endcomponent

Terima Kasih,<br>
BMN
@endcomponent