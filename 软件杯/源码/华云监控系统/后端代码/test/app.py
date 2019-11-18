import datetime
import time
end_time= time.strftime("%Y-%m-%d %H:%M:%S", time.localtime())
start_time = (datetime.datetime.now() + datetime.timedelta(hours=-6)).strftime("%Y-%m-%d %H:%M:%S")
print(start_time,end_time)