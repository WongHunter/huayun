 #!/usr/bin/python3
import pymongo
import json
import time
# Mongo
list = ['InstanceCpuMonitor', 'InstanceRamMonitor','InstanceDiskUsedMonitor','InstanceIoReadMonitor','InstanceIoWriteMonitor','InstanceIopsReadMonitor',\
        'InstanceIopsWriteMonitor','InstanceFipInMonitor','InstanceFipOutMonitor','RouterInMonitor','RouterOutMonitor','LbCurrentConnectionsMnt',\
        'LbCurrentQueuedConnectionsMnt','LbTotalConnectionsMnt','LbRateMnt','LbAverageConnectTimeMnt','LbAverageResponseTimeMnt','LbVipBytesInMnt',\
        'LbVipBytesOutMnt','LbBackendStatusUpMnt','LbBackendStatusDownMnt'];
list1=['RunInstance','StartInstance','StopInstance','RebootInstance','TerminateInstance','ResizeInstance','ChangeInstanceFirewall'\
       'TerminateInstance','ChangeInstancePassword','RebuildInstance','ModifyInstanceAttributes','RenewInstance','ChangeInstanceInterface']
def save_Mongo(dict,Action):
    if dict.setdefault('code', None) == 10000:
        json_str = json.dumps(dict['data'])
        dict1 = json.loads(json_str)
        dict1['_id'] = dict1.pop('TaskId')
        if Action in list :
            myclient = pymongo.MongoClient("mongodb://localhost:27017/")
            mydb = myclient["cloud"]
            mycol = mydb[Action]
            mycol.insert_one(dict1)
            print("TrueMonitorMessage")
            return dict1
        elif Action in list1 :
            myclient = pymongo.MongoClient("mongodb://localhost:27017/")
            mydb = myclient["cloud"]
            mycol = mydb['Instance']
            mycol.insert_one(dict1)
            print("TrueMonitorMessage")
            return dict1
    else:
        myclient = pymongo.MongoClient("mongodb://localhost:27017/")
        mydb = myclient["cloud"]
        mycol = mydb["ErrorMessage"]
        dict1 = {'Date': time.strftime("%Y-%m-%dT%H:%M:%S +0800", time.localtime())}
        dict1.update(dict)
        dict2={'Action':Action}
        dict1.update(dict2)
        mycol.insert_one(dict1)
        print("ErrorMessage")
        return dict1
