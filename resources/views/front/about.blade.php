@extends('front.layouts.index')
@push('title', 'About')
@section('content')
<!-- Title page -->
<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('{{ asset('/front') }}/images/gedung-a.jpg');">
    <h2 class="ltext-105 cl0 txt-center">
        About
    </h2>
</section>


<!-- Content page -->
<section class="bg0 p-t-75 p-b-120">
    <div class="container">
        <div class="row p-b-148">
            <div class="col-md-7 col-lg-8">
                <div class="p-t-7 p-r-85 p-r-15-lg p-r-0-md">
                    <h3 class="mtext-111 cl2 p-b-16">
                        Tentang
                    </h3>

                    <p class="stext-113 cl6 p-b-26">
                        Pengelola BMN merupakan aplikasi perangkat lunak berbasis web yang digunakan untuk melakukan penyimpanan dan pengolahan data-data Permohonan Peminjaman Barang dan Ruangan bagi staf atau dosen di Politeknik Negeri Malang PSDKU Kediri serta digunakan untuk menyimpan dan pengelolaan Pengarsipan Ketersediaan untuk staf BMN Pusat Komputer.
                    </p>

                    <p class="stext-113 cl6 p-b-26">
                        Politeknik Negeri Malang PSDKU Kediri terus berupaya meningkatkan kualitas layanan baik kepada para mahasiswa, dosen dan karyawan. Penigkatan kualitas layanan tersebut dilakukan dalam rangka mencapai visi institusi, yaitu menjadi perguruan tinggi vokasi yang unggul dalam persaingan global. Dengan kualitas layanan yang baik, maka akan terbentuk sinergitas fungsi kerja dari semua elemen yang ada di dalam institusi.
                    </p>
                    <div class="bor16 p-l-29 p-b-9 m-t-22">
                        <p class="stext-114 cl6 p-r-40 p-b-11">
                            Tidaklah setiap kalian kecuali sebagai seorang tamu, dan seluruh hartanya adalah pinjaman. <br>maka sang tamu pun akan pulang dan pinjamannya akan dikembalikan kepada pemiliknya.
                        </p>

                        <span class="stext-111 cl8">
                            - Ibnu Masud
                        </span>
                    </div>
                </div>
            </div>

            <!-- <div class="col-11 col-md-5 col-lg-4 m-lr-auto">
                <div class="how-bor1 ">
                    <div class="hov-img0">
                        <img src="{{ asset('/front') }}/images/about-01.jpg" alt="IMG">
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</section>
@endsection