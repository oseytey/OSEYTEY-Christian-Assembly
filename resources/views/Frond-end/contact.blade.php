@extends('Frond-end.layouts.master-layouts')

@section('title','Contact Us | OSEYTEY Christian Assembly')

@section('content')
<div class="page-header" style="background-image: url('{{ asset('vendor/img/contact-bg.jpg') }}');">
    <h4 class="kh-head text-white m-0">ទំនាក់ទំនងយើង</h4>
</div>

<div class="container kh-text">
    <div class="row mt-3">
        <div class="col-md-4">
            <h5 class="contact-title ps-5">គ្រូគង្វាលច្បង</h5>
            <hr>
            <ul class="contact-li">
                <li>
                    <i class="fa-solid fa-user-tie"></i> ព្រឹទ្ធបូជាចារ្យ ហុង សន
                </li>
                <li>
                    <i class="fa-solid fa-square-phone-flip"></i> +855 96 600 44 67
                </li>
                <li>
                    <i class="fa-solid fa-envelope"></i> សារអេឡិវត្រូនិក
                </li>
            </ul>
        </div>
        <div class="col-md-4">
            <h5 class="contact-title ps-5">គ្រូគង្វាល</h5>
            <hr>
            <ul class="contact-li">
                <li>
                    <i class="fa-solid fa-user-tie"></i> ព្រឹទ្ធបូជាចារ្យ ហុង ចាន់ណារុំ
                </li>
                <li>
                    <i class="fa-solid fa-square-phone-flip"></i> +855 16 222 620
                </li>
                <li>
                    <i class="fa-solid fa-envelope"></i> hongchannarom@gmail.com
                </li>
            </ul>
        </div>
        <div class="col-md-4">
            <h5 class="contact-title ps-5">រដ្ឋាបាលក្រុមជំនុំ</h5>
            <hr>
            <ul class="contact-li">
                <li>
                    <i class="fa-solid fa-user-tie"></i> ផ្នែកអភិវឌ្ឍន៍គេហទំព័រ
                </li>
                <li>
                    <i class="fa-solid fa-square-phone-flip"></i> 
                </li>
                <li>
                    <i class="fa-solid fa-envelope"></i> info@oseyteychurch.com
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="mt-3">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3921.375434315273!2d103.51771657629605!3d10.627913889511916!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3107e1d6063362bf%3A0xc9ce1b279f1d1235!2sOSEYTEY%20Christian%20Assembly!5e0!3m2!1sen!2skh!4v1792429006722!5m2!1sen!2skh" width="100%" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>
</div>

@endsection