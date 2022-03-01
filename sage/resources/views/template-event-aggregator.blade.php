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
<?php
$response = wp_remote_get('https://events.prephoops.com/api/events?website_id=1&type=tournament&date=upcoming&sortBy=start_date');
$body = json_decode(wp_remote_retrieve_body($response), true);

?>
  <div class=" upcomingEvents">
    <?php
    $countColumn = 0;
    foreach ($body as $event) {
    $countColumn++;
    if ($countColumn == 1) {
    ?>
    <div class="card-group">
      <?php
      }
      ?>
      <div class="card">
        <img alt="<?php echo $event['title']; ?> logo" src="<?php echo $event['logo']; ?>" class="card-img-top mx-auto" />
        <div class="card-body">
          <h4 class="card-title"><strong><?php echo $event['title']; ?></strong></h4>
        </div>
        <div class="card-footer">
          <a href="<?php echo $event['registration_url']; ?>" target="_blank" class="btn btn-primary">
            View Event
          </a>
        </div>
      </div>
      <?php
      if ($countColumn == 3) {
      $countColumn = 0;
      ?>
    </div>
    <?php
    }
    }
    if ($countColumn != 0) {
    ?>
  </div>
  <?php
  }
  ?>
    <!-- Event aggregator end -->

  @endwhile
@endsection
