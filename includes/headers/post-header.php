<?php
  $tdl_options = eva_global_var();
  $page_for_posts = get_option('page_for_posts');
  $blog = get_post($page_for_posts);      
?>

        <div class="page-header animated fadeIn">
          <div class="row">
            <div class="title-section">
              <?php echo eva_breadcrumbs(); ?>
              <h1 class="page-title"><?php the_title(); ?></h1>
              <div class="post_header_meta"><?php eva_post_entry_meta(); ?></div>
            </div>
          </div>
        </div>


