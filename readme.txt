=== WP Stripe Kit Lite ===
Contributors: lhosford
Donate link: https://www.lonhosford.com/wp-stripe-kit-lite
Tags: stripe, stripe checkout, ecommerce, checkout, credit card, e-commerce, subscription
Requires at least: 4.5.3
Tested up to: 5.1.1
Stable tag: 1.1.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Fast and simple way to accept payments using the Stripe service.

== Description ==

= Looking for a quick way to integrate checkout buttons into your Wordpress pages and posts? =

With WP Stripe Kit Lite you can:

*   Create buttons for single or bundled item purchases.
*   Create buttons for recurring subscription billing.

WP Stripe Kit Lite uses the free [Stripe](http://www.stripe.com "Stripe Website") service.

= Want Secure Mobile Ready Online Payment Processing? =
The [Stripe](http://www.stripe.com "Stripe Website") service integrates secured online payment processing into your site. The Stripe service provides your users with a streamlined, mobile-ready payment checkout experience that is constantly improving. Updates are automatic and immediately available to new checkouts.

You are in good company with major well known websites like Adidas, Best Buy and Taskrabbit that use Stripe on their websites. [100,000 + Web Businesses Using Stripe](https://stripe.com/gallery "Stripe Website").


= Want to Provide Secure Resuable Customer Payment Information? =
You do not have to handle or store customer payment information such as credit cards. This removes liability from your business.

Stripe allows your visitors to make additional purchases without re-entering their card payment information. This increases repeat order completion.

= Want to Securely Save Customer Order Information? =
All customer information is stored on the Stripe secure platform. Stripe provides you with an easy to use dashboard to retrieve payment, email and shipping information used for checkout for your order or service fulfillment.

= Is WP Stripe Kit Lite For Your Website? =
This is a lite version is designed for the Wordpress user who has simple checkout needs and wants to implement them quickly without a lot of setup or fuss. 

It is fully functional for the features it offers.  Future updates to the lite version are made available without cost.

An upcoming WP Stripe Kit Pro version of this plugin offers additional commercial grade features. Visit the [WP Stripe Kit Lite](https://www.lonhosford.com/wp-stripe-kit-lite "WP Stripe Kit Lite Webpage") Webpage for more information.

= Where's your plugin documentation? =

Find our docs at [WP Stripe Kit Lite Docs](https://www.lonhosford.com/wp-stripe-kit-lite "WP Stripe Kit Lite Documentation") webpage.

== Installation ==

1. Upload the `wp-stripe-kit-lite.zip` plugin file using the WordPress plugins screen. Alternatively create the `wp-stripe-kit-lite` folder in your Wordpress `/wp-content/plugins/` directory and upload the uncompressed folder's files into the `wp-stripe-kit-lite` folder on your web server.
2. Activate the plugin through the 'Plugins' screen in WordPress.
3. Use the WP Stripe Kit Lite menu choice to open the settings page. You need to add your Stripe API keys. 
4. Begin using by adding shortcodes into your Wordpress pages and posts for processing payments.

== Frequently Asked Questions ==
= Where's your plugin documentation? =

Find our docs at [WP Stripe Kit Lite Docs](https://www.lonhosford.com/wp-stripe-kit-lite "WP Stripe Kit Lite Documentation") webpage.
= Can I collect a product id? =
Yes. This is an optional data point that you can add to each single item checkout button.

= Can I collect shipping information? =
Yes. This plugin uses the Stripe checkout process to collect name, address, city, state and postal code.  You can use your 
[Stripe Dashboard](https://dashboard.stripe.com "Stripe Dashboard") to retrieve the shipping information collected during the customer checkout.

= Is collecting shipping information optional? =
Yes. Shipping information is an optional item for each checkout button. 

= Can I change the checkout button label? =
Yes. Every checkout button can have a unique label.

= Can I add quantites? =
Yes. Each single item checkout button allows you to include the price and optionally a quanitity. The default quantity is 1. The total is computed for checkout.

= Are sales or VAT taxes computed? =
No. You need to include these taxes in the price.

= Can I customize the checkout button styling? =
Yes. We use the [Best CSS Button Generator](http://www.bestcssbuttongenerator.com "Best CSS Button Generator"). You can copy the CSS properties and paste to try different button styles. We also provide a way to restore the original button CSS as a fallback if you do not want to keep your changes. 

= Can I have multiple payment buttons on a single page? =
Yes.

= Can I test without using real payment cards? =
Yes. You can set the plugin to test mode and your [Stripe Dashboard](https://dashboard.stripe.com "Stripe Dashboard") will show all the transactions in the test mode view. Stripe offers valid and fail testing card numbers. See [Stripe Testing Card Numbers](https://stripe.com/docs/testing#cards "Stripe Testing Card Numbers").

= How do I fulfill orders? =

You use the Stripe dashboard to retrieve payment, email and shipping information collected during checkout for your order or service fulfillment. Stripe offers [Stripe Integrations](https://stripe.com/docs/integrations "Stripe Integrations") that can pass data to email services like Mailchimp and shipping services like EasyPost.

You also can use Stripe to export the data so you can use it in spreadsheets or import it into other software.

= Is this a shopping cart? =

This is not a shopping cart. You can create checkout buttons for single purchases of one or a bundle of products and services.

= Can I use this to make my Wordpress website a subscription service? =

No. This plugin allows you to accept payments for subscription plans you set up in Stripe. Stripe then handles the recurring billing. This does not integrate the Stripe subscription plan with your Wordpress and it does not capture login information for memberships.

= Can I make changes to a payment or issue refunds? =
You can use your [Stripe Dashboard](https://dashboard.stripe.com "Stripe Dashboard") to make changes to the payment and issue refunds. Changes to the payment are based on the Stripe terms of service.

= Does the customer get a receipt? =

Yes, you can configure customer receipts in the Stripe dashboard. They are sent via email.


= How do I know when a payment is made? =

You can configure your Stripe account to send you notifications of completed transactions.

= What currencies are supported? =
Multiple currencies are available. See the [Stripe Currency FAQ](https://support.stripe.com/questions/which-currencies-does-stripe-support "Which currencies does Stripe support"). You can set each single order checkout button to currencies that Stripe supports. When you create subscription plans in your [Stripe Dashboard](https://dashboard.stripe.com "Stripe Dashboard") you set the currency for the plan.

= What are the system requirements? =

1. Stripe requires (Transport Layer Security) TLS 1.2 for pages excepting live transactions. This means that they should start with https://. This is traditionally know as (Secure Socket Layer) SSL. Your web hosting service can configure TSL 1.2 on  your website for an annual recurring fee.

2. PHP 5.5 or higher is recommended for optimal security and customer confidence.

3. You need a [Stripe Account](http://www.stripe.com "Stripe Account"). Its free to get. 

The term "SSL" continues to be used colloquially when referring to TLS. In either case its function is to protect transmitted data which is great news for your customer's security.

TLS 1.2 is needed to meet the Payment Card Industry Data Security Standard) PCI-DSS which is also great news for your customer's security.

If you do not have TLS 1.2 installed for your website, you can immediately start using this plugin to create checkout pages in a test mode. Then you can switch to live mode payment processing without any changes to your checkout pages.


Overwhelmed with acronyms and technology? Checkout (no pun intended) the [WP Stripe Kit Lite Docs](https://www.lonhosford.com/wp-stripe-kit-lite "Requirements Help") webpage for requirements help.



= What support is available? =

You can obtain free support at [Wordpress Plugins](https://wordpress.org/plugins/wp-stripe-kit-lite/ "Support at Wordpress Plugins") webpage or at the [WP Stripe Kit Lite Support](https://www.lonhosford.com/wp-stripe-kit-lite "WP Stripe Kit Lite Support") web page. Support responses are from 24 to 48 hours based a normal business day EST.

= Where can I find more information about this plugin? =
Visit the [WP Stripe Kit Lite Webpage](https://www.lonhosford.com/wp-stripe-kit-lite "WP Stripe Kit Lite Webpage") for more information.


== Screenshots ==

1. Checkout Button Examples
2. Email Only Checkout
3. Shipping Checkout
4. Email Only Stripe Subscription Plan
5. Shipping Stripe Subscription Plan
6. Setting Options
7. Sample Shortcodes


== Changelog ==

= 1.0.0 - August 16, 2016  =
* Initial release

= 1.0.1 - August 18, 2016  =
* Added msg_loading, msg_submitting, msg_success and msg_fail shortcode attributes.
* Added clean of < > " ' characters in statement descriptor.
* Removed some whitespace in message and button HTML container elements.
* Removed Stripe 3.4.0 library not used in coding.

= 1.1.0 - May 30, 2018  =
* Updated to Wordpress 4.9.6
* Updated to Stripe PHP library 6.7.4

= 1.1.1 - May 31, 2018  =
* Multiple Stripe PHP library conflicts. Detects other copies of Stripe running and uses that copy if within the tested Stripe version range. Writes details to PHP error log if version is not tested and returns message to UI when attempting to process a payment. 
* Current Stripe PHP library version support is 3.19.0 to 6.7.4.
* Removed Stripe 3.19.0 library not used in coding.



== Upgrade Notice ==
= 1.0.0 =
* Just released into the wild.

= 1.0.1 =
* Added optional shortcode attributes for loading, submitting, success and fail messages. See documentation for details.
* Added clean of < > " ' characters in statement descriptor to reduce unexpected fails on Stripe.

= 1.1.0 =
* Updated to Wordpress 4.9.6
* Updated to Stripe PHP library 6.7.4

= 1.1.1 =
* This plugin now can work with a theme or other plugins that load the Stripe PHP library. Current Stripe PHP library version support is 3.19.0 to 6.7.4.

== Arbitrary section ==

Nothing here yet.