<?php
    <<< JS
        var ctx = $("#" . $id);
        // console.log(ctx);
        var myChart = new Chart(ctx, {
            type: '$this->type',
            data: $this->data,
            plugins: [ChartDataLabels],
            options: {
                plugins: {
                    datalabels: {
                        display: true,
                        font: {
                            color: '#ffffff',
                            weight: 'bold',
                        }
                    },
                    doughnutlabel: {
                        labels: [{
                            font: {
                                size: 20,
                                weight: 'bold',
                            }
                            }, {
                            text: 'total'
                        }]
                    },
                    legend: {
                        position:'$this->legendPosition'
                    }
                },
                scales: {
                    y: {
                        max: $this->maxY,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
        $(document).on('click', '.chart-js-day', function (e) {
            let _this = $( this );

            $('.datepicker').datetimepicker({
                dateFormat: 'dd-MM-yyyy',
                onChangeDateTime: function (dp, $input) {
                    // let data = changeDate($input.val(), 'week');
                    // let chart = _this.parent().next();
                    // let chart = myChart;
                    // chart.datasets[0].data[3] = 20;
                    // chart.data.datasets[1].value = 50;
                    myChart.data.datasets[0].data[11] = 9;
                    // myChart.data.labels[12] = 'work';
                    // console.log(myChart.data.datasets[0].data[12] = 32 );
                    myChart.update();

                }
            });


            // let s = $('.datepicker').data("DateTimePicker").date();
            // console.log(date.unix());
        });


        function changeDate(date, type)
        {
            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: '/adm/chart/main/change-date?date=' + date + '&type=' + type,
                success: function(data){
                    
                }
            });
        }
    JS;
?>