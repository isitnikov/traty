<?php
require 'header.php';
?>
<div class="container">

    <ul class="nav nav-pills">
        <li class="<?= $navDateClass ?>"><a href="<?= App::getBaseUrl() . '?controller=report&action=view&report_type=date' ?>">Дни</a></li>
        <li class="<?= $navWeekClass ?>"><a href="<?= App::getBaseUrl() . '?controller=report&action=view&report_type=week' ?>">Недели</a></li>
        <li class="<?= $navMonthClass ?>"><a href="<?= App::getBaseUrl() . '?controller=report&action=view&report_type=month' ?>">Месяца</a></li>
    </ul>

    <table class="table">
        <caption class="text-left">Отчет за <?= GeneralHelper::getDateLabel($date, $reportType) ?></caption>
        <tr>
            <th>Категория</th>
            <th class="text-right">Сумма</th>
        </tr>
        <?php foreach($db->getOperationsGroupedBy($reportType, $date) as $category): ?>
        <tr class="category-row">
            <?php
            $amount = $category['amount'];
            $amountAll[] = $amount;
            ?>
            <td class="category_name"><?= $category['name'] ?></td>
            <td class="text-right"><span class="amount"><?= $amount ?></span> грн.</td>
        </tr>
        <?php endforeach ?>
        <tfoot>
        <tr>
            <td class="text-right" colspan="2"><strong>Итого: <?= array_sum($amountAll) ?> <?= GeneralHelper::getCurrencySign() ?></strong></td>
        </tr>
        </tfoot>
    </table>
    <script src="http://code.highcharts.com/highcharts.js"></script>
    <div id="chart" style="width: 300px; height: 200px"></div>
    <script>
        $(function () {



            /**
             * Grid theme for Highcharts JS
             * @author Torstein Hønsi
             */

            Highcharts.theme = {
                colors: ['#058DC7', '#50B432', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4'],
                chart: {
                    borderWidth: 0,
                    plotBackgroundColor: 'rgba(255, 255, 255, .9)',
                    plotShadow: true,
                    plotBorderWidth: 0
                },
                title: {
                    style: {
                        color: '#000',
                        font: 'bold 16px "Trebuchet MS", Verdana, sans-serif'
                    }
                },
                subtitle: {
                    style: {
                        color: '#666666',
                        font: 'bold 12px "Trebuchet MS", Verdana, sans-serif'
                    }
                },
                xAxis: {
                    gridLineWidth: 1,
                    lineColor: '#000',
                    tickColor: '#000',
                    labels: {
                        style: {
                            color: '#000',
                            font: '11px Trebuchet MS, Verdana, sans-serif'
                        }
                    },
                    title: {
                        style: {
                            color: '#333',
                            fontWeight: 'bold',
                            fontSize: '12px',
                            fontFamily: 'Trebuchet MS, Verdana, sans-serif'

                        }
                    }
                },
                yAxis: {
                    minorTickInterval: 'auto',
                    lineColor: '#000',
                    lineWidth: 1,
                    tickWidth: 1,
                    tickColor: '#000',
                    labels: {
                        style: {
                            color: '#000',
                            font: '11px Trebuchet MS, Verdana, sans-serif'
                        }
                    },
                    title: {
                        style: {
                            color: '#333',
                            fontWeight: 'bold',
                            fontSize: '12px',
                            fontFamily: 'Trebuchet MS, Verdana, sans-serif'
                        }
                    }
                },
                legend: {
                    itemStyle: {
                        font: '9pt Trebuchet MS, Verdana, sans-serif',
                        color: 'black'

                    },
                    itemHoverStyle: {
                        color: '#039'
                    },
                    itemHiddenStyle: {
                        color: 'gray'
                    }
                },
                labels: {
                    style: {
                        color: '#99b'
                    }
                },

                navigation: {
                    buttonOptions: {
                        theme: {
                            stroke: '#CCCCCC'
                        }
                    }
                }
            };

// Apply the theme
            var highchartsOptions = Highcharts.setOptions(Highcharts.theme);



            var chartData = [];
            var name = $('td.category_name').each(function(key, value){
                chartData.push(new Array($(this).text(), parseInt($(this).next().children().text())))
            });
            var price = $('td span.amount').html();

            $('#chart').highcharts({
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false
                },
                title: {
                    text: ''
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: false,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: false,
                            color: '#000000',
                            connectorColor: '#000000',
                            format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                        },
                        showInLegend: true
                    }
                },
                series: [{
                    type: 'pie',
                    name: 'Процент: ',
                    data: chartData
                }]
            });
        });


    </script>
</div>
</body>
</html>