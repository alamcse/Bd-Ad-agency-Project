//<!--

var init = function(){
	if( $('header').length ){
		header_footer();
	}

	var page = $('body').attr('id');
	
	switch(page){
		case 'hmp': homepage(); break;
		case 'srp': search_page(); break;
		case 'idp': item_detail(); break;
		case 'scp': sell_category_page(); break;
		case 'sfp': sell_form_page(); break;
		case 'post_an_ad': post_an_ad(); break;
		case 'estore_profile': estore_profile(); break;
		case 'contact_clickbd': contact_clickbd(); break;
		default: break;
	}
	
		
};



//initilizes header and footer elements
var header_footer = function(){

	// iframe modal - located in footer (f.php)
	$('body').on('click','.cbd-modal', function(e) {
		e.preventDefault();
		$('#cbd-modal').modal();
		var url = $(this).attr('href');
		$('.modal .modal-body iframe').attr("src",url);
		return false;
	});
	
	// My ClickBD dropdown
	var my_clickbd = false;
	$('#my-clickbd .dropdown-toggle').click(function() {
		if(!my_clickbd){
			my_clickbd = true;
			$('#my-clickbd .dropdown-menu').html('<li><a> <img src="/asset/img/loading.gif"> loading... </a></li>');	//show spinner
			$('#my-clickbd .dropdown-menu').load('/h_my_clickbd');		//load menu
		}
	});
	
	
	//browse by category
	var bbc = false;
	$('header .category-box .link-over').hover(function() {
		if(!bbc){
			bbc = true;
			$('header .category-box .link-over .categories-list .cat-details').load( '/h_browse_by_category' );  //load bcc
		}
	});

	// header All Category dropdown
	$('header .all-cat .cat-link').click(function() {
		$(this).toggleClass('active');
		$('header .all-cat .cat-drop').slideToggle("fast");
		return false;
	});
	
	// header All Category dropdown select value
	$('header .all-cat .cat-drop li').click(function() {
		$('header .all-cat .cat-link i').html($(this).html());
		$('#header-search #header-search-category').val($(this).attr('title'));
		$('header .all-cat .cat-drop').hide();
		$('header .all-cat .cat-link').removeClass('active');
	});
	
	$('#header-search').submit(function(e){
		e.preventDefault(); 
		var q = $.trim($('#header-search-query').val());
		var c = $.trim($('#header-search-category').val());
		if(!q) return false;	//dont do anything if empty				
		var uri = $('#header-search').attr('action');
		uri = uri + '/q/'+encodeURIComponent(q);
		if(c>0) uri = uri + '/category/'+encodeURIComponent(c);
		$(location).attr('href', uri);	//do search
		return false;
	});
	

	$('ul.tabs li').hover(function(){
		var index = $(this).index();
		$('ul.tabs li').removeClass('current');
		$(this).addClass('current');
		$('.panes').hide();
		$('.panes').eq(index).show();
	});

	/*
	$.get( "http://api.facebook.com/method/fql.query?format=json&query=select+fan_count+from+page+where+page_id%3D117021805007178", function( data ) {
		var count = data[0].fan_count;
		count = count.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
		$( "#footer_fb_count span" ).html( count );
		
	});
	*/

};




var homepage = function(){
	
	// start homepage carousels
	$('.carousel').carousel();
	
	
	// on click load featured items
	$('#homepage-item-loader').click(function() {
		homepage_featured_items();
		return false;
	});
	
	// scroll to button and load featured items just once
	var loaded = false;
	if( $('#homepage-item-loader').length && !loaded ){
		$(window).scroll(function() { //when window is scrolled
		
			if ($(window).scrollTop() >= ( $('#homepage-item-loader').offset().top - $(window).height() )  && !loaded){
				homepage_featured_items();
				loaded = true;
			}
		
		});
	}

	// ajax call to load featured items 
	var homepage_featured_items = function(){
		$.get( '/?featured=1', function( data ) {
			$('#homepage-item-loader').after( data );
			$('#homepage-item-loader').hide();
		});
		return true;
	};

	if( $(window).height() > $('footer').offset().top ){
		setTimeout(homepage_featured_items(),2000);
		loaded = true;
	}
	
	
	$('.link').click(function() {
		$(this).toggleClass('active');
		$('.hidden-list').slideToggle("fast");
		return false;
	});

};




