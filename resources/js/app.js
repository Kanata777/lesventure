import './bootstrap';
import 'slick-carousel/slick/slick';
import 'slick-carousel/slick/slick.css';
import 'slick-carousel/slick/slick-theme.css';

import $ from 'jquery';

$(document).ready(function () {
    $('.carousel-container').slick({
        arrows: true, // ✅ Aktifkan tombol panah
        dots: true,
        autoplay: true,
        autoplaySpeed: 3000,
    });
});
