jQuery(document).ready(function($){
    let widthSlide = $("#slider .slide").first().width();
    $("#slider .banner-btn").click(function(){
        let obj = $(this);
        let left = $("#slider .slides").first().position().left || 0;
        let coef = obj.hassClass('btn-left') ? -1 : 1;
        let condition = obj.hassClass('btn-left') ? left <= Math.floor(-2 * widthSlide) + 1 : left >= 0;
        if (condition) return false;
        $("#slider .slides").animate({"left": left + coef * widthSlide}, 1000);
        return false;
    });
});