@component('mail::message')
# Pengingat

<p>Yth. {{$users->roles}} Polinema PSDKU di Kediri</p> <br>

Terima kasih atas pertisipasi anda dengan memanfaatkan fasilitas kampus dengan melakukan peminjaman pada BMN <br>
@foreach($tomorrows as $reminder)
<?php
$peminjaman = App\Models\Pengembalian::where('validasi_id', $reminder['id'])->first();
?>
<p>
    Sebagai bagian dari rangkaian peminjaman, kami bermaksud mengingatkan Anda untuk melakukan pengembalian sarana prasarana yang anda
    pinjam dari rentan waktu antara tanggal {{ date('d F', strtotime($reminder['tanggal_start'])) }} sampai {{ date('d F Y', strtotime($reminder['tanggal_finish'])) }}.
    yang anda ambil pada tanggal {{ date('d F Y', strtotime($peminjaman['date_ambil']))}}
</p> <br>
<p>Cara mengembalikan peminjaman adalah sebagai berikut:</p>
<ul>
    <li>Buka Website <a href="https://peminjaman.my.id">https://peminjaman.my.id</a> </li>
    <li>Masukkan NIM / NIDN dan Password akun yang anda gunakan untuk proses peminjaman</li>
    <li>Setelah login akan muncul pop up data peminjaman yang dilakukan, jika pop up tidak muncul click menu modul kemudian pilih peminjaman</li>
    <li>Download draft peminjaman dan bawa sarana prasana yang anda pinjam</li>
</ul>

<p>Berikut ini saya berikan data peminjaman sarana prasana yang harus anda kembalikan</p>
@component('mail::table')
<?php
$draft = App\Models\Draft::where('validasi_id', $reminder['id'])->get();
?>

|Nama|Jumlah|
|:---|:-----|
@foreach($draft as $data)
|{{$data->sarpras->nama}}|{{$data->qty}}|
@endforeach
@endforeach

# Perhatian : Proses peminjaman akan berakhir besok, mohon untuk mengembalikan sarpras tepat waktu
@endcomponent

Segera selesaikan tanggungan anda dan semoga tidak ada kendala.

Salam,<br>
BMN Polinema PSDKU di Kediri

@endcomponent