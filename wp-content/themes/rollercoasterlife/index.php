<?php get_header(); ?>
    <?php if ( have_posts() ) : ?>
    <?php while ( have_posts() ) : the_post(); ?>
      <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="post-header">
           <div class="date"><?php the_time( 'M j y' ); ?></div>
           <h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
           <div class="author"><?php the_author(); ?></div>
        </div><!--end post header-->
        <div class="entry clear">
           <?php if ( function_exists( 'add_theme_support' ) ) the_post_thumbnail(); ?>
           <?php the_content(); ?>
           <?php edit_post_link(); ?>
           <?php wp_link_pages(); ?> </div>
        <!--end entry-->
        <div class="post-footer">
           <div class="comments"><?php comments_popup_link( 'Leave a Comment', '1 Comment', '% Comments' ); ?></div>
        </div><!--end post footer-->
        </div><!--end post-->
    <?php endwhile; /* rewind or continue if all posts have been fetched */ ?>
        <div class="navigation index">
           <div class="alignleft"><?php next_posts_link( 'Older Entries' ); ?></div>
           <div class="alignright"><?php previous_posts_link( 'Newer Entries' ); ?></div>
        </div><!--end navigation-->
    <?php else : ?>
    <?php endif; ?>
   <header>
        <div class="wrapper row">
            <div class="col-sm-6">
                <img class="img-responsive" src="<?=  get_template_directory_uri() . '/img/rollercoaster.png'?>" alt="Roller Coaster Life">
            </div>
            <div class="col-sm-6">
                <h1>Being a founder is an unhealthy pursuit at times. Startups are a full-contact sport.</h1>
                <p>If there's one thing that all entrepreneurs would agree about, it's that entrepreneurship is very much like a rollercoaster ride. It has it's ups, downs and all of the blurry parts in-between, which makes it a rewarding, but incredibly challenging journey. This book tells the stories (from other founders) to help you through this ride.</p>
                <form id="subscription-form" action="http://publicbeta.createsend.com/t/i/s/fdlty/" method="post">
                    <div class="form-group">
                        <input type="email" class="form-control" name="cm-fdlty-fdlty" id="email-subscription" placeholder="Your Email Address">
                    </div>
                    <input class="btn btn-download" type="submit" name="commit" id="commit-subscription" value="Free Download" onClick="_gaq.push(['_trackEvent', 'registration', 'download', 'main',, false]);">
                </form>
<!--                 <?php echo do_shortcode("[optin-cat id=25]"); ?> -->
            </div>
        </div>
    </header>
    
    <section id="share" class="wrapper">
        <h2>Enjoyed this? Please Share!</h2>
        <div id="socials">
            <span class='st_facebook_hcount' displayText='Facebook'></span>
            <span class='st_twitter_hcount' displayText='Tweet'></span>
            <span class='st_linkedin_hcount' displayText='LinkedIn'></span>
            <span class='st_googleplus_hcount' displayText='Google +'></span>
            <span class='st_stumbleupon_hcount' displayText='StumbleUpon'></span>
            <span class='st_email_hcount' displayText='Email'></span>       
        </div>     
    </section>

    <section id="previews" class="wrapper">
        <h2><i></i>Preview A Few Goodies (From The Book)</h2> 
        <div class="animtt" data-gen="fadeUp">
            <a class="samples" href="<?=  get_template_directory_uri() . '/img/previews/sample01.jpg'?>" rel="lightbox" title=""><img class="border" src="<?=  get_template_directory_uri() . '/img/previews/sample01t.jpg'?>" alt="sample01"></a>
            <a class="samples" href="<?=  get_template_directory_uri() . '/img/previews/sample02.jpg'?>" rel="lightbox" title=""><img class="border" src="<?=  get_template_directory_uri() . '/img/previews/sample02t.jpg'?>" alt="sample02"></a>
            <a class="samples" href="<?=  get_template_directory_uri() . '/img/previews/sample03.jpg'?>" rel="lightbox" title=""><img class="border" src="<?=  get_template_directory_uri() . '/img/previews/sample03t.jpg'?>" alt="sample03"></a>
            <a class="samples" href="<?=  get_template_directory_uri() . '/img/previews/sample04.jpg'?>" rel="lightbox" title=""><img class="border" src="<?=  get_template_directory_uri() . '/img/previews/sample04t.jpg'?>" alt="sample04"></a>
            <a class="samples" href="<?=  get_template_directory_uri() . '/img/previews/sample05.jpg'?>" rel="lightbox" title=""><img class="border" src="<?=  get_template_directory_uri() . '/img/previews/sample05t.jpg'?>" alt="sample05"></a>
            <a class="samples" href="<?=  get_template_directory_uri() . '/img/previews/sample06.jpg'?>" rel="lightbox" title=""><img class="border" src="<?=  get_template_directory_uri() . '/img/previews/sample06t.jpg'?>" alt="sample06"></a>
        </div>  
    </section>
<?php get_footer(); ?>