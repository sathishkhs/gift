		<?php if($page_items->display_image == 1 && !empty($page_items->display_image) && file_exists((BANNER_IMAGE_PATH.$page_items->banner_image))){ ?>
		<!--Page Header Start-->
        <section class="page-header">
            <div class="page-header__bg" >
                <img class="w-100 img-responsive img-fluid" src="<?php echo BANNER_IMAGE_PATH.$page_items->banner_image; ?>">
              
            </div>
            <!-- /.page-header__bg -->
            <div class="container">
                <!--<h2><?php // echo $page_heading; ?></h2>-->
                <!-- <ul class="thm-breadcrumb list-unstyled"> -->
					<?php //echo $breadcrumb; ?>
                <!-- </ul> -->
            </div>
        </section>
        <!--Page Header End-->
		<?php } ?>