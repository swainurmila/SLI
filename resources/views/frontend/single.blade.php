@extends('frontend.layouts.app')
@section('content')


<section id="about-part">
    <div class="container">
        <div class="section-title3">
            <h3>{{Projects($page->id, 'title', $lang)}}</h3>
        </div>
        {!!  Projects($page->id, 'content', $lang)  !!}
    </div>
</section>
@endsection

@section('js')
@endsection
