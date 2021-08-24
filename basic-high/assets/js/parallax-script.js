// JavaScript Document
jQuery(document).ready(function($){
	$(window).scroll(function(){
		var divHeight = $(window).height()*1;	
		
		var win = $(window).scrollTop();
		var divIndex = $(window).scrollTop() / divHeight;
		
		 
				// console.log(divHeight + 'height');
				// console.log(win + 'to top');
				console.log(divIndex + 'index');
		

		
		$("#intro a").append(function() {
            
			if (divIndex < 1) {
				$("#intro a").attr("href", "#mountain");}	
			if (divIndex >= 1) {
				$("#intro a").attr("href", "#tree");}            
			if (divIndex >= 2.19) {
				$("#intro a").attr("href", "#warrior");}
			if (divIndex >= 3.39) {
				$("#intro a").attr("href", "#legs");}			
			if (divIndex >= 4.59) {
				$("#intro a").attr("href", "#child");}	
			if (divIndex >= 5.79) {
				$("#intro a").attr("href", "#corpse");}	
			if (divIndex >= 6.79) {
				$("#intro a").attr("href", "#outro");}	
			if (divIndex >= 8.19) {
				$("#intro a").css({display:'none'},1);}
			else {
				$("#intro a").css({display:'block'},1);}

			
				
			
		});
		
		
			

		
		$("#n-intro").append(function() {
            
			if (divIndex < 1) {
				$("#n-intro").css({opacity:'1'},1);}
			else {				
			$("#n-intro").css({opacity:'0.4'},1);}			
			
		});
		
		
		$("#n-mountain").append(function() {
            
			if (divIndex >= 1 && divIndex < 2.19) {
				$("#n-mountain img").css({opacity:'1'},1);}
			else {				
			$("#n-mountain img").css({opacity:'0.4'},1);}			
			
		});
		
		$("#n-tree").append(function() {
            
			if (divIndex >= 2.19 && divIndex < 3.39) {
				$("#n-tree img").css({opacity:'1'},1);}
			else {				
			$("#n-tree img").css({opacity:'0.4'},1);}	
		});
		
		$("#n-warrior").append(function() {
           
			if (divIndex >= 3.39 && divIndex < 4.59) {
				$("#n-warrior img").css({opacity:'1'},1);}
			else {				
			$("#n-warrior img").css({opacity:'0.4'},1);}	
		});
		
		$("#n-legs").append(function() {
            
		if (divIndex >= 4.59 && divIndex < 5.79) {
		$("#n-legs img").css({opacity:'1'},1);}
			else {				
		$("#n-legs img").css({opacity:'0.4'},1);}	
		});
		
		$("#n-child").append(function() {
            
			if (divIndex >= 5.79 && divIndex < 6.79) {
		$("#n-child img").css({opacity:'1'},1);}
			else {				
		$("#n-child  img").css({opacity:'0.4'},1);}	
		});
		
		$("#n-corpse").append(function() {
            
			if (divIndex >= 6.79 && divIndex < 8.19) {
		$("#n-corpse img").css({opacity:'1'},1);}
			else {				
		$("#n-corpse img").css({opacity:'0.4'},1);}	
		});
		
		$("#n-foot").append(function() {
           
		if (divIndex >= 8.19 && divIndex < 9.39) {
		$("#n-foot img").css({opacity:'1'},1);}
			else {				
		$("#n-foot img").css({opacity:'0.4'},1);}	
		});
		
		
		});
		
})

