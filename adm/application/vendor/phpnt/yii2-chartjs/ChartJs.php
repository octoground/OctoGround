<?php
/**
 * Created by PhpStorm.
 * User: phpNT - http://phpnt.com
 * Date: 27.04.2017
 * Time: 9:26
 */

namespace phpnt\chartJS;

use yii\bootstrap\Widget;
use yii\helpers\Json;

class ChartJs extends Widget
{
    const TYPE_LINE             = 'line';
    const TYPE_BAR              = 'bar';
    const TYPE_RADAR            = 'radar';
    const TYPE_POLAR_AREA       = 'polarArea';
    const TYPE_PIE              = 'pie';
    const TYPE_DOUGHNUT         = 'doughnut';
    const TYPE_BUBBLE           = 'bubble';

    public $type;
    public $width;
    public $maxY; // Максимально допустимое значение шкалы Y
    public $legendPosition;
    public $data                = [];
    public $options             = [];

    public function init()
    {
        parent::init();
        $this->type = $this->type ? $this->type : 'line';
        $this->data = Json::encode($this->data);
        $this->options = Json::encode($this->options);
    }

    public function run()
    {
        $this->registerScript();
        echo '<ul class="char_btn">';
            echo '<li><button type="button" class="og-btn og-btn-standart chart-js-type datepicker" data-type="week">Неделя</button></li>';
            echo '<li><button type="button" class="og-btn og-btn-standart chart-js-type datepicker-month" data-type="month">Месяц</button></li>';
            echo '<li><button type="button" class="og-btn og-btn-standart chart-js-type datepicker-year" data-type="year">Год</button></li>';
        echo '</ul>';

        echo '<div style="width:' . $this->width . '">';
        echo '<canvas id="'.$this->id.'"></canvas>';
        echo '</div>';
    }

    public function registerScript()
    {
        $view = $this->getView();
        ChartJSAsset::register($view);

        $js = <<< JS
            var ctx = $("#$this->id");
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

            $(document).on('click', '.chart-js-type', function (e) {
                let type = $( this ).attr('data-type');
                // console.log(type);
                if (type === 'year'){
                    // addData(, type');
                    var d = new Date();
                    var strDate = d.getDate() + "." + (d.getMonth()+1) + "." + d.getFullYear() ;
                    addData(strDate, type);
                }
                if (type === 'week'){
                    $('.datepicker').datetimepicker({
                        dateFormat: 'dd-MM-yyyy',
                        onChangeDateTime: function (dp, _input) {
                            addData(_input.val(), type);
                        }
                    });
                }
               
            });

            function addData(date, type)
            {
                $.ajax({
                    type: 'POST',
                    dataType: 'JSON',
                    url: '/adm/chart/main/change-date?date=' + date + '&type=' + type,
                    success: function(data){
                        let items = data.content;
                        removeData();

                        myChart.data.labels = data.labels;
                        myChart.data.datasets = data.content;
                        myChart.update();
                    }
                });
            }

            function removeData()
            {
                myChart.data.labels.pop();
                myChart.data.datasets.forEach((dataset) => {
                    dataset.data.pop();
                });
                return myChart.update();
            }
JS;
        
        $view->registerJs($js);
    }
}
