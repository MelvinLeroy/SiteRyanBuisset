<style>
    .section{
        margin-left: -20px;
        margin-right: -20px;
    }
    .section h1{
        text-align: center;
        text-transform: uppercase;
        color: #808a97;
        font-size: 35px;
        font-weight: 700;
        line-height: normal;
        display: inline-block;
        width: 100%;
        margin: 50px 0 0;
    }
    .section:nth-child(even){
        background-color: #fff;
    }
    .section:nth-child(odd){
        background-color: #f1f1f1;
    }
    .section .section-title img{
        display: table-cell;
        vertical-align: middle;
        float: left;
        width: auto;
        margin-right: 15px;
    }
    .section .section-title h2,.section .section-title h3
     {
        display: table-cell;
        vertical-align: middle;
        padding: 0;
        font-size: 24px;
        line-height: 25px;
        font-weight: 700;
        color: #808a97;
        text-transform: uppercase;
    }

    .section .section-title h3 {
        font-size: 14px;
        line-height: 28px;
        margin-bottom: 0;
        display: block;
    }

    .section p{
        font-size: 13px;
        margin: 25px 0;
    }
    .section ul li{
        margin-bottom: 4px;
    }
    .landing-container{
        max-width: 750px;
        margin-left: auto;
        margin-right: auto;
        padding: 50px 0 30px;
    }
    .landing-container:after{
        display: block;
        clear: both;
        content: '';
    }
    .landing-container .col-1,
    .landing-container .col-2{
        float: left;
        box-sizing: border-box;
        padding: 0 15px;
    }
    .landing-container .col-1 img{
        width: 100%;
    }
    .landing-container .col-1{
        width: 55%;
    }
    .landing-container .col-2{
        width: 45%;
    }
    .premium-cta{
        background-color: #808a97;
        color: #fff;
        border-radius: 6px;
        padding: 20px 15px;
    }
    .premium-cta:after{
        content: '';
        display: block;
        clear: both;
    }
    .premium-cta p{
        margin: 7px 0;
        font-size: 14px;
        font-weight: 500;
        display: inline-block;
        width: 60%;
    }
    .premium-cta a.button{
        border-radius: 6px;
        height: 60px;
        float: right;
        background: url(<?php echo YITH_YWPI_ASSETS_IMAGES_URL?>upgrade.png) #ff643f no-repeat 13px 13px;
        border-color: #ff643f;
        box-shadow: none;
        outline: none;
        color: #fff;
        position: relative;
        padding: 9px 50px 9px 70px;
    }
    .premium-cta a.button:hover,
    .premium-cta a.button:active,
    .premium-cta a.button:focus{
        color: #fff;
        background: url(<?php echo YITH_YWPI_ASSETS_IMAGES_URL?>upgrade.png) #971d00 no-repeat 13px 13px;
        border-color: #971d00;
        box-shadow: none;
        outline: none;
    }
    .premium-cta a.button:focus{
        top: 1px;
    }
    .premium-cta a.button span{
        line-height: 13px;
    }
    .premium-cta a.button .highlight{
        display: block;
        font-size: 20px;
        font-weight: 700;
        line-height: 20px;
    }
    .premium-cta .highlight{
        text-transform: uppercase;
        background: none;
        font-weight: 800;
        color: #fff;
    }

    @media (max-width: 767px){
        .section{
            margin-left: 0;
            margin-right: 0;
        }
        .premium-cta a.button{
            float: none;
        }
        .premium-cta{
            text-align: center;
        }
        .premium-cta p{
            width: 100%;
        }
    }

    @media (max-width: 480px){
        .wrap{
            margin-right: 0;
        }
        .section{
            margin: 0;
        }
        .landing-container .col-1,
        .landing-container .col-2{
            width: 100%;
            padding: 0 15px;
        }
        .section-odd .col-1 {
            float: left;
            margin-right: -100%;
        }
        .section-odd .col-2 {
            float: right;
            margin-top: 65%;
        }
    }

    @media (max-width: 320px){
        .premium-cta a.button{
            padding: 9px 20px 9px 70px;
        }

        .section .section-title img{
            display: none;
        }
    }
