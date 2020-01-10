<?php

if (!function_exists('opus_blog_load_widgets')) :
    
    /**
     * Load widgets.
     *
     * @since 1.0.0
     */
    function opus_blog_load_widgets()
    {
        
        // Highlight Post.
        register_widget('Opus_Blog_Featured_Post');
        
        // Author Widget.
        register_widget('Opus_Blog_Author_Widget');
        
        // Social Widget.
        register_widget('Opus_Blog_Social_Widget');
        
    }

endif;
add_action('widgets_init', 'opus_blog_load_widgets');