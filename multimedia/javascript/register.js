// Here we can write our jquery code i,e jquery is written in javascript file
//Thsis file is used to get the effect on register page i,e sliding of the loginand sliding menu;
//Jquery is a javascript library
$(document).ready(function(){  //this targets the document and jquery can only be used when the page is ready. This is to prevent any jQuery code from running before the document is finished loading (is ready).

	//On click signup .Hide login and show register form 
	$("#signup").click(function(){    //this # is used for targettting the signup id on click
		$("#first").slideUp("slow",function(){
			$("#second").slideDown("slow");	
		});
	});  

	//on click signup, hide registration and show login form
	$("#signin").click(function(){    //this # is used for targettting the signin id on click
		$("#second").slideUp("slow",function(){
			$("#first").slideDown("slow");	
		});
	}); 

});