</style>
<div class="landing">
    <div class="section section-cta section-odd">
        <div class="landing-container">
            <div class="premium-cta">
                <p>
                    <?php echo sprintf( __('Upgrade to %1$spremium version%2$s of %1$sYITH WooCommerce PDF Invoice and Shipping List%2$s to benefit from all features!','yith-woocommerce-pdf-invoice'),'<span class="highlight">','</span>' );?>
                </p>
                <a href="<?php echo YITH_YWPI_Plugin_FW_Loader::get_instance()->get_premium_landing_uri();?>" target="_blank" class="premium-cta-button button btn">
                    <span class="highlight"><?php _e('UPGRADE','yith-woocommerce-pdf-invoice');?></span>
                    <span><?php _e('to the premium version','yith-woocommerce-pdf-invoice');?></span>
                </a>
            </div>
        </div>
    </div>
    <div class="section section-even clear" style="background: url(<?php echo YITH_YWPI_ASSETS_IMAGES_URL ?>01-bg.png) no-repeat #fff; background-position: 85% 75%">
        <h1><?php _e('Premium Features','yith-woocommerce-pdf-invoice');?></h1>
        <div class="landing-container">
            <div class="col-1">
                <img src="<?php echo YITH_YWPI_ASSETS_IMAGES_URL ?>01.png" alt=<?php _e('pro forma invoice','yith-woocommerce-pdf-invoice');?> />
            </div>
            <div class="col-2">
                <div class="section-title">
                    <img src="<?php echo YITH_YWPI_ASSETS_IMAGES_URL ?>01-icon.png" alt="icon-01"/>
                    <h2><?php _e('PRO FORMA INVOICE','yith-woocommerce-pdf-invoice');?></h2>
                </div>
                <p>
                    <?php echo sprintf(__('While waiting for the invoice of the order, users can ask a %1$spro forma invoice%2$s for their order and download immediately a summarizing document of their payment. One click and the requested PDF file will be at their disposal.','yith-woocommerce-pdf-invoice'),'<b>','</b>');?>
                </p>
            </div>
        </div>
    </div>
    <div class="section section-odd clear" style="background: url(<?php echo YITH_YWPI_ASSETS_IMAGES_URL ?>02-bg.png) no-repeat #f1f1f1; background-position: 15% 100%">
        <div class="landing-container">
            <div class="col-2">
                <div class="section-title">
                    <img src="<?php echo YITH_YWPI_ASSETS_IMAGES_URL ?>02-icon.png" alt="icon-02" />
                    <h2><?php _e('FILE NAME','yith-woocommerce-pdf-invoice');?></h2>
                </div>
                <p><?php echo sprintf(__('Every name of the created PDF files will be composed following the settings of the plugin option panel.For every kind of document %1$sPro Forma Invoice, Invoice, or Shipping%2$s, you can create names with a different structure.','yith-woocommerce-pdf-invoice'),'<b>','</b>');?>
                </p>
            </div>
            <div class="col-1">
                <img src="<?php echo YITH_YWPI_ASSETS_IMAGES_URL ?>02.png" alt=<?php _e('file name','yith-woocommerce-pdf-invoice');?> />
            </div>
        </div>
    </div>
    <div class="section section-even clear" style="background: url(<?php echo YITH_YWPI_ASSETS_IMAGES_URL ?>03-bg.png) no-repeat #fff; background-position: 85% 100%">
        <div class="landing-container">
            <div class="col-1">
                <img src="<?php echo YITH_YWPI_ASSETS_IMAGES_URL ?>03.png" alt=<?php _e('save path','yith-woocommerce-pdf-invoice');?> />
            </div>
            <div class="col-2">
                <div class="section-title">
                    <img src="<?php echo YITH_YWPI_ASSETS_IMAGES_URL ?>03-icon.png" alt="icon-03" />
                    <h2><?php _e('SAVE PATH','yith-woocommerce-pdf-invoice');?></h2>
                </div>
                <p><?php echo sprintf(__('If your business is booming, you will create many invoices, and so there will be many downloads.Choose the file path and decide to sort out the folders by %1$syear, month or day%2$s in which you save the file.','yith-woocommerce-pdf-invoice'),'<b>','</b>');?>
                </p>
            </div>
        </div>
    </div>
    <div class="section section-odd clear" style="background: url(<?php echo YITH_YWPI_ASSETS_IMAGES_URL ?>04-bg.png) no-repeat #f1f1f1; background-position: 15% 100%">
        <div class="landing-container">
            <div class="col-2">
                <div class="section-title">
                    <img src="<?php echo YITH_YWPI_ASSETS_IMAGES_URL ?>04-icon.png" alt="icon-04" />
                    <h2><?php _e('AUTOMATIC BACKUP ON DROBOX','yith-woocommerce-pdf-invoice');?></h2>
                </div>
                <p><?php echo sprintf(__('The saving of the created documents can be %1$ssynchronized%2$s with your Dropbox account; in this way, you will have a backup copy of your details every time you make a new save.','yith-woocommerce-pdf-invoice'),'<b>','</b>');?>
                </p>
            </div>
            <div class="col-1">
                <img src="<?php echo YITH_YWPI_ASSETS_IMAGES_URL ?>04.png" alt=<?php _e('automatic backup on dropbox','yith-woocommerce-pdf-invoice');?> />
            </div>
        </div>
    </div>
    <div class="section section-even clear" style="background: url(<?php echo YITH_YWPI_ASSETS_IMAGES_URL ?>05-bg.png) no-repeat #fff; background-position: 85% 100%">
        <div class="landing-container">
            <div class="col-1">
                <img src="<?php echo YITH_YWPI_ASSETS_IMAGES_URL ?>05.png" alt=<?php _e('notes and footer in the document','yith-woocommerce-pdf-invoice');?> />
            </div>
            <div class="col-2">
                <div class="section-title">
                    <img src="<?php echo YITH_YWPI_ASSETS_IMAGES_URL ?>05-icon.png" alt="icon-05" />
                    <h2><?php _e('NOTES AND FOOTER IN THE DOCUMENT','yith-woocommerce-pdf-invoice');?></h2>
                </div>
                <p><?php echo sprintf(__('In addition to the name of the company and the order details, you can write a different text %1$seven for every type of PDF file created%2$s to both add freely a note into the document, and a footer.','yith-woocommerce-pdf-invoice'),'<b>','</b>');?>
                </p>
            </div>
        </div>
    </div>
    <div class="section section-odd clear" style="background: url(<?php echo YITH_YWPI_ASSETS_IMAGES_URL ?>06-bg.png) no-repeat #f1f1f1; background-position: 15% 100%">
        <div class="landing-container">
            <div class="col-2">
                <div class="section-title">
                    <img src="<?php echo YITH_YWPI_ASSETS_IMAGES_URL ?>06-icon.png" alt="icon-06" />
                    <h2><?php _e('SSN AND VAT','yith-woocommerce-pdf-invoice');?></h2>
                </div>
                <p><?php echo sprintf(__('Once activated, these two options will add two new input fields for the users during the %1$scheckout%2$s step. These elements can also be showed into the PDF document.','yith-woocommerce-pdf-invoice'),'<b>','</b>');?></p>
            </div>
            <div class="col-1">
                <img src="<?php echo YITH_YWPI_ASSETS_IMAGES_URL ?>06.png" alt=<?php _e('ssn and vat','yith-woocommerce-pdf-invoice');?>/>
            </div>
        </div>
    </div>
    <div class="section section-even clear" style="background: url(<?php echo YITH_YWPI_ASSETS_IMAGES_URL ?>07-bg.png) no-repeat #fff; background-position: 85% 100%">
        <div class="landing-container">
            <div class="col-1">
                <img src="<?php echo YITH_YWPI_ASSETS_IMAGES_URL ?>07.png" alt= <?php _e('templates','yith-woocommerce-pdf-invoice');?>/>
            </div>
            <div class="col-2">
                <div class="section-title">
                    <img src="<?php echo YITH_YWPI_ASSETS_IMAGES_URL ?>07-icon.png" alt="Icon-07" />
                    <h2><?php _e('DIFFERENT TEMPLATES FOR EVERY DOCUMENT TYPE','yith-woocommerce-pdf-invoice');?></h2>
                </div>
                <p><?php echo sprintf(__('For every document created, you can set which kind of information it should contain: %1$sthe name of your business and its information, notes and footer%2$s, and even all the order details with the products and the %1$srelated prices%2$s.','yith-woocommerce-pdf-invoice'),'<b>','</b>');?></p>
            </div>
        </div>
    </div>
    <div class="section section-odd clear" style="background: url(<?php echo YITH_YWPI_ASSETS_IMAGES_URL ?>08-bg.png) no-repeat #f1f1f1; background-position: 15% 100%">
        <div class="landing-container">
            <div class="col-2">
                <div class="section-title">
                    <img src="<?php echo YITH_YWPI_ASSETS_IMAGES_URL ?>08-icon.png" alt="icon-08" />
                    <h2><?php _e('User information','yith-woocommerce-pdf-invoice');?></h2>
                </div>
                <p><?php echo sprintf(__('No more limits for information about order and user to be inserted in the document. All you have to do is obtain the %1$s"meta key"%2$s value and the information will be dynamically inserted. A system that allows you to make documents rich of useful data.','yith-woocommerce-pdf-invoice'),'<b>','</b>');?></p>
            </div>
            <div class="col-1">
                <img src="<?php echo YITH_YWPI_ASSETS_IMAGES_URL ?>08.png" alt=<?php _e('User information','yith-woocommerce-pdf-invoice');?>/>
            </div>
        </div>
    </div>
    <div class="section section-even clear" style="background: url(<?php echo YITH_YWPI_ASSETS_IMAGES_URL ?>09-bg.png) no-repeat #fff; background-position: 85% 100%">
        <div class="landing-container">
            <div class="col-1">
                <img src="<?php echo YITH_YWPI_ASSETS_IMAGES_URL ?>09.png" alt= <?php _e('templates','yith-woocommerce-pdf-invoice');?>/>
            </div>
            <div class="col-2">
                <div class="section-title">
                    <img src="<?php echo YITH_YWPI_ASSETS_IMAGES_URL ?>09-icon.png" alt="Icon-09" />
                    <h2><?php _e('Overwrite template','yith-woocommerce-pdf-invoice');?></h2>
                </div>
                <p><?php echo sprintf(__('If you are a developer and you want to change the document template provided by default from the plugin, you can easily copy files of interest in your theme folder.%3$s After changes, enable the %1$spreview mode%2$s: in this way you could generate an invoice sample to check the changes without an increase in numeration.','yith-woocommerce-pdf-invoice'),'<b>','</b>','<br>');?></p>
            </div>
        </div>
    </div>


    <div class="section section-cta section-odd">
        <div class="landing-container">
            <div class="premium-cta">
                <p>
                    <?php echo sprintf(__('Upgrade to the %1$spremium version%2$s of %1$sYITH WooCommerce Pdf Invoice and Shipping List%2$s to benefit from all features!','yith-woocommerce-pdf-invoice'),'<span class="highlight">','</span>');?>
                </p>
                <a href="<?php echo YITH_YWPI_Plugin_FW_Loader::get_instance()->get_premium_landing_uri(); ?>" target="_blank" class="premium-cta-button button btn">
                    <span class="highlight"><?php _e('UPGRADE','yith-woocommerce-pdf-invoice');?></span>
                    <span><?php _e('to the premium version','yith-woocommerce-pdf-invoice');?></span>
                </a>
            </div>
        </div>
    </div>
</div>