import {
    Chart,
    ArcElement,
    LineElement,
    BarElement,
    PointElement,
    BarController,
    BubbleController,
    DoughnutController,
    LineController,
    PieController,
    PolarAreaController,
    RadarController,
    ScatterController,
    CategoryScale,
    LinearScale,
    LogarithmicScale,
    RadialLinearScale,
    TimeScale,
    TimeSeriesScale,
    Decimation,
    Filler,
    Legend,
    Title,
    Tooltip,

} from 'chart.js';

Chart.register(
    ArcElement,
    LineElement,
    BarElement,
    PointElement,
    BarController,
    BubbleController,
    DoughnutController,
    LineController,
    PieController,
    PolarAreaController,
    RadarController,
    ScatterController,
    CategoryScale,
    LinearScale,
    LogarithmicScale,
    RadialLinearScale,
    TimeScale,
    TimeSeriesScale,
    Decimation,
    Filler,
    Legend,
    Title,
    Tooltip
);
import 'chartjs-adapter-moment'


window.dashboard = {


    monthlyPaymentDonut: function (data) {

        var ctx = document.getElementById('monthlyPaymentDonut');
        if (ctx) {
            console.log(parseInt($(ctx).attr('data-total')), parseInt($(ctx).attr('data-current')))
            var chart = new Chartist.Pie(ctx, {
                series: [$(ctx).attr('data-current'), parseInt($(ctx).attr('data-total')) - parseInt($(ctx).attr('data-current'))],
                labels: ['', '']
            }, {
                donut: true,
                donutWidth: 20,
                startAngle: 210,
                total: parseInt($(ctx).attr('data-total')) + (parseInt($(ctx).attr('data-total')) / 360 * 70),
                showLabel: false,
                plugins: [
                    Chartist.plugins.fillDonut({
                        items: [{ //Item 1
                            content: '<span class="text-center">Aylık</span>',
                            position: 'bottom',
                            offsetY: 30,
                            offsetX: -2
                        }, { //Item 2
                            content: '<div class="text-center"><span class="h3">' + $(ctx).attr('data-current') + '</span><span class="d-block">' + user.currency + '</span></div>',
                            offsetY: 50,
                            position: 'top',
                        }]
                    }),
                    Chartist.plugins.legend({
                        legendNames: ['Ödenen', 'Kalan'],
                        position: 'bottom'
                    })
                ],

            });
            //Animation for the first series
            chart.on('draw', function (data) {
                if (data.type === 'slice' && data.index == 0) {
                    var pathLength = data.element._node.getTotalLength();

                    data.element.attr({
                        'stroke-dasharray': pathLength + 'px ' + pathLength + 'px'
                    });

                    var animationDefinition = {
                        'stroke-dashoffset': {
                            id: 'anim' + data.index,
                            dur: 1200,
                            from: -pathLength + 'px',
                            to: '0px',
                            easing: Chartist.Svg.Easing.easeOutQuint,
                            fill: 'freeze'
                        }
                    };
                    data.element.attr({
                        'stroke-dashoffset': -pathLength + 'px'
                    });
                    data.element.animate(animationDefinition, true);
                }
            });
        }
    },

//todo chartiste ait tüm css ve jsler silinecek genelde ca- ile başlıyor
    yearlyPaymentLineChart: function (data) {

        console.log(data)
        var yearlyPayment = document.getElementById('yearlyPaymentCanvas');
        var seriesValsWaiting = [];
        var seriesValsPaid = [];
        var seriesValsOutgoing = [];
        var labelsVals = [];
        if (typeof data.data !== "undefined") {
            for (var i = 0; i < data.data.length; i++) {
                seriesValsWaiting.push(data.data[i].waiting);
                seriesValsPaid.push(data.data[i].paid);
                seriesValsOutgoing.push(data.data[i].outgoing);
                labelsVals.push(moment(data.data[i].x, 'YYYYMM').format('MMM'));
            }
        }
        if (window.yearlyPaymentChart) {
            window.yearlyPaymentChart.destroy()
        }
        window.yearlyPaymentChart = new Chart(yearlyPayment, {
            type: 'line',
            data: {
                labels: labelsVals,
                datasets: [
                    {
                        label: lang.get('dashboard.credit'),
                        data: seriesValsWaiting,
                        backgroundColor: 'rgba(18, 122, 223, 0.1)',
                        borderColor: 'rgba(18, 122, 223, 0.8)',
                        cubicInterpolationMode: 'monotone',
                        borderWidth: 2,
                        tension: 0.4,
                        borderDash: [5, 4],
                        fill: 'start',
                        radius: 0,
                        // categoryPercentage: 1
                    },
                    {
                        label: lang.get('dashboard.amount'),
                        data: seriesValsPaid,
                        backgroundColor: 'rgba(18, 122, 223, 0.1)',
                        borderColor: 'rgba(18, 122, 223, 0.8)',
                        borderWidth: 3,
                        radius: 2,
                        cubicInterpolationMode: 'monotone',
                        tension: 0.4,
                        fill: 'start',
                        // categoryPercentage: 1
                    },

                    {
                        label: lang.get('dashboard.outgoing'),
                        cubicInterpolationMode: 'monotone',
                        data: seriesValsOutgoing,
                        backgroundColor: 'rgba(255, 0, 0, 0.1)',
                        borderColor: 'rgba(255, 0, 0, 0.8)',
                        fill: 'start',
                        tension: 0.4,
                        borderWidth: 3,
                        radius: 2,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                plugins: {
                    legend: {
                        display: true,
                        labels: {
                            usePointStyle:true,
                            pointStyle:'line',
                        }
                    }
                }
            }

        });


        // yearlyPayment.height = 199;
        // var myChart = new Chart(yearlyPayment, yearlyPaymentConfig);
        // yearlyPaymentChart.on('draw', function (data) {
        //     if (data.type === 'slice' && data.index == 0) {
        //         var pathLength = data.element._node.getTotalLength();
        //
        //         data.element.attr({
        //             'stroke-dasharray': pathLength + 'px ' + pathLength + 'px'
        //         });
        //
        //         var animationDefinition = {
        //             'stroke-dashoffset': {
        //                 id: 'anim' + data.index,
        //                 dur: 1200,
        //                 from: -pathLength + 'px',
        //                 to: '0px',
        //                 easing: Chartist.Svg.Easing.easeOutQuint,
        //                 fill: 'freeze'
        //             }
        //         };
        //         data.element.attr({
        //             'stroke-dashoffset': -pathLength + 'px'
        //         });
        //         data.element.animate(animationDefinition, true);
        //     }
        // });
    },

//     yearlyPaymentLineChart: function (data) {
//
//
//         var yearlyPayment = document.getElementById('yearlyPayment');
//         var seriesValsWaiting = [];
//         var seriesValsPaid = [];
//         var seriesValsOutgoing = [];
//         var labelsVals = [];
//         if(typeof data.data !== "undefined") {
//             for (var i = 0; i < data.data.length; i++) {
//                 seriesValsWaiting.push(data.data[i].waiting);
//                 seriesValsPaid.push(data.data[i].paid);
//                 seriesValsOutgoing.push(data.data[i].outgoing);
//                 labelsVals.push(moment(data.data[i].x, 'YYYYMM').format('MMM'));
//             }
//         }
//
//         window.yearlyPaymentChart = new Chartist.Line(yearlyPayment, {
//             labels: labelsVals,
//             series: [
//                 seriesValsOutgoing,
//                 seriesValsWaiting,
//                 seriesValsPaid,
//             ]
//         }, {
//             fullWidth: true,
//             showPoint: true,
//             showArea: true,
//             // lineSmooth: Chartist.Interpolation.step(),
//             plugins: [
//                 Chartist.plugins.legend({
//                     legendNames: data.legends,
//                     position: 'bottom'
//                 })
//             ]
//         });
//
//
//         // yearlyPayment.height = 199;
//         // var myChart = new Chart(yearlyPayment, yearlyPaymentConfig);
//         // yearlyPaymentChart.on('draw', function (data) {
//         //     if (data.type === 'slice' && data.index == 0) {
//         //         var pathLength = data.element._node.getTotalLength();
//         //
//         //         data.element.attr({
//         //             'stroke-dasharray': pathLength + 'px ' + pathLength + 'px'
//         //         });
//         //
//         //         var animationDefinition = {
//         //             'stroke-dashoffset': {
//         //                 id: 'anim' + data.index,
//         //                 dur: 1200,
//         //                 from: -pathLength + 'px',
//         //                 to: '0px',
//         //                 easing: Chartist.Svg.Easing.easeOutQuint,
//         //                 fill: 'freeze'
//         //             }
//         //         };
//         //         data.element.attr({
//         //             'stroke-dashoffset': -pathLength + 'px'
//         //         });
//         //         data.element.animate(animationDefinition, true);
//         //     }
//         // });
//     },
    paymentLineChart: function (data) {


        var yearlyPayment = document.getElementById('paymentChart');
        var unitSeries = [];
        var labelsVals = [];
        for (var i = 0; i < data.length; i++) {
            for (const monthData in data[i]) {
                if (monthData == 'x') {
                    continue;
                }
                if (typeof unitSeries[monthData] == "undefined") {
                    unitSeries[monthData] = [];
                }
                unitSeries[monthData].push(data[i][monthData])
            }
            labelsVals.push(moment(data[i].x, 'YYYYMM').format('YYYY-MM'));
        }
        const unitLabel = Object.keys(unitSeries);
        unitSeries = Object.values(unitSeries);

        window.yearlyPaymentChart = new Chartist.Line(yearlyPayment, {
            labels: labelsVals,
            series: unitSeries
        }, {
            fullWidth: true,
            showPoint: true,
            showArea: true,
            // lineSmooth: Chartist.Interpolation.step(),
            plugins: [
                Chartist.plugins.legend({
                    legendNames: unitLabel,
                    position: 'bottom'
                })
            ]
        });


        // yearlyPayment.height = 199;
        // var myChart = new Chart(yearlyPayment, yearlyPaymentConfig);
        // yearlyPaymentChart.on('draw', function (data) {
        //     if (data.type === 'slice' && data.index == 0) {
        //         var pathLength = data.element._node.getTotalLength();
        //
        //         data.element.attr({
        //             'stroke-dasharray': pathLength + 'px ' + pathLength + 'px'
        //         });
        //
        //         var animationDefinition = {
        //             'stroke-dashoffset': {
        //                 id: 'anim' + data.index,
        //                 dur: 1200,
        //                 from: -pathLength + 'px',
        //                 to: '0px',
        //                 easing: Chartist.Svg.Easing.easeOutQuint,
        //                 fill: 'freeze'
        //             }
        //         };
        //         data.element.attr({
        //             'stroke-dashoffset': -pathLength + 'px'
        //         });
        //         data.element.animate(animationDefinition, true);
        //     }
        // });
    },
    monthlyPayment: function (data) {


        var yearlyPayment = document.getElementById('monthlyPayment');
        var seriesValsWaiting = [];
        var seriesValsPaid = [];
        var seriesValsCanceled = [];
        var labelsVals = [];
        for (var i = 0; i < data.length; i++) {
            seriesValsWaiting.push(data[i].waiting);
            seriesValsPaid.push(data[i].paid);
            seriesValsCanceled.push(data[i].canceled);
            labelsVals.push(moment(data[i].x, 'YYYYMMDD').format('DD MMM'));
        }


        new Chartist.Bar(yearlyPayment, {
            labels: labelsVals,
            series: [
                seriesValsCanceled,
                seriesValsWaiting,
                seriesValsPaid,
            ]
        }, {
            fullWidth: true,
            showPoint: false,
            plugins: [
                Chartist.plugins.legend({
                    legendNames: ['İptal', 'Alacak', 'Ödenen'],
                    position: 'bottom'
                })
            ]
        });


        // yearlyPayment.height = 199;
        // var myChart = new Chart(yearlyPayment, yearlyPaymentConfig);
    },

    initialize: function (unitId = null) {

        var dashboardPaymentsUrl
        var dashboardContractPaymentUrl
        var dashboardOverDueUrl
        var dashboardPaymentsDailyUrl

        if ($('#yearlyPayment').length > 0) {
            dashboardPaymentsUrl = $('#yearlyPayment').attr('data-source')
        }

        if (unitId == null) {
            // dashboardPaymentsUrl = '/home/payments';
            // dashboardContractPaymentUrl = '/analysis/contract';
            dashboardOverDueUrl = '/home/overdue';
            dashboardPaymentsDailyUrl = '/home/payments?period=daily';
        } else {
            // dashboardPaymentsUrl = unitId + '/dashboard/payments';
            // dashboardContractPaymentUrl = '/analysis/contract';
            dashboardOverDueUrl = unitId + '/dashboard/overdue';
            dashboardPaymentsDailyUrl = unitId + '/dashboard/payments?period=daily';

        }
        dashboard.yearlyPaymentLineChart([])
        $.getJSON(dashboardPaymentsUrl, function (data) {
            window.dashboard.yearlyPaymentLineChart(data)
        })

        // dashboard.paymentLineChart([])
        // $.getJSON(dashboardContractPaymentUrl, function (data) {
        //     window.dashboard.paymentLineChart(data)
        // })


        // $.getJSON(dashboardOverDueUrl, function (data) {
        //     window.dashboard.nearOverDue(data)
        // })
        // $.getJSON(dashboardPaymentsDailyUrl, function (data) {
        //     window.dashboard.monthlyPayment(data)
        // })

        $(document).ready(function () {
            window.dashboard.monthlyPaymentDonut();
            $('#overdue_debts').on('click mouseover', '.ct-slice-donut', function (a, b, c) {
                console.log(this, window.getComputedStyle(this).getPropertyValue('stroke'))
                console.log(Chartist.deserialize(this.getAttribute('ct:meta')));
                $('#overdue_active_label').text(Chartist.deserialize(this.getAttribute('ct:meta')));
                $('#overdue_active_value').text(Chartist.deserialize(this.getAttribute('ct:value')));
                $('#overdue_debts .ct-series-0').text(Chartist.deserialize(this.getAttribute('ct:meta')));

                $('#overdue_debts .ct-series-0')[0].style.setProperty("--data-color", window.getComputedStyle(this).getPropertyValue('stroke'));

            });
        })


    }
}


