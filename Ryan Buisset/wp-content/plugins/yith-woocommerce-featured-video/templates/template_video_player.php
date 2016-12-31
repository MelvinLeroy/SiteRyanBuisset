<?php
if( !defined( 'ABSPATH' ) )
    exit;

global $post;


$default    =   array(
    'class' =>  'vjs-default-skin',
    'data_setup'    =>  '{}',
    'controls'      =>  true,
    'poster'        =>  '',
    'preload'       =>  'auto',
    'width'         =>  '',
    'height'        =>  '',
    'autoplay'      =>  false,
    'loop'          =>  false,
    'src'           =>  ''

);

$default    =   wp_parse_args( $atts, $default );


extract( $default );

$json_string    =  stripslashes ( wp_json_encode( $data_setup ) );

$controls   =   $controls ? 'controls' : '';
$loop       =   $loop     ? 'loop'  :   '';
$autoplay   =   $autoplay   ?   'autoplay'  :   '';
$poster     =   $poster!='' ?   $poster :   '';

?>

<video id="video_<?php echo $post->ID;?>" src="" class="video-js <?php echo $class;?> vjs-big-play-centered product-video" <?php echo $controls;?> <?php echo $loop;?> <?php echo $autoplay;?> preload="<?php echo $preload;?>" <?php if( $width!= '' ) :?> width="<?php echo $width; endif;?>" <?php if( $height!= '' ) :?> height="<?php echo $height; endif;?>" data-setup='<?php echo $json_string;?>' style="visibility:hidden;">
</video>

<script type="text/javascript">
    jQuery(document).ready(function($) {
        var width = $('.product .images').width();
        videojs('video_<?php echo $post->ID;?>').ready(function () {

            $('#'+this.id() ).css('visibility','visible');
            $('#'+this.id()+'_html5_api').css('visibility','visible');
            this.on('error', function () {

                var e = this.error();

                if (e.code == 150) {
                    $('.vjs-error-display').find('div').html('<?php _e('This video has been blocked because its contents are under copyright.','yith-woocommerce-featured-video' );?>');
                }

                this.width( width );
                var height = ( width/16 )*9;
                this.height( Math.round(height));
            });
        });

    });
</script>
