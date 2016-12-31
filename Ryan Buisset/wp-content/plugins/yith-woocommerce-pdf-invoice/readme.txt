=== YITH WooCommerce PDF Invoice and Shipping List ===

Contributors: yithemes
Tags: woocommerce, orders, woocommerce order, pdf, invoice, pdf invoice, delivery note, pdf invoices, automatic invoice, download, download invoice, bill order, billing, automatic billing, order invoice, billing invoice, new order, processing order, shipping list, shipping document, delivery, packing slip, transport document,  delivery, shipping, order, shop, shop invoice, customer, sell, invoices, email invoice, packing slips
Requires at least: 4.0
Tested up to: 4.5.2
Stable tag: 1.1.12
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Generate and send PDF invoices and shipping list documents for WooCommerce orders via email.

== Description ==

This WooCommerce plugin allows creating PDF invoices and shipping list documents for WooCommerce orders quickly and easily with customizable templates.
Choose if generating invoices manually or automatically using custom number format and send it as email attachment to your customers.
   
= Main features =

* Generate PDF invoices and shipping list documents.
* Customizable invoice number format.
* Autoincrement invoice number.
* Automatically or manually generated invoice documents.
* Generate invoices automatically depending on order status.
* Add PDF invoice as attachment of the email sent to customer.
* Customizable invoice template.
* Customizable shipping list template.
* Download invoices from customers' order page.

For a more detailed list of options and features of the plugin, please look at the [official documentation](http://yithemes.com/docs-plugins/yith-woocommerce-pdf-invoice/ "Yith WooCommerce PDF Invoice official documentation").

Discover all the features of the plugin and install it in your theme: the result will be extremely satisfying.

== Installation ==
Important: First of all, you have to download and activate WooCommerce plugin, which is mandatory for Yith WooCommerce PDF Invoice and Shipping List to be working.

1. Download and unzip the downloaded file.
2. Upload the plugin folder into the `wp-content/plugins/` directory of your WordPress site.
3. Activate `YITH WooCommerce PDF Invoice and Shipping List` from "Plugins" page.

= Configuration =

YITH WooCommerce PDF Invoice and Shipping List will add a new tab called "PDF Invoice" in "YIT Plugins" menu item. There, you will find all Yithemes plugins with quick access to plugin setting page.

== Screenshots ==

1. This is invoice setting page, where you can customize invoice creation settings. You can find it in "YIT Plugins" menu item. You can configure invoice header and functioning of automatic generation of invoice number.
2. This is invoice template setting page, where you can choose sections to be displayed in PDF invoice.
3. In back-end order page, you can quickly see invoice number and date for orders invoiced (below order column).
4. In back-end order page, for each order you find buttons for creating/viewing invoice and shipping list documents.
5. In back-end single order page, you find a metabox that shows information about invoice date and number, if any, and some buttons for generating/viewing invoice and shipping list documents.
6. In front-end order page, you find an additional button for orders with an invoice associated. This button lets customers download the invoice.
7. A basic, fully customizable template for invoices. 

== Changelog ==

= Version 1.1.12 - Released: Jun 13, 2016 =

* Updated: WooCommerce 2.6 100% compatible

= Version 1.1.11 - Released: May 10, 2016 =

* Added: filter 'yith_ywpi_new_invoice_number' that lets you manage the invoice number for new documents
* Added: filter 'yith_ywpi_get_formatted_invoice_number' that let you manage how the invoice number and prefix/suffix should be shown

= Version 1.1.10 - Released: May 04, 2016 =

* Fixed: missing YITH Plugin FW files

= Version 1.1.9.1 - Released: May 02, 2016 =

* Updated: plugin compatible with WordPress 4.5
* Updated: plugin author name
* Updated: YITH Plugin Framework

= Version 1.1.8 - Released: Mar 31, 2016 =

* Updated : YITH Plugin framework
* Fixed : now shipping informations shown on shipping list document instead of the billing informations

= Version 1.1.7 - Released: Feb 22, 2016 =

* Updated : YITH Plugin framework

= Version 1.1.6 - Released: Nov 04, 2015 =

* Fixed: invoice generated and attached to emails not related to orders
* Updated : text-domain changed from ywpi to yith-woocommerce-pdf-invoice

= Version 1.1.5 - Released: Sep 04, 2015 =

* Fixed: removed deprecated woocommerce_update_option_X hook.

= Version 1.1.4 - Released: Aug 12, 2015 =

* Updated: update YITH Plugin framework.

= Version 1.1.3 - Released: May 27, 2015 =

* Fixed : localization issue.

= Version 1.1.2 - Released: May 22, 2015 =

* Added : improved unicode support.

= Version 1.1.1 - Released: May 07, 2015 =

* Added : shipping cost details are shown on invoices.

= Version 1.1.0 - Released: Apr 22, 2015 =

* Fixed : security issue (https://make.wordpress.org/plugins/2015/04/20/fixing-add_query_arg-and-remove_query_arg-usage/)

= Version 1.0.3 - Released: Apr 07, 2015 =

* Fixed : documents with greek text could not be rendered correctly.

= Version 1.0.2 - Released: Mar 05, 2015 =

* Fixed: PDF generation failed sometimes.
* Added: support to WPML.

= Version 1.0.1 - Released: Feb 20, 2015 =

* Added: Create PDF shipping list document
* Added: Shipping list customizable template
* Added: Buttons for generating/viewing invoices and shipping list from back-end order page and single order page.
* Added: Woocommerce 2.3 support

= Version 1.0.0 - Released: Feb 13, 2015 =

* Initial release

== Suggestions ==

If you have any suggestions concerning how to improve YITH WooCommerce PDF Invoice and Shipping List, you can [write to us](mailto:plugins@yithemes.com "Your Inspiration Themes"), so that we can improve YITH WooCommerce PDF Invoice and Shipping List.

== Translators ==

= Available Languages =
* English

If you have created your own language pack, or you have got an updated version of an existing one, you can send it [gettext PO and MO file](http://codex.wordpress.org/Translating_WordPress "Translating WordPress")
[use](http://yithemes.com/contact/ "Your Inspiration Themes"), so that we can improve YITH WooCommerce PDF Invoice and Shipping List.

== Upgrade notice ==

= 1.0.1 =

Initial release