var search_page = function(){

	$('#comp-view').click(function(e){
		$('#view').addClass('compress');
		$(".sh .col-md-9" ).addClass( "col-md-10" );
		$(".search-dashed" ).addClass( "col-md-10" );
		$(".sh .img img").css("display","none");
		$(".featured").css("display","none");
		$(".sh .lt i").css("display","none");
	});
	
	$('#list-view').click(function(e){
		$('#view').removeClass('compress');
		$(".sh .col-md-9" ).removeClass( "col-md-10" );
		$(".search-dashed" ).removeClass( "col-md-10" );
		$(".sh .img img").css("display","block");
		$(".featured").css("display","block");
		$(".sh .lt i").css("display","block");
	});

	//price search
	$('#price_form').submit(function(e) {
			var url = false;
			if($('#min_price').val() && $('#max_price').val())
				url = $('#uri').val() + '/price-from/' + encodeURIComponent($('#min_price').val()) + '/price-to/' + encodeURIComponent($('#max_price').val());
			else if($('#min_price').val())
				url = $('#uri').val() + '/price-from/' + encodeURIComponent($('#min_price').val());
			else if($('#max_price').val())
				url = $('#uri').val() + '/price-to/' + encodeURIComponent($('#max_price').val());
				
			if(url)
				$(location).attr('href', url);
				
			return false;
	});
		
	//if the user wish then save an ad in user history
	$('.save_ad').on("click",function(){
		if($(this).html()=='Remove?'){
			user_unsaved_ad($(this));
		}else{
			user_saved_ad($(this));
		}
	});
	
	$('.save_ad').each(function() {
		if(check_saved_item_status($(this).attr('title'))){
			$(this).html('Saved');
			$(this).addClass('save_ad_active');
		}
	});
	
	$('.save_ad').hover(function(){
		if($(this).html()=='Saved'){
			$(this).html('Remove?');
		}
	},function(){
		if($(this).html()=='Remove?'){
			$(this).html('Saved');
		}
	});
	
	// hide custom google ad if not populated
	setTimeout(function () {
		for(var i=1;i<4;i++){
			if( $('#adcontainer'+i).length && $('#adcontainer'+i).height() < 30 ){
				$('#adcontainer'+i).parent().parent().prev().slideUp();
				$('#adcontainer'+i).parent().parent().slideUp();
			}
		}
	}, 10000);
	
};




var item_detail = function(){
	
	var item_id = $('#item_id').text();

	//social_network();
			
	//ajax to count item views
	$.ajax({
		url: '/item_views/'+item_id+'/',	
		type: "GET",
		cache: true,
		success: function (html) {
			$('.i-views').html(html+'&nbsp;Views');
		}
	});

	recently_viewed_ad_create();
	
	$('.save_ad').on("click",function(){
		if($(this).html()=='Remove?'){
			user_unsaved_ad($(this));
		}else{
			user_saved_ad($(this));
		}
	});
	
	if(check_saved_item_status($('.save_ad').attr('title'))){
		$('.save_ad').html('Saved');
		$('.save_ad').addClass('save_ad_active');
	}
	
	$('.save_ad').hover(function(){
		if($(this).html()=='Saved'){
			$(this).html('Remove?');
		}
	},function(){
		if($(this).html()=='Remove?'){
			$(this).html('Saved');
		}
	});
	
	//start item detail page carousel
	$('.carousel').carousel();

};




