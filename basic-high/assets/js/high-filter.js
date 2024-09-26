/***
	*
	* Ajax filter for Selig Data 
	*
***/

jQuery(document).ready(function($){

function unique(array) {
    return $.grep(array, function(el, index) {
        return index === $.inArray(el, array);
    });
}

// reset filter 
	$('.remove-filters' ).on('click' ,function(e){
		e.preventDefault();
				
		$('body').find('.filter-col.right-col p.filter-count').empty();
		$('body').find('.filter-col.right-col ul.seal-list').remove();
		$('body').find('.filter-col.right-col .filter-content').empty();
		$('body').find('.filter-col.right-col .filter-content').html('<div class="filter-text bob"><p class="filter-notice">PLEASE NOTE: Each time you click on an option, the list will be updated with a group of products that match your criteria.</p></div>');
		$('body').find('.filter-col.right-col .filter-wrap').remove();
		
		$('body').find('.filter-col.left-col .cat-menu ul').removeClass('active selected').removeAttr('disabled');
		$('body').find('.filter-col.left-col .cat-menu ul.download-cat').removeClass('inactive').removeAttr('disable');
		$('body').find('.filter-col.left-col li.download-items').removeClass('nada');
		$('.filter-col.left-col li.download-items input.sub-cats').removeAttr('checked');
		$('.filter-col.left-col li.download-items input.sub-cats').removeAttr('disabled');
		$(this).hide();
	
	});
	
	
	// toggle filter categories
	/* 	$('li.cat-icon').on('click',function(){
			 
			var icon = $(this).find('i.icon-tog'),
				subcat = $(this).parents('.download-cat').find('li.has-cats');
				
				$(this).parents('.download-cat').addClass('active')
			
			$('.cat-icon i.icon-tog').addClass('open-icon');
			$('.download-cat').find('li.has-cats').not(subcat).removeClass('open-cats');

			$(icon).toggleClass('open-icon');
			$(subcat).toggleClass('open-cats');
		}); */
	
	

$(document.body).on('change', '.download-items input[type="checkbox"]', function(event){
	event.preventDefault();
	
	$('a.remove-filters').show();
	
	var cat = [],
		selector = $('input'),
		selection = $(this),
		selected = $(this).attr('checked'),
		pcat = $(this).attr('data-pcat'),
		sub = $(this).attr('data-sub'),
		list = $(selection).parent('li').siblings(),
		topUl = $('ul#cat-' + pcat),
		activatedID = $('ul.selected').attr('id'),
		selectedID = $(topUl).attr('id');
				
				
		$('.sub-cats:checked').each(function(i, e) {
				cat.unshift($(this).val());
		});
		
		
		var checkVal = $(this).val();
	
		
	if($(selection).attr("checked")){
			$(selection).attr('checked', false);
			$(topUl).removeClass('active');
			$(list).each(function(){
				$(this).children('input.sub-cats').removeAttr("disabled");
				$(this).children('label').css("opacity", '1');
			});
			
		 var rmsub = sub;
			
			console.log('this cat removed ' + rmsub)
			
		}else{ 
			$(this).attr('checked', true);
			$(topUl).addClass('active'); 
			/* $(list).each(function(){
				$(this).children('input').attr("disabled", true);
				$(this).children('label').css("opacity", '.4');
			});  */
			
			$('.sub-cats:checked').each(function() {
				cat.push($(this).val());
			});
			
			cat.push(sub);
			console.log('this cat added ' + sub)
		}
			cat = unique(cat);  
			
		// get filter posts
		$('.filter-results').fadeOut();
		
		data = {
			action: 'high_filter_posts',  
			high_nonce: high_filter.high_nonce,
			cat: $('.sub-cats:checked').serializeArray(),
			pcat: pcat,
			sub: sub,
		},
		
		$.ajax({
			type: 'post',
			dataType: "json",
			url: high_filter.ajax_url,
			data: data,
			beforeSend: function(){
			$(".load").css("display", "block");
			},
			success: function(data) {
				$('.filter-notice.hide-desk').remove();
				$(".filter-content .found").remove();
                $('.filter-results').html(data);
                $('.filter-results').fadeIn();
				
				var found_wrap = $('div.found').detach();
								
				$('.filter-content').empty().append(found_wrap);
				
				 $('html, body').animate({
                    scrollTop: $(".filter-content").offset().top
                }, 1500, 'linear');
				
			
			},
			error: function( MLHttpRequest, textStatus, errorThrown , response) {
				console.log( MLHttpRequest );
				console.log( textStatus );
				console.log( errorThrown );
				
				console.log(data);
				$('.filter-results').html( 'No posts found' );
				$('.filter-results').fadeIn();
			},
			complete: function(){
			$(".load").css("display", "none");
			}
			
			
        });
		
		
		// modfy filter menu
		
		$('.cat-menu').fadeOut();
		data = {
			action: 'high_filter_cats', 
			high_nonce: high_filter.high_nonce,
			cat: $('.sub-cats:checked').serializeArray(),
			sub: sub,
			pcat: pcat,
			selected: selected,
			selectedID: selectedID,
			activatedID: activatedID,
			rmsub: rmsub,
		},
 
		$.ajax({
			type: 'post',
			dataType: "json",
			url: high_filter.ajax_url,
			data: data,
			success: function(html) {
				
                $('.cat-menu').html(html);
                $('.cat-menu').fadeIn();
				
				if(typeof rmsub !== 'undefined'){
					cat = $.grep(cat, function(value) {
						return value != rmsub;
					});
				 }
				 
				var current = cat[0];
					
					//console.log(cat);
					//console.log(current);
					
				//display cat menu 
				$(cat).each(function(index, ele){ 
					var	downItem = $('ul.download-cat').find('ul li.' + current),
						selectedUl = $(downItem).parents('.download-cat'),
						otherItem = $(downItem).siblings(),
						activatedUl = $('ul#cat-' + activatedID);
					
					 
					
					if($(downItem).length){
						//$(otherItem).attr("disabled", true).addClass('nada');
						$(selectedUl).addClass('active');
						$(selectedUl).addClass('selected');
					}
					$('ul').each(function(){
						
						var opened = $(this).find('li.' + ele + ':not(.nada) input').attr('checked', 'checked');

					$(opened).parents('ul').addClass('active');
					console.log(opened)
					
					}) 
					
					$(activatedUl).addClass('selected');
					
					
				});
				
				// toggle filter categories
				$('.cat-icon').click(function(){
					var icon = $(this).find('i.icon-tog'),
						subcat = $(this).parents('.download-cat').find('li.has-cats');
					
					$('.cat-icon i.icon-tog').not(icon).addClass('open-icon');
					$('.download-cat').find('li.has-cats').not(subcat).removeClass('open-cats');

					$(icon).toggleClass('open-icon');
					$(subcat).toggleClass('open-cats');
				})
				 
        				
		
					if($(window).width() < 880){
						$('html, body').animate({
                    scrollTop: $(".filter-results").offset().top
                }, 500, 'linear');
					}
		
		 
			},
			error: function( MLHttpRequest, textStatus, errorThrown , response) {
				console.log( MLHttpRequest );
				console.log( textStatus );
				console.log( errorThrown );
				
				console.log(data);
				$('.cat-menu').html( 'Sorry there is an issue' );
				$('.cat-menu').fadeIn();
			},
			
        });
		
	});
	 
});

// vanilla fetch get all posts
async function getWPPosts() {
	const response = await fetch( 'https://ernieshigh.dev/wp-json/wp/v2/posts' );
	const posts = await response.json();

	console.log( posts ); 

}

getWPPosts();