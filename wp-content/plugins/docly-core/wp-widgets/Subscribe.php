<?php
namespace DoclyCore\WpWidgets;
use WP_Widget;

// About us
class Subscribe extends WP_Widget {
    public function __construct()  { // 'About us' Widget Defined
        parent::__construct( 'subscribe', esc_html__( '(Docly) Subscribe Form', 'docly-core'), array(
            'description'   => esc_html__( 'MailChimp Subscribe form.', 'docly-core'),
            'classname'     => 'subscribe_widget'
        ));
    }

    // Front End
    public function widget($args, $instance) {
        wp_enqueue_script( 'ajax-chimp');
        if ( ! isset( $args['widget_id'] ) ) {
            $args['widget_id'] = $this->id;
        }
        $title = function_exists('get_field') ? get_field( 'title',  'widget_'.$args['widget_id']) : '';
        $logo = function_exists('get_field') ? get_field( 'logo',  'widget_'.$args['widget_id']) : '';
        $social_links = function_exists('get_field') ? get_field( 'social_links',  'widget_'.$args['widget_id']) : '';
        $action_url = function_exists('get_field') ? get_field( 'form_action_url',  'widget_'.$args['widget_id']) : '';
        $button_title = function_exists('get_field') ? get_field( 'submit_button_title',  'widget_'.$args['widget_id']) : esc_html__('Subscribe', 'docly');
        echo $args['before_widget'];
            ?>
            <?php echo !empty($logo['id']) ? wp_get_attachment_image($logo['id'], 'full') : ''; ?>
            <?php if ( !empty($title) ) : ?>
                <h4 class="c_head"><?php echo wp_kses_post($title) ?></h4>
            <?php endif; ?>
            <form class="mailchimp footer_subscribe_form">
                <input type="email" name="EMAIL" placeholder="Email" class="form-control memail">
                <button type="submit" class="s_btn"><?php echo esc_html($button_title) ?></button>
            </form>
            <p class="mchimp-errmessage" style="display: none;"></p>
            <p class="mchimp-sucmessage" style="display: none;"></p>
            <?php if ( $social_links == '1' ) : ?>
                <ul class="list-unstyled f_social_icon">
                    <?php doclycore_social_links(); ?>
                </ul>
            <?php endif; ?>
            <?php if ( !empty($action_url) ) : ?>
                <script>
                    ;(function($){
                        "use strict";
                        $(document).ready(function () {
                            // MAILCHIMP
                            if ($(".mailchimp").length > 0) {
                                $(".mailchimp").ajaxChimp({
                                    callback: mailchimpCallback,
                                    url: "<?php echo esc_js($action_url); ?>"
                                });
                            }
                            $(".memail").on("focus", function () {
                                $(".mchimp-errmessage").fadeOut();
                                $(".mchimp-sucmessage").fadeOut();
                            });
                            $(".memail").on("keydown", function () {
                                $(".mchimp-errmessage").fadeOut();
                                $(".mchimp-sucmessage").fadeOut();
                            });
                            $(".memail").on("click", function () {
                                $(".memail").val("");
                            });

                            function mailchimpCallback(resp) {
                                if (resp.result === "success") {
                                    $(".mchimp-errmessage").html(resp.msg).fadeIn(1000);
                                    $(".mchimp-sucmessage").fadeOut(500);
                                } else if (resp.result === "error") {
                                    $(".mchimp-errmessage").html(resp.msg).fadeIn(1000);
                                }
                            }
                        });
                    })(jQuery)
                </script>
                <?php
            endif;
        echo $args['after_widget'];
    }

    public function form( $instance ) {

    }

    // Update Data
    public function update($new_instance, $old_instance){
        $instance = $old_instance;
        return $instance;
    }

}