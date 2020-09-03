</div>
<footer class="site-footer">

    <div class="container">
        <div class="row no-gutters">
            <div class="col-12 col-md-6 col-lg-3">
				<?php
if(is_active_sidebar('footer-sidebar-1')){
dynamic_sidebar('footer-sidebar-1');
}else {
	echo '<img src="'. get_stylesheet_directory_uri() . '/resources/img/footer/GoldenV2Logo 3.png" alt="">';
}
?>
            </div>
            <div class="col-2 d-none d-lg-block">
<?php pandago_nav( 'footer' ); ?>
            </div>
            <div class="col-4 d-none d-lg-block">
                <ul class="list-unstyled" style="margin-left: 16%;">
				  <?php if (is_active_sidebar( 'footer-sidebar-2' ) ) : ?>
				  <?php dynamic_sidebar( 'footer-sidebar-2' ); ?>
				  
				  <?php else: ?>
				  <li><h3 style="margin: 3% 0 5% 0;"><?php bloginfo('description'); ?></h3></li>
                  <li><p>Reģistrācijas nr. 40008293119</p></li>
                  <li><p>Banka: SWEDBANK A/S</p></li>
                  <li><p>LV52HABA0551047652465 </p></li>
				  <?php endif; ?>	
                </ul>
            </div>
            <div class="col-12 col-md-6 col-lg-3 text-left text-md-right" style="padding-right: 3.7%;">
				<?php if (is_active_sidebar( 'footer-sidebar-3' ) ) : ?>
				<?php dynamic_sidebar( 'footer-sidebar-3' ); ?>
				<?php else: ?>
				<h3 class="d-md-none d-lg-block" style="margin: 13px 0 12px 0;"><?php bloginfo('name'); ?></h3>
                <p class="text-2">juris.gogulis@sparkleheart.org</p>
                <p class="text-2">+37126890034</p>
                <p class="text-2" style="margin-bottom: 2.69rem;">Biķernieku iela 24a - 5, LV-1006</p>
                <a class="d-block d-lg-none" href="#">Skatīt rekvizītus</a>
                <i class="fa fa-facebook d-md-none d-lg-inline" style="margin-right: 1.5rem;"></i>
                <i class="fa fa-instagram d-md-none d-lg-inline"></i>
				<?php endif; ?>				
            </div>
            <div class="col-12 d-none d-md-flex d-lg-none justify-content-between align-items-center">
              <div>
                <h3 class="mb-0" >Juris Gogulis</h3>
              </div>
              <div>
                <i class="fa fa-facebook" style="font-size: 27px; margin-right: 1.7rem;"></i>
                <i class="fa fa-instagram" style="font-size: 32px;"></i>
              </div>
            </div>
        </div>
        <div class="row copyright mt-auto">
            <div class="col-12 col-md-8 col-lg-6 d-flex d-lg-block" style="padding-left: 3.9rem;">
			  	<?php if (is_active_sidebar( 'footer-sidebar-4' ) ) : ?>
				<?php dynamic_sidebar( 'footer-sidebar-4' ); ?>
				<?php else: ?>
			  <p>&copy; SparkleHeart 2020.</p>
              <p>Visas tiesības aizsargātas.</p>
				<?php endif; ?>		
            </div>
            <div class="col-12 col-md-4 col-lg-6 text-left text-md-right d-lg-flex align-items-end justify-content-end" style="padding-right: 4.8%;">
				<?php if (is_active_sidebar( 'footer-sidebar-5' ) ) : ?>
				<?php dynamic_sidebar( 'footer-sidebar-5' ); ?>
				<?php else: ?>
				Privātuma politika
				<?php endif; ?>	
            </div>                
        </div>
    </div>
</footer>
<?php get_template_part( 'template-parts/foot' ); ?>