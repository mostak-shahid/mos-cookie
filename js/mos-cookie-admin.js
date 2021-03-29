jQuery(document).ready(function($) {
    $(window).load(function(){
      $('.mos-cookie-wrapper .tab-con').hide();
      $('.mos-cookie-wrapper .tab-con.active').show();
    });

    $('.mos-cookie-wrapper .tab-nav > a').click(function(event) {
      event.preventDefault();
      var id = $(this).data('id');

      set_mos_cookie_cookie('plugin_active_tab',id,1);
      $('#mos-cookie-'+id).addClass('active').show();
      $('#mos-cookie-'+id).siblings('div').removeClass('active').hide();

      $(this).closest('.tab-nav').addClass('active');
      $(this).closest('.tab-nav').siblings().removeClass('active');
    });
});
