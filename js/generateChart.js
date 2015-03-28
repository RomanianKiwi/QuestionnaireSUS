    /*
     * @param nameSystem : the name of the system
     * @param versions : array containing the differents versions of the system
     * @apram results : array containing all results of each versions of the 
     *                  system
     */
    function generateChart (cible,nameSystem, versions, results) {
        $('#chartContainer'+cible+'').highcharts({
            chart: {
                type: 'spline'
            },
            credits: {
                enabled: false
            },
            title: {
                text: 'Score SUS de ' + nameSystem + ' au fil de ses versions'
            },
            subtitle: {
                text: 'Source: thesource.com by Gones'
            },
            xAxis: {
                title :{
                    text: 'Version'
                },
                categories: versions
            },
            yAxis: {
                title: {
                    text: 'Score SUS (pts)'
                }
            },
            tooltip: {
                valueSuffix : ' pts'
            },
            plotOptions: {
                spline: {
                    marker: {
                        radius: 4,
                        lineColor: '#666666',
                        lineWidth: 1
                    }
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [{
                name: nameSystem,
                color: '#FFDA00',
                marker: {
                    symbol: 'circle'
                },
                data: results
            }]
        });
    }