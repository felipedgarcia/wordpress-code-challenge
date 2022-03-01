{{--
  Template Name: Post Aggregator
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.page-header')
    @include('partials.content-page')

    <h1 class="mt-5">Recent Posts</h1>

    <?php
    $args = array(
        'posts_per_page' => 10,
        'post_status' => 'publish',
        'state' => 'Minnesota'
    );

    $posts = new \WP_Query($args);

    if ($posts->have_posts()) {
        while ($posts->have_posts()) {
            $posts->the_post();
            ?>
            <div class="card py-4 px-3 mb-4">
                <a class="text-dark" href="<?php the_permalink(); ?>">
                    <h4 class="mb-2">
                        <?php echo mb_strimwidth(the_title('', '', false), 0, 30, '...'); ?>
                    </h4>
                    <span class="badge badge-success"><?php echo get_the_category()[0]->name; ?></span>
                    <span class="badge badge-primary"><?php  echo wp_get_post_terms(get_the_ID(), 'state')[0]->name; ?></span>
                </a>
            </div>
            <?php
        }
    }
    ?>

  @endwhile
@endsection
