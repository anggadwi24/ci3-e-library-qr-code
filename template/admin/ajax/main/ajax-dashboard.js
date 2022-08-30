import baseUrl from "../base.js";
import basePath from "../domain.js";

import success from "../success.js";
import successBack from "../success-back.js";
import successRedirect from "../success-redirect.js";
import successOK from "../successOK.js";


import error from "../error.js";
$(document).ready(function() {
    
    $.ajax({
        type:'POST',
        url:baseUrl+'main/chart',
        dataType :'json',
        success:function(resp){
            var data1 = {
                labels: resp.period,
                datasets: [{
                    label: "Pengunjung",
                    backgroundColor: [
                        'rgba(95, 190, 170, 0.99)',
                        'rgba(95, 190, 170, 0.99)',
                        'rgba(95, 190, 170, 0.99)',
                        'rgba(95, 190, 170, 0.99)',
                        'rgba(95, 190, 170, 0.99)',
                        'rgba(95, 190, 170, 0.99)',
                        'rgba(95, 190, 170, 0.99)'
                    ],
                    hoverBackgroundColor: [
                        'rgba(26, 188, 156, 0.88)',
                        'rgba(26, 188, 156, 0.88)',
                        'rgba(26, 188, 156, 0.88)',
                        'rgba(26, 188, 156, 0.88)',
                        'rgba(26, 188, 156, 0.88)',
                        'rgba(26, 188, 156, 0.88)',
                        'rgba(26, 188, 156, 0.88)'
                    ],
                    data: resp.total,
                }]
            };
        
            var bar = document.getElementById("barChart").getContext('2d');
            var myBarChart = new Chart(bar, {
                type: 'bar',
                data: data1,
                options: {
                    barValueSpacing: 20
                }
            });
        }
    })

});


