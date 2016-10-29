$(document).ready(function () {

	// booking calendar show in frontend
	var globalid ="";

	var baseUrl = window.location.origin;

	var token = $('input[name=_token]').val();

	$("a.calendar").on('click',function()
	{

		var	id = $(this).attr('data-id');
		var rowid1 = $(this).attr('data-rowid');
		if(window.location.href == baseUrl+"/template/Cart")
		{
			var updatecart = "Change date";
			var url = baseUrl+'/template/addCart/'+id+'?_token='+token+'&rowid='+rowid1;
		}else
		{
			updatecart = "Add to cart"
			var url = baseUrl+'/template/addCart/'+id+'?_token='+token;
		}


		$("a#hdcalendar"+id).on('click',function(){
			$('#frontend'+globalid).removeClass("dopbcp-initialized");
			$('#frontend'+globalid).empty();
			$(this).hide();
		});

		$("#frontend"+id).show();
		$("#hdcalendar"+id).show();
		if(globalid == '' && globalid != id)
		{
			$('#frontend'+id).DOPFrontendBookingCalendarPRO({
				'ID':id,
				'loadURL': baseUrl+"/template/getcalendar",
				'sendURL': url,
				"form":{"data": {"form":[]},
					"text": {"checked":"Checked",
						"invalidEmail":"is invalid. Please enter a valid email.",
						"required":"is required.",
						"title":"",
						"unchecked":"Unchecked"}},
				"order": {"data": {"redirect": "",
					"terms": false,
					"termsLink": ""},
					"text": {
						"book": updatecart,
						"book1": "Add to cartsadsa",
						"success": "Reservation has been added!",
						"terms": "I accept to agree to the Terms & Conditions.",
						"termsInvalid": "You must agree with our Terms & Conditions to continue.",
						"title": "Order",
						"unavailable": "The period you selected is not available anymore. The calendar will refresh to update the schedule."}},
			});
		globalid =id;
		}
		if(globalid !="" && globalid != id)
		{
			$(".calendar12").removeClass("dopbcp-initialized");
			$(".calendar12").empty();
			$('#frontend'+globalid).removeClass("dopbcp-initialized");
			$('#frontend'+globalid).empty();
			$('#frontend'+id).DOPFrontendBookingCalendarPRO({
				'ID':id,
				'loadURL':  baseUrl+"/template/getcalendar",
				'sendURL': url,
				"form":{"data": {"form":[]},
					"text": {"checked":"Checked",
						"invalidEmail":"is invalid. Please enter a valid email.",
						"required":"is required.",
						"title":"",
						"unchecked":"Unchecked"}},
				"order": {"data": {"redirect": "",
					"terms": false,
					"termsLink": ""},
					"text": {
						"book": "Add to cart",
						"book1": "Add to cartsadsa",
						"success": "Reservation has been added!",
						"terms": "I accept to agree to the Terms & Conditions.",
						"termsInvalid": "You must agree with our Terms & Conditions to continue.",
						"title": "Order",
						"unavailable": "The period you selected is not available anymore. The calendar will refresh to update the schedule."}},
			});
			globalid =id;
		}
	});
	//UPDATE QTY CART AJAX
	$(".qtyinput").focusin(function(){
		var oldvl = $(this).val();
		$(this).focusout(function(){
			var newvl = $(this).val();
			var rowid = $(this).attr('data-rowid');
			var booktype = $(this).attr('data-type');
			if($.isNumeric(newvl) == true && newvl > 0){
				if(oldvl != newvl){
					$.ajax({
						url:baseUrl+"/template/editcart",
						type:'POST',
						dataType:'JSON',
						data:{rowid:rowid,newvl:newvl,_token:token,booktype:booktype},
						success:function(data)
						{
							location.reload();
						}
					});
				}
			}else{
				alert('Number is Invalid');
				$(this).val(oldvl);
			}
		});
	});
	// DELETE CART
	$(".mydelete").on('click',function(){
		if(confirm("Are you sure want to delete ?")){

			var rowid = $(this).attr('data-rowid');
			$.ajax({
				url : baseUrl+"/template/deletecart",
				type :'post',
				dataType:'json',
				data:{rowid:rowid,_token:token},
				success: function (data)
				{
					location.reload();
				}
			});
		}else
		{
			return false;
		}


	});

	//UI FORM ELEMENTS
	var spinner = $('.spinner input').spinner({ min: 0 });

	$('.datepicker-wrap input').datepicker({
		showOn: 'button',
		buttonImage: '../public/template/images/ico/calendar.png',
		buttonImageOnly: true
	});

	$( '#slider' ).slider({
		range: "min",
		value:1,
		min: 0,
		max: 10,
		step: 1
	});

	//CUSTOM FORM ELEMENTS
	$('input[type=radio],select, input[type=checkbox]').uniform();

	//SCROLL TO TOP BUTTON
	$('.scroll-to-top').click(function () {
		$('body,html').animate({
			scrollTop: 0
		}, 800);
		return false;
	});

	//HEADER RIBBON NAVIGATION
	$('.ribbon li').hide();
	$('.ribbon li.active').show();
	$('.ribbon li a').click(function() {
		$('.ribbon li').hide();
		if ($(this).parent().parent().hasClass('open'))
			$(this).parent().parent().removeClass('open');
		else {
			$('.ribbon ul').removeClass('open');
			$(this).parent().parent().addClass('open');
		}
		$(this).parent().siblings().each(function() {
			$(this).removeClass('active');
		});
		$(this).parent().attr('class', 'active');
		$('.ribbon li.active').show();
		$('.ribbon ul.open li').show();
		return true;
	});

	//LIGHTBOX
	$("a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',theme:'light_square'});

	//TABS
	$('.tab-content').hide().first().show();
    $('.inner-nav li:first').addClass("active");

    $('.inner-nav a').on('click', function (e) {
        e.preventDefault();
        $(this).closest('li').addClass("active").siblings().removeClass("active");
        $($(this).attr('href')).show().siblings('.tab-content').hide();
		var currentTab = $(this).attr("href");
		if (currentTab == "#location")
		initialize();
    });

    var hash = $.trim( window.location.hash );
    if (hash) $('.inner-nav a[href$="'+hash+'"]').trigger('click');

	//CSS
	$('.top-right-nav li:last-child,.social li:last-child,.twins .f-item:last-child,.ribbon li:last-child,.room-types li:last-child,.three-col li:nth-child(3n),.reviews li:last-child,.three-fourth .deals .one-fourth:nth-child(3n),.full .deals .one-fourth:nth-child(4n),.locations .one-fourth:nth-child(3n),.pager span:last-child,.get_inspired li:nth-child(5n)').addClass('last');
	$('.bottom nav li:first-child,.pager span:first-child').addClass('first');

	//ROOM TYPES MORE BUTTON
	$('.more-information').slideUp();
	$('.more-info').click(function() {
		var moreinformation = $(this).closest('li').find('.more-information');
		var txt = moreinformation.is(':visible') ? '+ more info' : ' - less info';
		$(this).text(txt);
		moreinformation.stop(true, true).slideToggle('slow');
	});

	//MAIN SEARCH
	$('.main-search input[name=radio]').change(function() {
		var showForm = $(this).val();
		$('.form').hide();
		$("#"+showForm).show();
	});

	$('.form').hide();
	$('.form:first').show();
	$('.f-item:first').addClass("active");
	$('.f-item:first span').addClass("checked");

	$('.f-item .radio').click(function() {
		$('.f-item').removeClass("active");
		$(this).parent().addClass("active");
	});

	// LIST AND GRID VIEW TOGGLE
	$('.view-type li:first-child').addClass('active');

	$('.grid-view').click(function() {
		$('.three-fourth article').attr("class", "one-fourth");
		$('.three-fourth article:nth-child(3n)').addClass("last");
		$('.view-type li').removeClass("active");
		$(this).addClass("active");
	});

	$('.list-view').click(function() {
		$('.three-fourth article').attr("class", "full-width");
		$('.view-type li').removeClass("active");
		$(this).addClass("active");
	});

	//LOGIN & REGISTER LIGHTBOX
	$('.close').click(function() {
		$('.lightbox').hide();
	});

	//MY ACCOUNT EDIT FIELDS
	$('.edit_field').hide();
    $('.edit').on('click', function (e) {
        e.preventDefault();
        $($(this).attr('href')).toggle('slow', function(){});
    });
	$('.edit_field a,.edit_field input[type=submit]').click(function() {
		$('.edit_field').hide(400);
	});

	//HOTEL PAGE GALLERY
	$('.gallery img:first-child').css('opacity',1);

	var i=0,p=1,q=function(){return document.querySelectorAll(".gallery>img")};

	function s(e){
	for(c=0;c<q().length;c++){q()[c].style.opacity="0";q()[e].style.opacity="1"}
	}

	setInterval(function(){
	if(p){i=(i>q().length-2)?0:i+1;s(i)}
	},5000);
});


jQuery(document).ready(function(){

	$('#contactform').submit(function(){
		var action = $(this).attr('action');
		$("#message").show(400,function() {
		$('#message').hide();

 		$('#submit')
			.after('<img src="images/ajax-loader.gif" class="loader" />')
			.attr('disabled','disabled');

		$.post(action, {
			name: $('#name').val(),
			email: $('#email').val(),
			phone: $('#phone').val(),
			//subject: $('#subject').val(),
			comments: $('#comments').val()
			//verify: $('#verify').val()
		},
			function(data){
				document.getElementById('message').innerHTML = data;
				$('#message').slideDown('slow');
				$('#contactform img.loader').fadeOut('slow',function(){$(this).remove()});
				$('#submit').removeAttr('disabled');
				//if(data.match('success') != null) $('#contactform').slideUp(3000);

			}
		);

		});

		return false;
	});
});