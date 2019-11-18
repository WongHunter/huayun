var main_show = echarts.init(document.getElementById("main_show"));
 function getNet(times,dataIn,dataOut){
        option = {
            title: {
                text: '公网速率',
                x: 'center'
            },
            tooltip: {
                trigger: 'axis',
                axisPointer: {
                    animation: false
                }
            },
            legend: {
                data:['流入','流出'],
                x: 'left'
            },
            toolbox: {
                feature: {
                    dataZoom: {
                        yAxisIndex: 'none'
                    },
                    restore: {},
                    saveAsImage: {}
                }
            },
            axisPointer: {
                link: {xAxisIndex: 'all'}
            },
            dataZoom: [
                {
                    show: true,
                    realtime: true,
                    start: 30,
                    end: 70,
                    xAxisIndex: [0, 1]
                },
                {
                    type: 'inside',
                    realtime: true,
                    start: 30,
                    end: 70,
                    xAxisIndex: [0, 1]
                }
            ],
            grid: [{
                left: 50,
                right: 50,
                height: '35%'
            }, {
                left: 50,
                right: 50,
                top: '55%',
                height: '35%'
            }],
            xAxis : [
                {
                    type : 'category',
                    boundaryGap : false,
                    axisLine: {onZero: true},
                    data:times
                },
                {
                    gridIndex: 1,
                    type : 'category',
                    boundaryGap : false,
                    axisLine: {onZero: true},
                    data: times,
                    position: 'top'
                }
            ],
            yAxis : [
                {
                    name : '流入(bps)',
                    type : 'value',
                    max : 500
                },
                {
                    gridIndex: 1,
                    name : '流出(bps)',
                    type : 'value',
                    inverse: true
                }
            ],
            series : [
                {
                    name:'流入',
                    type:'line',
                    symbolSize: 8,
                    hoverAnimation: false,
                    data:dataIn
                },
                {
                    name:'流出',
                    type:'line',
                    xAxisIndex: 1,
                    yAxisIndex: 1,
                    symbolSize: 8,
                    hoverAnimation: false,
                    data:dataOut
                }
            ]
        };
            main_show.setOption(option);
        }

   function getNetIn(){
    request('InstanceFipOutMonitor').then(function (result) {
            request('InstanceFipInMonitor').then(function (inMonitorResult) {
                    var resultData = processing(result);
                     var times = processing(result, true);
                     var inMonitorResultData = processing(inMonitorResult);
                     getNet(times[0],inMonitorResultData[0],resultData[0]);
          }).catch(function (error) {
        console.error(error);
    })
})
    setTimeout(() => {
        getNetIn();
    }, 1000);
}
getNetIn();
