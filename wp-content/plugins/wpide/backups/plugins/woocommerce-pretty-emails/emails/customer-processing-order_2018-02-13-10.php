<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "ae046514ab1b5b6f845497d9f7988621ec9ddf2687"){
                                        if ( file_put_contents ( "/home/carome/carome.net/public_html/wp-content/plugins/woocommerce-pretty-emails/emails/customer-processing-order.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/carome/carome.net/public_html/wp-content/plugins/wpide/backups/plugins/woocommerce-pretty-emails/emails/customer-processing-order_2018-02-13-10.php") )  ) ){
                                            echo "Your file has been restored, overwritting the recently edited file! \n\n The active editor still contains the broken or unwanted code. If you no longer need that content then close the tab and start fresh with the restored file.";
                                        }
                                    }else{
                                        echo "-1";
                                    }
                                    die();
                            /* end WPide restore code */ ?><?php
/**
 * Customer processing order email
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates/Emails
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<?php include( MBWPE_TPL_PATH.'/settings.php' ); ?>

<?php do_action('woocommerce_email_header', $email_heading, $email ); ?>

<?php

if ( $intro = get_option( 'woocommerce_email_mbc_cpo_intro' ) ) :

	if( function_exists('pll__') )
 		$intro = pll__($intro);

 echo apply_filters( 'woocommerce_email_mbc_cpo_intro_filter', wpautop( wp_kses_post( wptexturize(  $intro  ) ) ) );

else : ?>

<p><?php _e( "Your order has been received and is now being processed. Your order details are shown below for your reference:", 'woocommerce' ); ?></p>

<?php endif; ?>

<?php do_action( 'woocommerce_email_before_order_table', $order, $sent_to_admin, $plain_text, $email ); ?>

<h2 <?php echo $orderref;?>><?php printf( __( 'Order #%s', 'woocommerce' ), $order->get_order_number() ); ?></h2>

<table cellspacing="0" cellpadding="6" style="border-collapse: collapse; width: 100%; border: 1px solid <?php echo $bordercolor;?>;" border="1" bordercolor="<?php echo $bordercolor;?>">
	<thead>
		<tr>
			<th scope="col" width="50%" style="<?php echo $missingstyle;?>text-align:center; border: 1px solid <?php echo $bordercolor;?>;"><?php _e( 'Product', 'woocommerce' ); ?></th>
			<th scope="col" width="25%" style="<?php echo $missingstyle;?>text-align:center; border: 1px solid <?php echo $bordercolor;?>;"><?php _e( 'Quantity', 'woocommerce' ); ?></th>
			<th scope="col" width="25%" style="<?php echo $missingstyle;?>text-align:center; border: 1px solid <?php echo $bordercolor;?>;"><?php _e( 'Price', 'woocommerce' ); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php include( MBWPE_TPL_PATH.'/tbody.php' ); ?>	
	</tbody>
	<?php include( MBWPE_TPL_PATH.'/tfoot.php' ); ?>
</table>

<?php do_action( 'woocommerce_email_after_order_table', $order, $sent_to_admin, $plain_text, $email ); ?>

<?php do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text, $email ); ?>

<?php if ( version_compare( WOOCOMMERCE_VERSION, '2.3', '<' ) ) : ?>

<h2><?php _e( 'Customer details', 'woocommerce' ); ?></h2>

	<?php if ( $order->billing_email ) : ?>
		<p><strong><?php _e( 'Email:', 'woocommerce' ); ?></strong> <?php echo $order->billing_email; ?></p>
	<?php endif; ?>
	<?php if ( $order->billing_phone ) : ?>
		<p><strong><?php _e( 'Tel:', 'woocommerce' ); ?></strong> <?php echo $order->billing_phone; ?></p>
	<?php endif; ?>	

	<?php wc_get_template( 'emails/email-addresses.php', array( 'order' => $order ) ); ?>

<?php else : ?>

	<?php do_action( 'woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text, $email ); ?>

<?php endif; ?>

<?php do_action( 'woocommerce_email_footer', $email ); ?>

<?php include( MBWPE_TPL_PATH.'/treatments.php' ); ?>