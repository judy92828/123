/**
 * Created by Administrator on 2016/7/6.
 */
    //导航
$(function(){
    $(".nav>ul>li").click(function(){
        $(".nav>ul>li>a").removeClass("active");
        $(this).children("a").addClass("active");
    });
});

/*tab切换*/
var Nav=document.getElementsByClassName("tab-title")[0];
var Li=Nav.getElementsByTagName("li");
var Tag=document.getElementsByClassName("tab-detail");
for(i=0;i<Li.length;i++){
    Li[i].index=i;
    Li[i].onclick=function(){
        for(j=0;j<Li.length;j++){
            Li[j].className="";
        }
        this.className="tab-active";
        for(k=0;k<Tag.length;k++){
            Tag[k].style.display="none";
        }
        Tag[this.index].style.display="block";
    };
}
