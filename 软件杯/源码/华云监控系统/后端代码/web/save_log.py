 #!/usr/bin/python3
import pymongo
import json
import time
import os
# Mongo
list = ['InstanceCpuMonitor', 'InstanceRamMonitor','InstanceDiskUsedMonitor','InstanceIoReadMonitor','InstanceIoWriteMonitor','InstanceIopsReadMonitor',\
        'InstanceIopsWriteMonitor','InstanceFipInMonitor','InstanceFipOutMonitor','RouterInMonitor','RouterOutMonitor','LbCurrentConnectionsMnt',\
        'LbCurrentQueuedConnectionsMnt','LbTotalConnectionsMnt','LbRateMnt','LbAverageConnectTimeMnt','LbAverageResponseTimeMnt','LbVipBytesInMnt',\
        'LbVipBytesOutMnt','LbBackendStatusUpMnt','LbBackendStatusDownMnt'];
list1=['RunInstance','StartInstance','StopInstance','RebootInstance','TerminateInstance','ResizeInstance','ChangeInstanceFirewall'\
       'TerminateInstance','ChangeInstancePassword','RebuildInstance','ModifyInstanceAttributes','RenewInstance','ChangeInstanceInterface']
def save_log(dict,Action):
    if dict.setdefault('code', None) == 10000:
        json_str = json.dumps(dict['data'])
        if Action in list :
            f = open('monitor.log', 'wb+')
            f.write((json_str).encode('utf-8'))
            print("MonitorMessage")
            return json_str
        elif Action in list1 :
            f = open('action.log', 'w')
            f.write('11')
            f.close()
            print("ActionMessage")
            return json_str
    else:
        dict1 = {'Date': time.strftime("%Y-%m-%dT%H:%M:%S +0800", time.localtime())}
        dict1.update(dict)
        dict2 = {'Action': Action}
        dict1.update(dict2)
        json_str1=json.dumps(dict1)
        print(json_str1)
        f = open('error.log', 'wb+')
        f.write(json_str1)
        print("ErrorMessage")
        return json_str1
