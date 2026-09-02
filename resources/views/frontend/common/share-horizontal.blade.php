{{-- icons--}}
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
{{--CSS--}}
<style>
    .addthis-style {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
    }

    .addthis-style .btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 10px;      /* ⬅ smaller padding */
        border-radius: 5px;     /* ⬅ slightly tighter */
        font-size: 12px;        /* ⬅ smaller text */
        font-weight: 600;
        color: #fff;
        text-decoration: none;
        line-height: 1;
        transition: opacity .2s ease;
    }

    .addthis-style .btn:hover {
        opacity: .85;
    }

    .addthis-style i {
        font-size: 13px;        /* ⬅ smaller icons */
    }

    /* Colors (unchanged) */
    .fb   { background:#1877f2; }
    .x    { background:#000; }
    .pin  { background:#e60023; }
    .in   { background:#0a66c2; }
    .wa   { background:#25d366; }
    .mail { background:#8c8c8c; }



</style>

{{--  HTML--}}
@php
    $url   = urlencode(url()->current());
    $title = urlencode($title ?? config('app.name'));
@endphp

<div class="addthis-style">
    <a class="btn fb"
       href="https://www.facebook.com/sharer/sharer.php?u={{ $url }}"
       target="_blank">
        <i class="fab fa-facebook-f"></i> Share
    </a>

    <a class="btn x"
       href="https://twitter.com/intent/tweet?url={{ $url }}&text={{ $title }}"
       target="_blank">
        <i class="fab fa-x-twitter"></i> Post
    </a>

    <a class="btn pin"
       href="https://pinterest.com/pin/create/button/?url={{ $url }}"
       target="_blank">
        <i class="fab fa-pinterest-p"></i> Pin
    </a>

    <a class="btn in"
       href="https://www.linkedin.com/sharing/share-offsite/?url={{ $url }}"
       target="_blank">
        <i class="fab fa-linkedin-in"></i> Share
    </a>

    <a class="btn wa"
       href="https://wa.me/?text={{ $url }}"
       target="_blank">
        <i class="fab fa-whatsapp"></i> Share
    </a>


</div>
