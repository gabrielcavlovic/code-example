<?php
$title_text1 = get_field('benefits_title_text_1');
$title_text2 = get_field('benefits_title_text_2');
$title_text3 = get_field('benefits_title_text_3');
$description = get_field('benefits_description');
$benefits = get_field('benefits');

$i = 0;
?>

<section class="benefits" data-end="50%" data-bgcolor="#0058DD">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <div class="headline" data-appear-stagger  >
                    <div class="decor-1">
                        <img src="{{ asset('images/decor-01.svg') }}" width="156" alt="">
                    </div>
                    <div class="decor-2">
                        <img src="{{ asset('images/decor-02.svg') }}" width="56" alt="">
                    </div>
                    <div class="decor-3">
                        <img src="{{ asset('images/decor-03.svg') }}" width="200" alt="">
                    </div>
                    <h2>
                        <span class="lg">{{ $title_text1 }}</span>
                        <span class="md">{{ $title_text2 }}</span>
                        <span class="sm">{{ $title_text3 }}</span>
                    </h2>
                </div>
                <div class="row" data-appear-stagger  >
                    <div class="col-sm-6">
                        <div class="text-wrap">
                            <p>{{ $description }}</p>
                        </div>
                        <picture class="illustration">
                            <source media="(max-width: 1023px)"
                                srcset="{{ asset('images/illustrate-13-md.svg') }}">
                            <img src="{{ asset('images/illustrate-13.svg') }}" width="364" alt="">
                        </picture>
                    </div>
                    <div class="col-sm-6">
                        <ul class="accordion accordion-blue" data-accordion >
                            @if(is_array($benefits))
                                @foreach($benefits as $benefit)
                                <?php $i++; ?>
                                <li {{ $i === 3? 'data-bgcolor="#D6E6FF"' : ''}}>
                                    <a href="#" class="{{ $i === 1 ? 'active' : ''}}" data-more>
                                        {{ $benefit['title'] }}
                                        <span class="caret"></span>
                                    </a>
                                    <div class="more-content">
                                        <p>{{ $benefit['description'] }}</p>
                                    </div>
                                </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>