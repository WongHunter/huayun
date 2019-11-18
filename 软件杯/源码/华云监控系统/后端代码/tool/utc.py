import pytz
import datetime
import time
def utc_to_local(utc_time_str, utc_format='%Y-%m-%dT%H:%M:%SZ'):
    local_tz = pytz.timezone('Asia/Chongqing')      #定义本地时区
    utc_dt = datetime.datetime.strptime(utc_time_str, utc_format)
    print(utc_dt)#讲世界时间的格式转化为datetime.datetime格式
    return utc_dt
print(utc_to_local('2019-06-14T03:33:00Z','%Y-%m-%dT%H:%M:%SZ'))
