from instance.instance_cpu_monitor import Instance_Cpu_Monitor
import datetime
import time
from tool.conf import id,region_id,access_key_id,access_secret

start_time = (datetime.datetime.now() + datetime.timedelta(hours=-6)).strftime("%Y-%m-%d %H:%M:%S")
end_time = time.strftime("%Y-%m-%d %H:%M:%S", time.localtime())
jsonData = {}
jsonData = Instance_Cpu_Monitor(region_id, access_key_id, access_secret,start_time,end_time,id)
print(jsonData['data'][ "Data"])
for i in jsonData['data'][ "Data"]:
    print({i[0]:i[1]})