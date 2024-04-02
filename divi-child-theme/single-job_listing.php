<?php

get_header();

$show_default_title = get_post_meta(get_the_ID(), '_et_pb_show_title', true);

$is_page_builder_used = et_pb_is_pagebuilder_used(get_the_ID());

?>

<div id="main-content">
  <?php
  if (et_builder_is_product_tour_enabled()):
    // load fullwidth page in Product Tour mode
    while (have_posts()):
      the_post(); ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class('et_pb_post'); ?>>
                  <div class="entry-content">
                  <?php
                  the_content();
                  ?>
                  </div>

                </article>

        <?php endwhile;
  else:
    ?>
      <div class="container al_tb">
        <div id="content-area" class="clearfix">
          <div id="main-area" class="al_area">


            <!--  custom edited bit contained below by Allwell.DEV -->

      
          <div class="al_hero-banner-container">
            <div class="al_hero-banner">

            <div class="et_pb_module difl_breadcrumbs difl_breadcrumbs_0 al_job-listing-breadcrumbs">
            <div class="et_pb_module_inner">
              <div class="df_breadcrumbs_container">
                <script type="application/ld+json">{"@context":"https:\/\/schema.org\/","@type":"BreadcrumbList","itemListElement":[{"@type":"ListItem","position":1,"name":" Home","item":"https:\/\/tekseries.local\/"},{"@type":"ListItem","position":2,"name":"Job Series","item":""}]}</script>
                <div class="df_breadcrumbs_wrapper">
                    <ul class="df-breadcrumbs">
                      <li class="df-breadcrumbs-item df-breadcrumbs-start"><a href="/"  rel="home"><span class="df-breadcrumbs-text"> <span class="df-breadcrumbs-home-icon"><span class="et-pb-icon df-home-icon">&#xe074</span></span> Home</span></a></li>
                      <li class="df-breadcrumbs-separator"><span class="df-breadcrumbs-separator-text"> / </span></li>
                      <li class="df-breadcrumbs-item"><a href="/jobs" rel="jobs"><span class="df-breadcrumbs-text">Jobs</span></a></li>
                      <li class="df-breadcrumbs-separator"><span class="df-breadcrumbs-separator-text"> / </span></li>
                      <li class="df-breadcrumbs-item df-breadcrumbs-end"><span class="df-breadcrumbs-text"><?php the_title(); ?></span></li>
                    </ul>
                </div>
              </div>
            </div>
            </div>

            </div>

          </div>


            <!-- custom edited bit contained above by Allwell.DEV -->

          <?php while (have_posts()):
            the_post(); ?>
                <?php
                /**
                 * Fires before the title and post meta on single posts.
                 *
                 * @since 3.18.8
                 */
                do_action('et_before_post');
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('et_pb_post'); ?>>
                <div class="al_job-listing-page-container">
                <div class="al_job-listing-page-row">
                  <?php if (('off' !== $show_default_title && $is_page_builder_used) || !$is_page_builder_used) { ?>
                        <div class="et_post_meta_wrapper">
                              <h1 class="entry-title"><?php the_title(); ?></h1>

                        <?php
                        if (!post_password_required()):

                          // et_divi_post_meta();
                  
                          $thumb = '';

                          $width = (int) apply_filters('et_pb_index_blog_image_width', 1080);

                          $height = (int) apply_filters('et_pb_index_blog_image_height', 675);
                          $classtext = 'et_featured_image';
                          $titletext = get_the_title();
                          $alttext = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true);
                          $thumbnail = get_thumbnail($width, $height, $classtext, $alttext, $titletext, false, 'Blogimage');
                          $thumb = $thumbnail["thumb"];

                          $post_format = et_pb_post_format();

                          if ('video' === $post_format && false !== ($first_video = et_get_first_video())) {
                            /* removed thumbnail image edited by Allwell.DEV */
                            /* printf(     
                                       '<div class="et_main_video_container">
                                         %1$s
                                       </div>',
                                       et_core_esc_previously( $first_video )
                                     ) */
                            ;
                          } else if (!in_array($post_format, array('gallery', 'link', 'quote')) && 'on' === et_get_option('divi_thumbnails', 'on') && '' !== $thumb) {
                            // print_thumbnail( $thumb, $thumbnail["use_timthumb"], $alttext, $width, $height ); /* removed thumbnail image edited by Allwell.DEV */
                          } else if ('gallery' === $post_format) {
                            // et_pb_gallery_images(); /* removed thumbnail image edited by Allwell.DEV */
                          }
                          ?>

                              <?php
                              $text_color_class = et_divi_get_post_text_color();

                              $inline_style = et_divi_get_post_bg_inline_style();

                              switch ($post_format) {
                                case 'audio':
                                  $audio_player = et_pb_get_audio_player();

                                  if ($audio_player) {
                                    printf(
                                      '<div class="et_audio_content%1$s"%2$s>
													%3$s
												</div>',
                                      esc_attr($text_color_class),
                                      et_core_esc_previously($inline_style),
                                      et_core_esc_previously($audio_player)
                                    );
                                  }

                                  break;
                                case 'quote':
                                  printf(
                                    '<div class="et_quote_content%2$s"%3$s>
												%1$s
											</div>',
                                    et_core_esc_previously(et_get_blockquote_in_content()),
                                    esc_attr($text_color_class),
                                    et_core_esc_previously($inline_style)
                                  );

                                  break;
                                case 'link':
                                  printf(
                                    '<div class="et_link_content%3$s"%4$s>
												<a href="%1$s" class="et_link_main_url">%2$s</a>
											</div>',
                                    esc_url(et_get_link_url()),
                                    esc_html(et_get_link_url()),
                                    esc_attr($text_color_class),
                                    et_core_esc_previously($inline_style)
                                  );

                                  break;
                              }

                        endif;
                        ?>
                      </div>
                <?php } ?>

                  <div class="entry-content">
                  <?php
                  do_action('et_before_content');

                  the_content();

                  wp_link_pages(array('before' => '<div class="page-links">' . esc_html__('Pages:', 'Divi'), 'after' => '</div>'));
                  ?>
                  </div>
                  <div class="et_post_meta_wrapper">
                  <?php
                  if (et_get_option('divi_468_enable') === 'on') {
                    echo '<div class="et-single-post-ad">';
                    if (et_get_option('divi_468_adsense') !== '')
                      echo et_core_intentionally_unescaped(et_core_fix_unclosed_html_tags(et_get_option('divi_468_adsense')), 'html');
                    else { ?>
                              <a href="<?php echo esc_url(strval(et_get_option('divi_468_url'))); ?>"><img src="<?php echo esc_attr(et_get_option('divi_468_image')); ?>" alt="468" class="foursixeight" /></a>
                    <?php }
                    echo '</div>';
                  }

                  /**
                   * Fires after the post content on single posts.
                   *
                   * @since 3.18.8
                   */
                  do_action('et_after_post');

                  if ((comments_open() || get_comments_number()) && 'on' === et_get_option('divi_show_postcomments', 'on')) {
                    comments_template('', true);
                  }
                  ?>
                  </div>
                </div>
                </div>
                </article>

          <?php endwhile; ?>
          </div>
            
          <?php /* get_sidebar(); */ ?> <!-- remove sidebar containing comments edited by Allwell.DEV -->
        </div>
      </div>
  <?php endif; ?>
</div>

<?php

get_footer();
