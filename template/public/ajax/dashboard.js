import baseUrl from "./base.js";
import basePath from "./domain.js";

dataKepegawaian();
function dataKepegawaian(){
    $.ajax({
        type:'POST',
        url:baseUrl+'dashboard/dataKepegawaian',
        dataType :'json',
        beforeSend:function(){
            loading();
        },success:function(resp){
            if(resp.status == true){
                $('#dataKepegawaian').html(resp.output);
                chartStatistik(resp.arr);
                
            }
        },complete:function(){
            loadingOut();
           
           
        }
    })
}
function chartStatistik(chartDatac){
    // var chartDatac = [{
    //     "day": "Mon",
    //     "value": 60
    // },{
    //     "day": "Tue",
    //     "value": 50
    // },{
    //     "day": "Wed",
    //     "value": 59
    // },{
    //     "day": "Thu",
    //     "value": 55
    // },{
    //     "day": "Fri",
    //     "value": 65
    // },{
    //     "day": "Sat",
    //     "value": 55
    // },{
    //     "day": "Sun",
    //     "value": 70
    // }];
    var chartc = AmCharts.makeChart("chart-statistik", {
        "type": "serial",
        "addClassNames": true,
        "defs": {
            "filter": [{
                    "x": "-50%",
                    "y": "-50%",
                    "width": "200%",
                    "height": "200%",
                    "id": "blur",
                    "feGaussianBlur": {
                        "in": "SourceGraphic",
                        "stdDeviation": "30"
                    }
                },
                {
                    "id": "shadow",
                    "x": "-10%",
                    "y": "-10%",
                    "width": "120%",
                    "height": "120%",
                    "feOffset": {
                        "result": "offOut",
                        "in": "SourceAlpha",
                        "dx": "0",
                        "dy": "20"
                    },
                    "feGaussianBlur": {
                        "result": "blurOut",
                        "in": "offOut",
                        "stdDeviation": "10"
                    },
                    "feColorMatrix": {
                        "result": "blurOut",
                        "type": "matrix",
                        "values": "0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 .2 0"
                    },
                    "feBlend": {
                        "in": "SourceGraphic",
                        "in2": "blurOut",
                        "mode": "normal"
                    }
                }
            ]
        },
        "fontSize": 15,
        "dataProvider": chartDatac,
        "autoMarginOffset": 0,
        "marginRight": 0,
        "categoryField": "day",
        "categoryAxis": {
            "color": '#393c40',
            "gridAlpha": 0,
            "axisAlpha": 0,
            "lineAlpha": 0,
            "offset": -20,
            "inside": true,
        },
        "valueAxes": [{
            "fontSize": 0,
            "inside": true,
            "gridAlpha": 0,
            "axisAlpha": 0,
            "lineAlpha": 0,
            "minimum": 0,
            "maximum": 100,
        }],
        "chartCursor": {
            "valueLineEnabled":false,
            "valueLineBalloonEnabled":false,
            "cursorAlpha":0,
            "zoomable":false,
            "valueZoomable":false,
            "cursorColor":"#fff",
            "categoryBalloonColor": "#23d3d7",
            "valueLineAlpha": 0
        },
        "graphs": [{
            "id": "g1",
            "type": "line",
            "valueField":"value",                
          "lineColor":"#23d3d7",
          "lineAlpha":1,
          "lineThickness":3,
            "fillAlphas": 0,
            "showBalloon":true,
            "balloon": {
                "drop":true,
                "adjustBorderColor":false,
                "color":"#ffffff",
                "fillAlphas":0.2,
                "bullet":"round",
                "bulletBorderAlpha":1,
                "bulletSize":5,
                "hideBulletsCount":50,
                "lineThickness":2,
                "useLineColorForBulletBorder":true,
                "valueField":"value",
                "balloonText":"<span style='font-size:18px;'>[[value]]</span>"
            },
        }],
    });
}
function error(msg){
    
    swal({
        title: 'Something Wrong!',
       
        text:msg,
        
          
        customClass: 'swal-wide',
         icon:'error',
        
        })

}
function success(msg){
swal({
    title: 'Successfully!',
   
    text:msg,
    
      
    customClass: 'swal-wide',
    icon:'success',
    
    })  
}
function loading(){
    $('.loading').css('display','');

}
function loadingOut(){
    setTimeout(function() {
        $('.loading').fadeOut('slow', function() {
            $(this).css('display','none');
        });
    },400);

}