function request(url,options) {

    var option = options || {}
    return new Promise((resolve, reject) => {
        $.ajax({
            url: "http://192.168.25.120:5000/"+url,
            data:option.data,
            async: option.async || true,
            dataType:'json',
            success: function (result) {
                resolve(result)
            },
            error: function (error) {
                reject(error);
            }
        })
    })
}



function processing(result,isTime) {
    if(result) {
       return result.map(data => {
        return data.Data.slice(0,15).map(function(item) {
            return  isTime ? item[0].slice(11,16) :  Math.floor( parseInt(item[1]) );
        });
        });
    }
}
