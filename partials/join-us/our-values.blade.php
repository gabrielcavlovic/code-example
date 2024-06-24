<?php
$top_title = get_field('our_values_top_title');
$title = get_field('our_values_title');
$description = get_field('our_values_description');
$rectangle_text1 = get_field('rectangle_1_text');
$rectangle_text2 = get_field('rectangle_2_text');
$rectangle_text3 = get_field('rectangle_3_text');
$rectangle_text4 = get_field('rectangle_4_text');
$quote = get_field('quote');
$quote_author = get_field('quote_author');
?>
<section class="our-values" id="join-our-values" data-bgcolor="#FBFAF9">
    <div class="our-values-inner" id="join-our-values-inner" data-scroll data-scroll-sticky data-scroll-target="#join-our-values">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1">
                    <div class="inner">
                        <div class="text-col">
                            <div class="module-text-box" data-appear-stagger>
                                <span class="eyebrow mint">{{ $top_title }}</span>
                                <h2>{{ $title }}</h2>
                                <div class="txt">
                                    <p>{{ $description }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="values-col" id="our-values-panel">
                            <div class="values">
                                <div class="panel panel-1"><span>{{ $rectangle_text1 }}</span></div>
                                <div class="panel panel-2"><span>{{ $rectangle_text2 }}</span></div>
                                <div class="panel panel-3"><span>{{ $rectangle_text3 }}</span></div>
                                <div class="panel panel-4"><span>{{ $rectangle_text4 }}</span></div>
                            </div>
                            <div class="decor">
                                <div id="our-values-panel-decor"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="container join-us__quote" data-bgcolor="#D6E6FF" >
    <h2 data-split-text-animate>
         {{ $quote }}
    </h2>
    <span class="overline-large" data-split-text-animate-next>{{ $quote_author }}</span>
</div>
