<!-- footer -->
        <!-- ============================================================== -->
        <footer class="footer animated bounceInUp">
            ©2020 - <?php echo date('Y');?> E-Parking System | ASC.
        </footer>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>
    <script src="<?php echo base_url()?>assets/node_modules/jquery/jquery-3.2.1.min.js"></script>
    <script src="<?php echo base_url()?>assets/node_modules/popper/popper.min.js"></script>
    <script src="<?php echo base_url()?>assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url()?>assets/dist/js/perfect-scrollbar.jquery.min.js"></script>
    <script src="<?php echo base_url()?>assets/dist/js/waves.js"></script>
    <script src="<?php echo base_url()?>assets/dist/js/sidebarmenu.js"></script>
    <script src="<?php echo base_url()?>assets/dist/js/custom.min.js"></script>
    <script src="<?php echo base_url()?>assets/dist/js/pages/jasny-bootstrap.js"></script>
    <script src="<?php echo base_url()?>assets/node_modules/toast-master/js/jquery.toast.js"></script>
    <script src="<?php echo base_url()?>assets/node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url()?>assets/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js"></script>
    
    <?php if ($page_route == 'parking_log_page'): ?> 
    <script src="<?php echo base_url()?>assets/cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url()?>assets/cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
    <script src="<?php echo base_url()?>assets/cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="<?php echo base_url()?>assets/cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script src="<?php echo base_url()?>assets/cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script src="<?php echo base_url()?>assets/cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
    <script src="<?php echo base_url()?>assets/cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
    <?php endif ?>

    <script src="<?php echo base_url()?>assets/node_modules/typeahead.js-master/dist/typeahead.bundle.min.js"></script>
    <script src="<?php echo base_url()?>assets/bootstrap3-typeahead.min.js"></script>
    <script src="<?php echo base_url()?>assets/node_modules/dropify/dist/js/dropify.min.js"></script>
    <script src="<?php echo base_url()?>assets/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <!-- <script src="<?php echo base_url()?>assets/node_modules/Magnific-Popup-master/dist/jquery.magnific-popup.min.js">
    </script> -->
    <!-- <script src="<?php echo base_url()?>assets/node_modules/Magnific-Popup-master/dist/jquery.magnific-popup-init.js"></script> -->
     <script src="<?php echo base_url()?>assets/node_modules/echarts/echarts-all.js"></script>
</body>
</html>