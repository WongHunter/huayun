
// var myChartOption = {
// // Make gradient line here
// visualMap: [{
//     show: false,
//     type: 'continuous',
//     seriesIndex: 0,
//     min: 0,
//     max: 400
// }, {
//     show: false,
//     type: 'continuous',
//     seriesIndex: 1,
//     dimension: 0,
//     min: 0,
//     max: 400
// }],


// title: [{
//     left: 'center',
//     text: '磁盘读IO'
// }, {
//     top: '55%',
//     left: 'center',
//     text: '磁盘写IO'
// }],
// tooltip: {
//     trigger: 'axis'
// },
// xAxis: {type: 'category',
// boundaryGap: false,data:[]} ,
// yAxis: [{
//     splitLine: {show: false}
// }, {
//     splitLine: {show: false},
//     gridIndex: 1
// }],
// grid: [{
//     left: 50,
//     right: 0,
//     height: '35%'
// }, {
//     left: 50,
//     right: 0,
//     top: '55%',
//     height: '35%'
// }],
// series: [{
//     type: 'line',
//     showSymbol: false,
//     data: []
// }, {
//     type: 'line',
//     showSymbol: false,
//     data: [],
//     xAxisIndex: 1,
//     yAxisIndex: 1
// }]
// };
var myChartOption = {
//   title: [{
//     left: 'left',
//     top:'50px',
//     color:'#ddd',
//     text: '磁盘读IO'
//  }],
    tooltip: {
        trigger: 'axis'
    },
    legend: {
        data:['磁盘读IO','磁盘写IO']
    },
    grid: {
        left: '3%',
        right: '4%',
        bottom: '3%',
        containLabel: true
    },
    toolbox: {
        feature: {
            saveAsImage: {}
        }
    },
    xAxis: {
        type: 'category',
        boundaryGap: false,
        data: []||['12:00','16:00','20:00','14:00','04:00','08:00']
    },
    yAxis: {
        type: 'value'
    },
    series: [
        {
            name:'磁盘读IO',
            type:'line',
            stack: '总量',
            data:[]||[120, 132, 101, 134, 90, 230, 210]
        },
        {
            name:'磁盘写IO',
            type:'line',
            stack: '总量',
            data:[]||[820, 932, 901, 934, 1290, 1330, 1320]
        }
    ]
    };
var mainOption = {
tooltip: {
    trigger: 'axis'
},
legend: {
    data:['磁盘读IOPS','磁盘写IOPS']
},
grid: {
    left: '3%',
    right: '4%',
    bottom: '3%',
    containLabel: true
},
toolbox: {
    feature: {
        saveAsImage: {}
    }
},
xAxis: {
    type: 'category',
    boundaryGap: false,
    data: []||['12:00','16:00','20:00','14:00','04:00','08:00']
},
yAxis: {
    type: 'value'
},
series: [
    {
        name:'磁盘读IOPS',
        type:'line',
        stack: '总量',
        data:[]||[120, 132, 101, 134, 90, 230, 210]
    },
    {
        name:'磁盘写IOPS',
        type:'line',
        stack: '总量',
        data:[]||[820, 932, 901, 934, 1290, 1330, 1320]
    }
]
};
var diskOption = {
title: [{
    left: 'center',
    text: '磁盘使用率'
}],
xAxis: {
    type: 'category',
    data: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']
},
yAxis: {
    type: 'value'
},
series: [{
    data: [] ||  [820, 932, 901, 934, 1290, 1330, 1320],
    type: 'line',
    smooth: true
}]
};


var elementOptions = [
    {
        url:['InstanceIopsWriteMonitor', 'InstanceIopsReadMonitor'],
        id: 'main',
        options:mainOption
    },
    {
        url: 'InstanceDiskUsedMonitor',
        id: 'disk',
        options:diskOption
    },
    {
        url: ['InstanceIoReadMonitor','InstanceIoWriteMonitor'],
        id: 'myChart',
        options:myChartOption
    }
]

elementOptions.forEach(function(item) {
    if(Array.isArray(item.url)){
        request(item.url[0]).then(function(result){
            request(item.url[1]).then(function(opResult){
                var data = processing(result);
                var opData = processing(opResult);
                var timeData = processing(result, true);
                var element = $("#"+item.id);
                data.map(function(dataItem,index){
                    var div =  $('<div></div>', {
                    id: item.id + index,
                    width: 500,
                    height:300
                    })
                    element.append(div);
                    var chart = echarts.init(document.getElementById(item.id + index));
                    if(item.id === 'main') {
                        item.options.series[0].data =dataItem;
                        item.options.series[1].data =opData[index];
                    } else if(item.id === 'myChart') {
                    item.options.xAxis.data = timeData[index];
                    item.options.series[0].data =dataItem;
                    item.options.series[1].data =opData[index];
                    }
                    console.log(item.options)

                    

                    chart.setOption(item.options);
                 })
            })
        })
    } else {
        request(item.url).then(function(result){
           var data = processing(result);
           var timeData = processing(result, true);
           var element =$('#'+item.id);
           element.html('');
             data.map(function(dataItem,index){
                var div =  $('<div></div>', {
                id: item.id + index,
                width: 500,
                height:300
                })
                element.append(div);
                var chart = echarts.init(document.getElementById(item.id + index));
                item.options.series[0].data =dataItem;
                
                chart.setOption(item.options);
             })
           })
        // })
    }
})