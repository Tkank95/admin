$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // INITIALIZATION OF STICKY HEADER
    // =======================================================
    $('.js-sticky-header').HSStickyHeader();

    // INITIALIZATION OF DATERANGEPICKER
    // =======================================================
    $('.js-daterangepicker').daterangepicker();

    $('.js-daterangepicker-times').daterangepicker({
        timePicker: true,
        startDate: moment().startOf('hour'),
        endDate: moment().startOf('hour').add(32, 'hour'),
        locale: {
            format: 'M/DD hh:mm A'
        }
    });

    var start = moment().startOf('month');
    var end = moment().endOf('month');

    function cb(start, end, label) {
        $('#reportDate .js-daterangepicker-predefined-preview').html(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
        $('#typeDate').val(label);
    }

    $('#reportDate').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    cb(start, end);


    $.ajax({
        url: 'transaction/report',
        type: "get",
        dataType: 'html',
        success: function (data) {
            console.log(data);
            $('#content_report').html(data);
            $('.js-chart').each(function () {
                $.HSCore.components.HSChartJS.init($(this), {
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    callback: function (value, index, values) {
                                        if (value >= 100000) {
                                            return (value / 1000).toLocaleString() + "K";
                                        } else if (value > 100000000) {
                                            return (value / 1000000).toLocaleString() + "M";
                                        } else if (value > 1000000000) {
                                            return (value / 10000000).toLocaleString() + "B";
                                        } else {
                                            return value.toLocaleString();
                                        }
                                    }
                                }
                            }]
                        },
                        tooltips: {
                            postfix: " VND",
                            hasIndicator: true,
                            mode: "index",
                            intersect: false,
                            lineMode: true,
                            lineWithLineColor: "rgba(19, 33, 68, 0.075)",
                            callbacks: {
                                footer: function (tooltipItems, data) {
                                    var sum = 0;
                                    tooltipItems.forEach(function (tooltipItem) {
                                        sum += data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                                    });
                                    console.log(sum)
                                    return "Sum:" + sum;
                                },
                                label: function (tooltipItem, data) {
                                    return data.datasets[tooltipItem.datasetIndex].label + ': ' + tooltipItem.yLabel.toLocaleString("vi-VI");
                                }

                            }
                        }
                    }
                });
            });
        },
        error: function (data) {
            let errors = data.responseJSON;
            let errorsHtml = "";
            $.each(errors, function (key, value) {
                errorsHtml += "<li>" + value[0] + "</li>";
            });
            toastr.error(errorsHtml, "Lỗi tải dữ liệu!");
            Swal.fire("Error!", errorsHtml, "error");
        }
    });

    $('#reportDate').on('apply.daterangepicker', function (ev, picker) {
        $.ajax({
            url: 'transaction/report',
            type: "get",
            data: {
                start: picker.startDate.format('YYYY-MM-DD'),
                end: picker.endDate.format('YYYY-MM-DD'),
                type: $('#typeDate').val()
            },
            dataType: 'html',
            success: function (data) {
                $('#content_report').html(data);
                $('.js-chart').each(function () {
                    $.HSCore.components.HSChartJS.init($(this), {
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        callback: function (value, index, values) {
                                            if (value >= 100000) {
                                                return (value / 1000).toLocaleString() + "K";
                                            } else if (value > 100000000) {
                                                return (value / 1000000).toLocaleString() + "M";
                                            } else if (value > 1000000000) {
                                                return (value / 10000000).toLocaleString() + "B";
                                            } else {
                                                return value.toLocaleString();
                                            }
                                        }
                                    }
                                }]
                            },
                            tooltips: {
                                postfix: " VND",
                                hasIndicator: true,
                                mode: "index",
                                intersect: false,
                                lineMode: true,
                                lineWithLineColor: "rgba(19, 33, 68, 0.075)",
                                callbacks: {
                                    label: function (tooltipItem, data) {
                                        return data.datasets[tooltipItem.datasetIndex].label + ': ' + tooltipItem.yLabel.toLocaleString("vi-VI");
                                    },
                                    footer: function (tooltipItems, data) {
                                        var sum = 0;
                                        tooltipItems.forEach(function (tooltipItem) {
                                            sum += data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                                        });
                                        console.log(sum);
                                        return "Sum:" + sum;
                                    }
                                }
                            }
                        }
                    });
                });
            },
            error: function (data) {
                let errors = data.responseJSON;
                let errorsHtml = "";
                $.each(errors, function (key, value) {
                    errorsHtml += "<li>" + value[0] + "</li>";
                });
                toastr.error(errorsHtml, "Tạo report lỗi!");
                Swal.fire("Error!", errorsHtml, "error");
            }
        });
    });


    // function fetch_data(data) {
    //     $.HSCore.components.HSChartJS.init($('#profitChart'), {
    //         "type": "line",
    //         "data": {
    //             "labels": ["Feb","Jan","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],
    //             "datasets": [{
    //                 "label": "Income",
    //                 "data": [1,2,3,4,5,3,7,5,8,9,6,8],
    //                 "backgroundColor": ["rgba(55, 125, 255, 0)", "rgba(255, 255, 255, 0)"],
    //                 "borderColor": "#377dff",
    //                 "borderWidth": 2,
    //                 "pointRadius": 0,
    //                 "pointBorderColor": "#fff",
    //                 "pointBackgroundColor": "#377dff",
    //                 "pointHoverRadius": 0,
    //                 "hoverBorderColor": "#fff",
    //                 "hoverBackgroundColor": "#377dff"
    //             },
    //                 {
    //                     "label": "Expenses",
    //                     "data": [0,1,2,2,3,1,2,1,4,2,5,1],
    //                     "backgroundColor": ["rgba(0, 201, 219, 0)", "rgba(255, 255, 255, 0)"],
    //                     "borderColor": "#FF0000",
    //                     "borderWidth": 2,
    //                     "pointRadius": 0,
    //                     "pointBorderColor": "#fff",
    //                     "pointBackgroundColor": "#00c9db",
    //                     "pointHoverRadius": 0,
    //                     "hoverBorderColor": "#fff",
    //                     "hoverBackgroundColor": "#00c9db"
    //                 }]
    //         },
    //         "options": {
    //             "gradientPosition": {"y1": 200},
    //             "scales": {
    //                 "yAxes": [{
    //                     "gridLines": {
    //                         "color": "#e7eaf3",
    //                         "drawBorder": false,
    //                         "zeroLineColor": "#e7eaf3"
    //                     },
    //                     "ticks": {
    //                         "min": 0,
    //                         "max": 10,
    //                         "stepSize": 2,
    //                         "fontColor": "#97a4af",
    //                         "fontFamily": "Open Sans, sans-serif",
    //                         "padding": 10,
    //                         "postfix": "k"
    //                     }
    //                 }],
    //                 "xAxes": [{
    //                     "gridLines": {
    //                         "display": false,
    //                         "drawBorder": false
    //                     },
    //                     "ticks": {
    //                         "fontSize": 12,
    //                         "fontColor": "#97a4af",
    //                         "fontFamily": "Open Sans, sans-serif",
    //                         "padding": 5
    //                     }
    //                 }]
    //             },
    //             "tooltips": {
    //                 "prefix": "$",
    //                 "postfix": "k",
    //                 "hasIndicator": true,
    //                 "mode": "index",
    //                 "intersect": false,
    //                 "lineMode": true,
    //                 "lineWithLineColor": "rgba(19, 33, 68, 0.075)"
    //             },
    //             "hover": {
    //                 "mode": "nearest",
    //                 "intersect": true
    //             },
    //             "legend": {
    //                 "align": "end",
    //                 "display": true
    //             }
    //         }
    //     });
    //     $.HSCore.components.HSChartJS.init($('#expenseChart'), {
    //         "type": "bar",
    //         "data": {
    //             "labels": ["Feb","Jan","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],
    //             "datasets": [{
    //                 "label": "Income",
    //                 "data": [1,2,3,4,5,3,7,5,8,9,6,8],
    //                 "backgroundColor": ["rgba(55, 125, 255, 0)", "rgba(255, 255, 255, 0)"],
    //                 "borderColor": "#377dff",
    //                 "borderWidth": 2,
    //                 "pointRadius": 0,
    //                 "pointBorderColor": "#fff",
    //                 "pointBackgroundColor": "#377dff",
    //                 "pointHoverRadius": 0,
    //                 "hoverBorderColor": "#fff",
    //                 "hoverBackgroundColor": "#377dff"
    //             },
    //                 {
    //                     "label": "Expenses",
    //                     "data": [0,1,2,2,3,1,2,1,4,2,5,1],
    //                     "backgroundColor": ["rgba(0, 201, 219, 0)", "rgba(255, 255, 255, 0)"],
    //                     "borderColor": "#FF0000",
    //                     "borderWidth": 2,
    //                     "pointRadius": 0,
    //                     "pointBorderColor": "#fff",
    //                     "pointBackgroundColor": "#00c9db",
    //                     "pointHoverRadius": 0,
    //                     "hoverBorderColor": "#fff",
    //                     "hoverBackgroundColor": "#00c9db"
    //                 }]
    //         },
    //         "options": {
    //             "gradientPosition": {"y1": 200},
    //             "scales": {
    //                 "yAxes": [{
    //                     "gridLines": {
    //                         "color": "#e7eaf3",
    //                         "drawBorder": false,
    //                         "zeroLineColor": "#e7eaf3"
    //                     },
    //                     "ticks": {
    //                         "min": 0,
    //                         "max": 10,
    //                         "stepSize": 2,
    //                         "fontColor": "#97a4af",
    //                         "fontFamily": "Open Sans, sans-serif",
    //                         "padding": 10,
    //                         "postfix": "k"
    //                     }
    //                 }],
    //                 "xAxes": [{
    //                     "gridLines": {
    //                         "display": false,
    //                         "drawBorder": false
    //                     },
    //                     "ticks": {
    //                         "fontSize": 12,
    //                         "fontColor": "#97a4af",
    //                         "fontFamily": "Open Sans, sans-serif",
    //                         "padding": 5
    //                     }
    //                 }]
    //             },
    //             "tooltips": {
    //                 "prefix": "$",
    //                 "postfix": "k",
    //                 "hasIndicator": true,
    //                 "mode": "index",
    //                 "intersect": false,
    //                 "lineMode": true,
    //                 "lineWithLineColor": "rgba(19, 33, 68, 0.075)"
    //             },
    //             "hover": {
    //                 "mode": "nearest",
    //                 "intersect": true
    //             },
    //             "legend": {
    //                 "align": "end",
    //                 "display": true
    //             }
    //         }
    //     });
    //     $.HSCore.components.HSChartJS.init($('#incomeChart'), {
    //         "type": "bar",
    //         "data": {
    //             "labels": ["May 1", "May 2", "May 3", "May 4", "May 5", "May 6", "May 7", "May 8", "May 9", "May 10"],
    //             "datasets": [{
    //                 "data": [200, 300, 290, 350, 150, 350, 300, 100, 125, 220],
    //                 "backgroundColor": "#377dff",
    //                 "hoverBackgroundColor": "#377dff",
    //                 "borderColor": "#377dff"
    //             },
    //                 {
    //                     "data": [150, 230, 382, 204, 169, 290, 300, 100, 300, 225, 120],
    //                     "backgroundColor": "#e7eaf3",
    //                     "borderColor": "#e7eaf3"
    //                 }]
    //         },
    //         "options": {
    //             "scales": {
    //                 "yAxes": [{
    //                     "gridLines": {
    //                         "color": "#e7eaf3",
    //                         "drawBorder": false,
    //                         "zeroLineColor": "#e7eaf3"
    //                     },
    //                     "ticks": {
    //                         "beginAtZero": true,
    //                         "stepSize": 100,
    //                         "fontSize": 12,
    //                         "fontColor": "#97a4af",
    //                         "fontFamily": "Open Sans, sans-serif",
    //                         "padding": 10,
    //                         "postfix": "$"
    //                     }
    //                 }],
    //                 "xAxes": [{
    //                     "gridLines": {
    //                         "display": false,
    //                         "drawBorder": false
    //                     },
    //                     "ticks": {
    //                         "fontSize": 12,
    //                         "fontColor": "#97a4af",
    //                         "fontFamily": "Open Sans, sans-serif",
    //                         "padding": 5
    //                     },
    //                     "categoryPercentage": 0.5,
    //                     "maxBarThickness": "10"
    //                 }]
    //             },
    //             "cornerRadius": 2,
    //             "tooltips": {
    //                 "prefix": "$",
    //                 "hasIndicator": true,
    //                 "mode": "index",
    //                 "intersect": false
    //             },
    //             "hover": {
    //                 "mode": "nearest",
    //                 "intersect": true
    //             }
    //         }
    //     });
    // }
});
