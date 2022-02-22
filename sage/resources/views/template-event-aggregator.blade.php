{{--
  Template Name: Event Aggregator
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.page-header')
    @include('partials.content-page')
    
    <h1 class="mt-5 mb-4 font-weight-bold">Upcoming Events</h1>

    <!-- Event aggregator start -->

    <!-- Event aggregator end -->

  @endwhile
@endsection