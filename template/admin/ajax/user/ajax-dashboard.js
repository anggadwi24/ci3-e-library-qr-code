import baseUrl from "../base.js";
import basePath from "../domain.js";

import success from "../success.js";
import successBack from "../success-back.js";
import successRedirect from "../success-redirect.js";

import error from "../error.js";

    $.ajax({
        type:'POST',
        url:baseUrl+'main/chart',
        dataType :'json',
        success:function(resp){
            var earningCtx = document.getElementById('earning-chart').getContext('2d');		
            var earningChartGradient = earningCtx.createLinearGradient(40, 0, 50, 170);
            earningChartGradient.addColorStop(0, app.colors.success);
            earningChartGradient.addColorStop(1, app.colors.transparent);
            var earning_chart = new Chart(earningCtx, {
                type: 'line',
                data: {
                    labels: resp.hari,
                    datasets: [{
                        label: 'Transaksi',
                        backgroundColor: earningChartGradient,
                        borderColor: app.colors.success,
                        data:resp.transaksi
                    }],
                },
                options: {
                    legend: {
                        display: false
                    },
                    maintainAspectRatio: false,
                    elements: {
                        line: {
                            tension: 0.4,
                            borderWidth: 2
                        }
                    },
                    scales: {
                        xAxes: [{display: false}],
                        yAxes: [{display: false}]
                    }
                }
            });
        }
    })