var sell_category_page = function(){

	$('.toggle-link').click(function(e) {

		e.preventDefault();
		var pp = $(this).parent().parent();
		if( pp.hasClass('level-one') ){
			$('.level-two').hide();
			$('.level-three').hide();
			$('.level-four').hide();
			$('.level-five').hide();
			$('ul.level-one li.active, ul.level-two li.active, ul.level-three li.active, ul.level-four li.active, ul.level-five li.active').removeClass("active");
		} else if( pp.hasClass('level-two') ){
			$('.level-three').hide();
			$('.level-four').hide();
			$('.level-five').hide();
			$('ul.level-two li.active, ul.level-three li.active, ul.level-four li.active, ul.level-five li.active').removeClass("active");
		} else if( pp.hasClass('level-three') ){
			$('.level-four').hide();
			$('.level-five').hide();
			$('ul.level-three li.active, ul.level-four li.active, ul.level-five li.active').removeClass("active");
		} else if( pp.hasClass('level-four') ){
			$('.level-five').hide();
			$('ul.level-four li.active, ul.level-five li.active').removeClass("active");
		} else if( pp.hasClass('level-five') ){
			$('ul.level-five li.active').removeClass("active");
		}	
		if( (pp.hasClass("level-three")  && !$(this).hasClass('final-level')) || pp.hasClass("level-four") ){
			if (window.innerWidth > 768) {
				$("#categories").animate({
				    marginLeft: '-=25%'
				}, 500);
			}		
		}
		else if( (pp.hasClass("level-four")  && !$(this).hasClass('final-level')) || pp.hasClass("level-five") ){
			if (window.innerWidth > 768) {
				$("#categories").animate({
				    marginLeft: '-=50%'
				}, 500);
			}
		}
		else{
				$("#categories").animate({
				    marginLeft: '0px'
				}, 500);
		}
		if( $(this).hasClass('final-level') ) {
			$('#category_id').val( $(this).attr('href') );
			$('#submit').addClass('ready');
			$('#category_continue').addClass('btn-cbd');
			$('#category_continue').removeClass('disabled');
		} else {
			$('#category_id').val( '' );
			$('#submit').removeClass('ready');
			$('#category_continue').removeClass('btn-cbd');
			$('#category_continue').addClass('disabled');
		}
		$($(this).attr('href')).show('slow');
		$(this).parent().addClass('active');
		
		if (window.innerWidth <= 768) {
	    $('html, body').animate({
	        scrollTop: $($(this).attr('href')).offset().top
	    }, 500);
		}    
	});
	
	$('#submit').click(function(e) {
		if( $(this).hasClass('ready') && $('#category_id').val()!=='' ){
			window.location.href=$('#category_form').attr('action')+$('#category_id').val().replace(/#/g, ''); 
			return false;
		}else{
			return false;
		}
	});
	
};




var sell_form_page = function(){
	
	// image_upload & login & validation are done on view	file
	
	// help popover
	if(screen.width > 768){
		var popover_opt = {trigger:'focus',placement:'right'};
	}else{
		var popover_opt = {trigger:'focus',placement:'top'};
	}
	$('#title').popover(popover_opt);
	$('#price').popover(popover_opt);
	$('.upload_image').popover({trigger:'hover',placement:'right'});
	$('#description').popover(popover_opt);
	// help popover -- ends
	
	
	
	// premium ad
	$('.premium_ads').hover(function(){
		$('#enhance_preview').show();
	},function(){
		$('#enhance_preview').hide();
	});
	$('.featured').hover(function(){
		$('#enhance_preview').html('<img src="/global/img/featured_preview.png" alt="" title="">');
	});
	$('.topofpage').hover(function(){
		$('#enhance_preview').html('<img src="/global/img/top_preview.png" alt="" title="">');
	});
	$('.urgent').hover(function(){
		$('#enhance_preview').html('<img src="/global/img/urgent_preview.png" alt="" title="">');
	});
	
	$('.premium_box').click(function(){

		var f_day = 0;
		var t_day = 0;
		var u_day = 0;
		
		if( $(this).hasClass('featured') ){
			
			if( $('#checkbox_featured').prop('checked') ){
				switch( $('#checkbox_featured').val() ){
					case '0': f_day = 15; break;
					case '15': f_day = 7; break;
					case '7': f_day = 3; break;
					case '3': f_day = 15; break;
					default: break;
				}
				
				$('#checkbox_featured').val(f_day);
				$(this).html(f_day + ' Days');
			}else{
				if($('#checkbox_featured').val() == '0') $('#checkbox_featured').val('15');
			}
			$('#checkbox_featured').prop('checked','checked');
		}

		if( $(this).hasClass('topofpage') ){
			if( $('#checkbox_top').prop('checked') ){
				switch( $('#checkbox_top').val() ){
					case '0': t_day = 15; break;
					case '15': t_day = 7; break;
					case '7': t_day = 3; break;
					case '3': t_day = 15; break;
					default: break;
				}
			
				$('#checkbox_top').val(t_day);
				$(this).html(t_day + ' Days');
			}else{
				if($('#checkbox_top').val() == '0') $('#checkbox_top').val('15');
			}
			$('#checkbox_top').prop('checked','checked');
		}

		if( $(this).hasClass('urgent') ){
			if( $('#checkbox_urgent').prop('checked') ){
				switch( $('#checkbox_urgent').val() ){
					case '0': u_day = 15; break;
					case '15': u_day = 7; break;
					case '7': u_day = 3; break;
					case '3': u_day = 15; break;
					default: break;
				}
			
				$('#checkbox_urgent').val(u_day);
				$(this).html(u_day + ' Days');
			}else{
				if($('#checkbox_urgent').val() == '0') $('#checkbox_urgent').val('15');
			}
			$('#checkbox_urgent').prop('checked','checked');
		}
		
		calculate_total();
	});

	$('.checkbox_enhance').click(function(){

		if($(this).val() == '0')
			$(this).val('15');
			
		calculate_total();
	});
	// premium ad -- ends
	
	
	
	
	
	// payment method
	$('.shipping').hide();
	$('#tick_shipping_n').hide();
	$('#shipping_national').hide();
	$('#tick_shipping_i').hide();
	$('#shipping_international').hide();
	
	if($('#is_buy_button_click_card').val() == 'yes'){
		$('#checkbox_clickcard').prop('checked','checked');
		buy_button_control();
		shipping_control();
	}
	
	if($('#is_buy_button_credit_card').val() == 'yes'){
		$('#checkbox_creditcard').prop('checked','checked');
		buy_button_control();
		shipping_control();
	}
	
	$('#checkbox_clickcard').click(function(){
		buy_button_control();	
	});
	
	$('#checkbox_creditcard').click(function(){
		buy_button_control();
	});
	
	
	$('#select_shipping_l').click(function(){
		if($(this).val() == 'offered'){
			$('#tick_shipping_l').show();
			$('#shipping_local').show();
			$('#shipping_local').val('free');
		}else{
			$('#tick_shipping_l').hide();
			$('#shipping_local').hide();
		}
	});
	
	$('#select_shipping_n').click(function(){
		if($(this).val() === 'offered'){
			$('#tick_shipping_n').show();
			$('#shipping_national').show();
			$('#shipping_national').val('free');
		}else{
			$('#tick_shipping_n').hide();
			$('#shipping_national').hide();
		}
	});
	
	$('#select_shipping_i').click(function(){
		if($(this).val() == 'offered'){
			$('#tick_shipping_i').show();
			$('#shipping_international').show();
			$('#shipping_international').val('free');
		}else{
			$('#tick_shipping_i').hide();
			$('#shipping_international').hide();
		}
	});
	
	$('.shipping input').focus(function(){
		$(this).select();	
	});

	if($('#checkbox_clickcard').prop('checked') || $('#checkbox_creditcard').prop('checked')){

		if( ! IsNumeric( $('.shipping #input_quantity').val() ) ){
			alert('quantity can be digit only');
			return false;
		}
		
		var shipping_l = $('.shipping #shipping_local').val().toLowerCase();
		var shipping_n = $('.shipping #shipping_national').val().toLowerCase();
		var shipping_i = $('.shipping #shipping_international').val().toLowerCase();
		
		if( $('#select_shipping_l').val() == 'not_offered' || ( $('#select_shipping_l').val() == 'offered' && shipping_l == 'free' ) ){
			//do nothing
		}else{
			if( ! IsNumeric(shipping_l) ){
				alert('local shipping charge can be digit only');
				return false;
			}
		}
		
		if( $('#select_shipping_n').val() == 'not_offered' || ($('#select_shipping_n').val() == 'offered' && shipping_n == 'free') ){
			//do nothing
		}else{
			if( ! IsNumeric(shipping_n) ){
				alert('national shipping charge can be digit only');
				return false;
			}
		}
		
		if( $('#select_shipping_i').val() == 'not_offered' || ($('#select_shipping_i').val() == 'offered' && shipping_i == 'free') ){
			//do nothing
		}else{
			if( ! IsNumeric(shipping_i) ){
				alert('international shipping charge can be digit only');
				return false;
			}
		}
	}	
	// payment method -- ends
	


	
	
};



var calculate_total = function(){
	
	var featured_fee = 0;
	var top_fee = 0;
	var urgent_fee = 0;

	if($('#checkbox_featured').prop('checked')){
		switch($('#checkbox_featured').val()){
			case '15'	: featured_fee = 300; break;
			case '7'	: featured_fee = 180; break;
			case '3'	: featured_fee = 120; break;
		}
	}
	
	if($('#checkbox_top').prop('checked')){
		switch($('#checkbox_top').val()){
			case '15'	: top_fee = 150; break;
			case '7'	: top_fee = 90; break;
			case '3'	: top_fee = 60; break;
		}
	}
	
	if($('#checkbox_urgent').prop('checked')){
		switch($('#checkbox_urgent').val()){
			case '15'	: urgent_fee = 72; break;
			case '7'	: urgent_fee = 42; break;
			case '3'	: urgent_fee = 30; break;
		}
	}
	
	var total = parseInt(featured_fee) + parseInt(top_fee) + parseInt(urgent_fee);
	$('.enhance_total').html('Cost of this ad: Tk. ' + total);
	$('#total').val(total);
	
	if(parseInt(total) > 0){
		$('#submit_post_an_ad').val('Post Premium Ad');
		return false;
	}
	
	$('#submit_post_an_ad').val('Post your FREE ad');
};




var buy_button_control = function(){
	
	if($('#checkbox_clickcard').prop('checked') || $('#checkbox_creditcard').prop('checked')){
		$('.shipping').fadeTo('slow', 1);
	}else{
		$('.shipping').fadeTo('slow', 0.0);
		$('.shipping').hide();
	}
};




var shipping_control = function(){

	if( $('#shipping_local').val() === '' ){
		$('#select_shipping_l').val('not_offered');
		$('#tick_shipping_l').hide();
		$('#shipping_local').hide();
	}else if($('#shipping_local').val()=='0' || $('#shipping_local').val().toLowerCase()=='free'){
		$('#select_shipping_l').val('offered');
		$('#tick_shipping_l').show();
		$('#shipping_local').val('free');
		$('#shipping_local').show();
	}else{
		$('#select_shipping_l').val('offered');
		$('#tick_shipping_l').show();
		$('#shipping_local').show();
	}

	if( $('#shipping_national').val() === '' ){
		$('#select_shipping_n').val('not_offered');
		$('#tick_shipping_n').hide();
		$('#shipping_national').hide();
	}else if($('#shipping_national').val()=='0' || $('#shipping_national').val().toLowerCase()=='free'){
		$('#select_shipping_n').val('offered');
		$('#tick_shipping_n').show();
		$('#shipping_national').val('free');
		$('#shipping_national').show();
	}else{
		$('#select_shipping_n').val('offered');
		$('#tick_shipping_n').show();
		$('#shipping_national').show();
	}

	if( $('#shipping_international').val() === '' ){
		$('#select_shipping_i').val('not_offered');
		$('#tick_shipping_i').hide();
		$('#shipping_international').hide();
	}else if($('#shipping_international').val()=='0' || $('#shipping_international').val().toLowerCase()=='free'){
		$('#select_shipping_i').val('offered');
		$('#tick_shipping_i').show();
		$('#shipping_international').val('free');
		$('#shipping_international').show();
	}else{
		$('#select_shipping_i').val('offered');
		$('#tick_shipping_i').show();
		$('#shipping_international').show();
	}


};







var estore_profile = function(){

	$('#estore_profile .tooltip').focus(function() {
		var content = $(this).parent().parent().parent().get(0).id;
		$('#'+content+' .bubble_message').css('z-index','100');
		$('#'+content+' .bubble_message').fadeTo('slow', 1);
	});

	$('#estore_profile .tooltip').focusout(function(){
		var content = $(this).parent().parent().parent().get(0).id;
		$('#'+content+' .bubble_message').css('z-index','3');
		$('#'+content+' .bubble_message').fadeTo('fast', 0.0);
	});
	
	$('#about_container').hide();
	$('#contact_container').hide();

	$('#welcome_trigger .captiongray_desc').css('background-color','#cccccc');
	
	$('#about_trigger').click(function(){
		$('#about_trigger .captiongray_desc').css('background-color','#cccccc');
		$('#welcome_trigger .captiongray_desc').css('background-color','#F7F6F5');
		$('#contact_trigger .captiongray_desc').css('background-color','#F7F6F5');
		
		$('#about_container').show();
		$('#welcome_container').hide();
		$('#contact_container').hide();
	});
	
	$('#welcome_trigger').click(function(){
		$('#about_trigger .captiongray_desc').css('background-color','#F7F6F5');
		$('#welcome_trigger .captiongray_desc').css('background-color','#cccccc');
		$('#contact_trigger .captiongray_desc').css('background-color','#F7F6F5');
		
		$('#about_container').hide();
		$('#welcome_container').show();
		$('#contact_container').hide();
	});
	
	$('#contact_trigger').click(function(){
		$('#about_trigger .captiongray_desc').css('background-color','#F7F6F5');
		$('#welcome_trigger .captiongray_desc').css('background-color','#F7F6F5');
		$('#contact_trigger .captiongray_desc').css('background-color','#cccccc');
		
		$('#about_container').hide();
		$('#welcome_container').hide();
		$('#contact_container').show();
	});
	
	$('#estore_background').change(function(){
		$('body').removeClass();
		$('body').addClass('theme_bg_'+$('#estore_theme Option:selected').val());
		$('body').addClass('estore_bg_img_'+$('#estore_background Option:selected').val());
	});
	
	$('#estore_theme').change(function(){
		$('.estore_header').removeAttr('id');
		$('.estore_header').attr('id','estore_header_'+$('#estore_theme Option:selected').val());
		$('.estore_footer').removeAttr('id');
		$('.estore_footer').attr('id','estore_footer_'+$('#estore_theme Option:selected').val());
		
		$('body').removeClass();
		$('body').addClass('theme_bg_'+$('#estore_theme Option:selected').val());
		$('body').addClass('estore_bg_img_'+$('#estore_background Option:selected').val());
	});
	
	$('#delete_welcome_image').click(function(){
		$.ajax({
			url: "/estore/delete_welcome_image/",
			type: "POST",
			cache: false,
			success: function (html) {
				if(html == 'success'){
					alert('successfully deleted');
					$('#img_welcome').attr('src','');
					$('#delete_welcome_image').hide();
				}
			}
		});
	});

};




var recently_viewed_ad_create = function(){

	var item_id = $('#item_id').val();
	var item_price = $('#item_price').val();
	var is_image = $('#is_image').val();
	var no_item_image = '';

	var cookie_item = $.cookie('v');

	if( !cookie_item){
		$.cookie('v','', { expires: 180, path: '/' });
		cookie_item = $.cookie('v');
	}

	if(!cookie_item){
		return false;	
	}
	
	cookie_item = cookie_item.split('-');
	
	if(is_image=='n') no_item_image='_n';
	
	var cookie_txt = item_id + '_' + item_price + no_item_image + '-';

	for($i=0;$i<4;$i++){
		if( ! cookie_item[$i]){
			break;
		}

		var tmp_cookie_item = cookie_item[$i].split('_');
		if(tmp_cookie_item.length < 2){
			break;
		}
		
		if(tmp_cookie_item.length == 3){
			cookie_txt += (tmp_cookie_item[0] + "_" + tmp_cookie_item[1] + '_' + tmp_cookie_item[2] + '-');
		}else{
			cookie_txt += (tmp_cookie_item[0] + "_" + tmp_cookie_item[1] + '-');
		}
	}

	$.cookie('v',cookie_txt, { expires: 180, path: '/' });

};



//saved user item at cookie
var user_saved_ad = function($object){
	var item_info = $object.attr('title');
	item_info = item_info.split('_');

	var item_id = item_info[0];
	var item_price = item_info[1];
	var is_image = item_info[2];
	var no_item_image = '';
	
	var cookie_item = $.cookie('s');

	if( !cookie_item){
		$.cookie('s','', { expires: 180, path: '/' });
		cookie_item = $.cookie('s');
	}
	
	if(cookie_item.indexOf(item_id) != -1){
		return false;	
	}
	
	cookie_item = cookie_item.split('-');
	if(is_image=='n') no_item_image='_n';

	var cookie_txt = item_id + '_' + item_price + no_item_image + '-';
	
	for($i=0;$i<=3;$i++){
		if( ! cookie_item[$i]){
			break;
		}

		var tmp_cookie_item = cookie_item[$i].split('_');
		if(tmp_cookie_item.length < 2){
			break;
		}

		if(tmp_cookie_item.length == 3){
			cookie_txt += (tmp_cookie_item[0] + "_" + tmp_cookie_item[1] + '_' + tmp_cookie_item[2] + '-');
		}else{
			cookie_txt += (tmp_cookie_item[0] + "_" + tmp_cookie_item[1] + '-');
		}
	}

	$.cookie('s',cookie_txt, { expires: 180, path: '/' });

	$object.html('Saved');
	$object.addClass('save_ad_active');
};




//Unsaved user item at cookie
var user_unsaved_ad = function($object){
	var item_info = $object.attr('title');
	item_info = item_info.split('_');
	
	var item_id = item_info[0];
	var item_price = item_info[1];
	var is_image = item_info[2];
	var no_item_image = '';
	
	var cookie_item = $.cookie('s');
	if( !cookie_item){
		$.cookie('s','', { expires: 180, path: '/' });
		cookie_item = $.cookie('s');
	}

	if(cookie_item.indexOf(item_id) == -1){
		return false;	
	}
	
	cookie_item = cookie_item.split('-');
	if(is_image=='n') no_item_image='_n';

	var cookie_txt = '';
	
	for($i=0;$i<5;$i++){
		if( ! cookie_item[$i]){
			break;
		}

		var tmp_cookie_item = cookie_item[$i].split('_');
		if(tmp_cookie_item.length < 2){
			break;
		}

		if(tmp_cookie_item[0] != item_id){
			if(tmp_cookie_item.length == 3){
				cookie_txt += (tmp_cookie_item[0] + "_" + tmp_cookie_item[1] + '_' + tmp_cookie_item[2] + '-');
			}else{
				cookie_txt += (tmp_cookie_item[0] + "_" + tmp_cookie_item[1] + '-');
			}
		}
	}

	$.cookie('s',cookie_txt, { expires: 180, path: '/' });
	
	$object.html('Save');
	$object.removeClass('save_ad_active');
};




//view recently viewed ads history
var recently_viewed_ad = function(){
	var str = "<span class='fgrey1'>Your recently viewed ads</span><br /><br />";
	$('#ads_container').empty();
	
	var cookie_item = $.cookie('v');
	if( !cookie_item){
		return false;	
	}
	
	cookie_item = cookie_item.split('-');

	for(var i=0;i <=4;i++){

		var cookie_txt = cookie_item[i].split('_');
		if(cookie_txt.length < 2){
			break;
		}
		
		var item_id = cookie_txt[0];
		var item_price = cookie_txt[1];
		var is_image = 'y';
		
		if(cookie_txt.length == 3) is_image = cookie_txt[2];
		
	var img_path = "<div style='float:left;width:68px;text-align:center;'>";
					img_path += "<a href='/" + item_id + "'>";
						if(is_image=='y'){
							img_path += "<img class='fgrey1' height='45px' style='font-size:110%;' alt='' src='http://static.clickbd.com/global/classified/item_img/" + item_id + "_0_small.jpg' />";
						}else{
							img_path += "<img class='fgrey1' height='45px' style='font-size:110%;' alt='' src='/global/img/no_image1.png' />";
						}
						img_path += "<br /><p style='text-align:center !important;' class='fgrey1'>" + tk(item_price) + "</p>";
					img_path += "</a>";
				img_path += "</div>";
			if(i != 4){
				img_path += "<div style='float:left;width:7px;height:20px;'></div>";
			}
		str = str + img_path;
	}
	if(str === ''){
		$('#ads_container').html("<b class='fgrey1'>There is no recent viewed ads  found</b>");
		return false;
	}
	$('#ads_container').html(str);
};




//view saved ads
var view_saved_ad = function(){
	var str = "<span class='fgrey1'>Your saved ads</span><br /><br />";
	$('#ads_container').empty();
	
	var cookie_item = $.cookie('s');
	if( !cookie_item){
		return false;	
	}
	
	cookie_item = cookie_item.split('-');
	
	for(var i=0;i < 5;i++){

		var cookie_txt = cookie_item[i].split('_');
		if(cookie_txt.length < 2){
			break;	
		}
		
		var item_id = cookie_txt[0];
		var item_price = cookie_txt[1];
		var is_image = 'y';
		
		if(cookie_txt.length == 3) is_image = cookie_txt[2];
		
		var img_path = "<div style='float:left;width:68px;text-align:center;'>";
					img_path += "<a href='/" + item_id + "'>";
						if(is_image=='y'){
							img_path += "<img class='fgrey1' height='45px' style='font-size:110%;' alt='' src='http://static.clickbd.com/global/classified/item_img/" + item_id + "_0_small.jpg' />";
						}else{
							img_path += "<img class='fgrey1' height='45px' style='font-size:110%;' alt='' src='/global/img/no_image1.png' />";
						}
						img_path += "<br /><p style='text-align:center !important;' class='fgrey1'>" + tk(item_price) + "</p>";
					img_path += "</a>";
				img_path += "</div>";
			if(i != 4){
				img_path += "<div style='float:left;width:7px;height:20px;'></div>";
			}
		str = str + img_path;
	}
	if(str === ''){
		$('#ads_container').html("<b class='fgrey1'>There is no saved ads  found</b>");
		return false;
	}
	$('#ads_container').html(str);
};






//check email address is valid or not
var checkemail = function(val){
	//return (val.indexOf(".") > 2) && (val.indexOf("@") > 0);
	var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	var address = val;
	if(reg.test(address) === false) {
		return false;
	}

	return true;
};




//check the parameter value is number or not
var IsNumeric = function(num){
	var ValidChars = "0123456789";
	var IsNumber = true;
	var Char;
	
	for(i = 0; i < num.length && IsNumber===true; i++) { 
		Char = num.charAt(i); 
		if( ValidChars.indexOf(Char) == -1){
			IsNumber = false;
		}
	}
	return IsNumber;
};




var facebook_connect = function(){
	$.ajax({
		url: "/login/check_login_status/",
		type: "GET",
		cache: false,
		success: function (html) {
			
			switch(html){
				case 'cb_logged': 
							$('#login_with_fb').css('display','none');
							$('#login_with_fb_mobile').css('display','none');
							$('#login_with_cb').css('display','none');
							$('#signup').css('display','none');
							$('#login_status').val('cb_logged');
							//$('#is_mobile').val('yes');
							break;
				case 'cb_logged_no_mobile': 
							$('#login_with_fb').css('display','none');
							$('#login_with_cb').css('display','none');
							$('#signup').css('display','none');
							$('#login_with_fb_mobile').css('display','block');
							$('#login_status').val('cb_logged');
							$('#is_mobile').val('no');
							break;
/*
				case 'cb_logged_location': 
							$('#login_with_fb').css('display','none');
							$('#login_with_cb').css('display','none');
							$('#signup').css('display','none');
							$('#login_with_fb_mobile').css('display','block');
							$('#login_status').val('cb_logged');
							$('#is_mobile').val('no');
							break;
*/
				case 'fb_logged': 
							$('#login_with_fb').css('display','none');
							$('#login_with_fb_mobile').css('display','none');
							$('#login_with_cb').css('display','none');
							$('#signup').css('display','none');
							$('#login_status').val('facebook_logged');
							//$('#is_mobile').val('yes');
							break;
				case 'fb_logged_no_mobile': 
							$('#login_with_fb').css('display','none');
							$('#login_with_cb').css('display','none');
							$('#signup').css('display','none');
							$('#login_with_fb_mobile').css('display','block');
							$('#login_status').val('facebook_logged');
							$('#is_mobile').val('no');
							break;
/*
				case 'fb_logged_no_location': 
							$('#login_with_fb').css('display','none');
							$('#login_with_cb').css('display','none');
							$('#signup').css('display','none');
							$('#login_with_fb_mobile').css('display','block');
							$('#login_status').val('facebook_logged');
							$('#is_mobile').val('no');
							break;
*/
				default: break;

			}
		}
	});
};



var contact_clickbd = function(){

		//form submission
		$('#contact_form').submit(function(e) {
			e.preventDefault();

			var subject = $('#subject');
			var email = $('#email');
			var message = $('#message');
			var fullname = $('#fullname');
			$('.fred').text('');
	
			if (subject.val()==='' || email.val()==='' || message.val()==='' || fullname.val()==='') {
				$('.alert').html('* all fields are required');
				return false;
			}

			var data = 'cmd=send' + '&email=' + email.val() + '&subject=' + encodeURIComponent(subject.val()) + '&message='  + encodeURIComponent(message.val()) + '&fullname=' + fullname.val();

			$('#contact_spinner').show();

			//start the ajax
			$.ajax({
				url: "/contact_us/",	
				type: "POST",
				data: data,		
				cache: false,
				success: function (html) {
					
					$('#contact_spinner').hide();
					if( html.search("successful")!=-1 ){

						$('#contact_email').hide();					
						$('#contact_success').fadeIn('slow');

					}else{

						$('.alert').html(html);

					}
				}
			});	
			return false;
		});
		
};



var check_saved_item_status = function(info){
	var item_info = null;
	if( !info){ return false; }
	item_info = info.split('_');
	
	var item_id = item_info[0];
	
	var cookie_item = $.cookie('s');
	
	if(cookie_item && cookie_item.indexOf(item_id) != -1){
		return true;
	}
	
};


function tk(num){
	var format = '#,##,#,#,###';

	var val = num;
	var len = val.length;
	var rt = '';

	format = format.substr(len*-1,len);
	
	for(var i=1; i<=len; i++)
	{
		if( format.substr(i*-1,1) != '#' ) 
			rt = format.substr(i*-1,1) + rt;
			
		rt = val.substr(i*-1,1) + rt;
	}
	
	return 'Tk. ' + rt;  // taka sign in html &#2547
}

var social_network = function(){
	
	var self_url = document.location.href;
	 
	$('#fb_share_click').click(function(){
		window.open("http://www.facebook.com/sharer.php?u="+self_url,'name','height=400,width=600');
	});
	
	$('#tweet_click').click(function(){
		
		var page_title = encodeURIComponent(document.title);
		window.open("http://twitter.com/intent/tweet?url="+self_url+"&text="+page_title+"&hashtags=ClickBD&via=ClickBD",'name','height=400,width=600');
	});

	if( $('#fb_count').length ){
		$.getJSON('http://graph.facebook.com/'+self_url, function(data) {$('#fb_count').html(data.shares || 0);});
	}
	if( $('#tweet_count').length ){
		$.getJSON('http://urls.api.twitter.com/1/urls/count.json?url='+self_url, function(data) {$('#tweet_count').html(data.count || 0);});
	}
};










/*!
 * jQuery Cookie Plugin v1.3.1
 * https://github.com/carhartl/jquery-cookie
 *
 * Copyright 2013 Klaus Hartl
 * Released under the MIT license
 */
(function(e){if(typeof define==="function"&&define.amd){define(["jquery"],e)}else{e(jQuery)}})(function(e){function n(e){if(i.raw){return e}try{return decodeURIComponent(e.replace(t," "))}catch(n){}}function r(e){if(e.indexOf('"')===0){e=e.slice(1,-1).replace(/\\"/g,'"').replace(/\\\\/g,"\\")}e=n(e);try{return i.json?JSON.parse(e):e}catch(t){}}var t=/\+/g;var i=e.cookie=function(t,s,o){if(s!==undefined){o=e.extend({},i.defaults,o);if(typeof o.expires==="number"){var u=o.expires,a=o.expires=new Date;a.setDate(a.getDate()+u)}s=i.json?JSON.stringify(s):String(s);return document.cookie=[i.raw?t:encodeURIComponent(t),"=",i.raw?s:encodeURIComponent(s),o.expires?"; expires="+o.expires.toUTCString():"",o.path?"; path="+o.path:"",o.domain?"; domain="+o.domain:"",o.secure?"; secure":""].join("")}var f=t?undefined:{};var l=document.cookie?document.cookie.split("; "):[];for(var c=0,h=l.length;c<h;c++){var p=l[c].split("=");var d=n(p.shift());var v=p.join("=");if(t&&t===d){f=r(v);break}if(!t&&(v=r(v))!==undefined){f[d]=v}}return f};i.defaults={};e.removeCookie=function(t,n){if(e.cookie(t)!==undefined){e.cookie(t,"",e.extend({},n,{expires:-1}));return true}return false}})


//-->