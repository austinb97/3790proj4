// function expand(x){
// 	// x.classList.toggle("expand");
// 	// $('.card').not(x).toggle();	
// 	// $('.toggle').delay(500).toggle("hidden");
// 	x.addClass("expand");
// 	$('.card').not(x).hide();
// 	$('.toggle').delay(500).removeClass("hidden");
// };

$('.card').on('click', function(){
	console.log("card click");
	$(this).addClass("expand");
	$('.card').not(this).hide();
	$('.toggle').delay(1000).addClass("show");
});

$('.closeX').on('click', function(e){
	e.stopPropagation();
	console.log("hello");
	$(".card").removeClass("expand");	
	$('.toggle').removeClass("show");
	$('.card').delay(1000).show();
});