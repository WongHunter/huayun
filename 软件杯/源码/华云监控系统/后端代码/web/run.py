#coding:utf-8
from flask import Flask
import json
from flask_cors import CORS
from tool.conf import id,region_id,access_key_id,access_secret
from instance.describe_instances import Describe_Instance
from instance.instance_cpu_monitor import Instance_Cpu_Monitor
from instance.instance_ram_monitor import Instance_Ram_Monitor
from instance.instance_fip_out_monitor import Instance_Fip_Out_Monitor
from instance.instance_fip_in_monitor import Instance_Fip_In_Monitor
from instance.instance_disk_used_monitor import Instance_Disk_Used_Monitor
from instance.instance_io_read_monitor import Instance_Io_Read_Monitor
from instance.instance_io_write_monitor import Instance_Io_Write_Monitor
from instance.instance_iops_read_monitor import Instance_Iops_Read_Monitor
from instance.instance_iops_write_monitor import Instance_Iops_Write_Monitor
from instance.start_instance import Start_Instance
from instance.stop_instance import Stop_Instance
import time
import datetime
from web.select_log import Select_Log

# 生成Flask实例
app = Flask(__name__)
CORS(app, supports_credentials=True)

@app.route('/DescribeInstance/',methods=['GET','POST'])
def Instance():
    jsonData = Describe_Instance(region_id, access_key_id, access_secret)
    print(jsonData)
    j = json.dumps(jsonData['data'][ "InstanceSet"])
    return j

@app.route('/DescribeInstance/<region_id>',methods=['GET','POST'])
def select_instance(region_id):
    jsonData = Describe_Instance(region_id, access_key_id, access_secret)
    print(jsonData)
    j = json.dumps(jsonData['data']["InstanceSet"])
    return j

@app.route('/Start_Instance/<id>',methods=['GET','POST'])
def start_instance(id):
    jsonData = Start_Instance(region_id, access_key_id, access_secret,id)
    print(jsonData)
    j = json.dumps(jsonData['data'])
    return j                 

@app.route('/Stop_Instance/<id>')
def stop_instance(id):
    jsonData = Start_Instance(region_id, access_key_id, access_secret,id)
    print(jsonData)
    j = json.dumps(jsonData['data'])
    return j

@app.route('/InstanceCpuMonitor/',methods=['GET','POST'])
def cpu():
    start_time = (datetime.datetime.now() + datetime.timedelta(hours=-6)).strftime("%Y-%m-%d %H:%M:%S")
    end_time = time.strftime("%Y-%m-%d %H:%M:%S", time.localtime())
    jsonData = Instance_Cpu_Monitor(region_id, access_key_id, access_secret,start_time,end_time,id)
    print(type(jsonData))
    j = json.dumps(jsonData['data'][ "Data"])
    return j

@app.route('/InstanceCpuMonitor/<start_time>,<end_time>,<region_id>,<id>',methods=['GET','POST'])
def select_cpu(start_time,end_time,region_id,id):
    jsonData = Instance_Cpu_Monitor(region_id, access_key_id, access_secret, start_time, end_time, id)
    print(jsonData)
    j = json.dumps(jsonData['data']["Data"])
    return j

@app.route('/InstanceRamMonitor/',methods=['GET','POST'])
def ram():
    start_time = (datetime.datetime.now() + datetime.timedelta(hours=-6)).strftime("%Y-%m-%d %H:%M:%S")
    end_time = time.strftime("%Y-%m-%d %H:%M:%S", time.localtime())
    jsonData = Instance_Ram_Monitor(region_id, access_key_id, access_secret,start_time,end_time,id)
    print(jsonData)
    j = json.dumps(jsonData['data'][ "Data"])
    return j

@app.route('/InstanceRamMonitor/<start_time>,<end_time>,<region_id>,<id>',methods=['GET','POST'])
def select_ram(start_time,end_time,region_id,id):
    print(start_time,end_time)
    jsonData = Instance_Ram_Monitor(region_id, access_key_id, access_secret, start_time, end_time, id)
    print(jsonData)
    j = json.dumps(jsonData['data']["Data"])
    return j

@app.route('/InstanceFipInMonitor/',methods=['GET','POST'])
def fip_in():
    start_time = (datetime.datetime.now() + datetime.timedelta(hours=-6)).strftime("%Y-%m-%d %H:%M:%S")
    end_time = time.strftime("%Y-%m-%d %H:%M:%S", time.localtime())
    jsonData = Instance_Fip_In_Monitor(region_id, access_key_id, access_secret,start_time,end_time,id)
    print(jsonData)
    j = json.dumps(jsonData['data'][ "Data"])
    return j

@app.route('/InstanceFipInMonitor/<start_time>,<end_time>,<region_id>,<id>',methods=['GET','POST'])
def select_fip_in(start_time,end_time,region_id,id):
    print(start_time,end_time)
    jsonData = Instance_Fip_In_Monitor(region_id, access_key_id, access_secret, start_time, end_time, id)
    print(jsonData)
    j = json.dumps(jsonData['data']["Data"])
    return j

@app.route('/InstanceFipOutMonitor/',methods=['GET','POST'])
def fip_out():
    start_time = (datetime.datetime.now() + datetime.timedelta(hours=-6)).strftime("%Y-%m-%d %H:%M:%S")
    end_time = time.strftime("%Y-%m-%d %H:%M:%S", time.localtime())
    jsonData = Instance_Fip_Out_Monitor(region_id, access_key_id, access_secret,start_time,end_time,id)
    print(jsonData)
    j = json.dumps(jsonData['data'][ "Data"])
    return j

@app.route('/InstanceFipOutMonitor/<start_time>,<end_time>,<region_id>,<id>',methods=['GET','POST'])
def select_fip_out(start_time,end_time,region_id,id):
    print(start_time,end_time)
    jsonData = Instance_Fip_Out_Monitor(region_id, access_key_id, access_secret, start_time, end_time, id)
    print(jsonData)
    j = json.dumps(jsonData['data']["Data"])
    return j

@app.route('/InstanceDiskUsedMonitor/',methods=['GET','POST'])
def disk():
    start_time = (datetime.datetime.now() + datetime.timedelta(hours=-6)).strftime("%Y-%m-%d %H:%M:%S")
    end_time = time.strftime("%Y-%m-%d %H:%M:%S", time.localtime())
    jsonData = Instance_Disk_Used_Monitor(region_id, access_key_id, access_secret,start_time,end_time,id)
    print(jsonData)
    j = json.dumps(jsonData['data'][ "Data"])
    return j

@app.route('/InstanceDiskUsedMonitor/<start_time>,<end_time>,<region_id>,<id>',methods=['GET','POST'])
def select_disk(start_time,end_time,region_id,id):
    jsonData = Instance_Disk_Used_Monitor(region_id, access_key_id, access_secret, start_time, end_time, id)
    print(jsonData)
    j = json.dumps(jsonData['data']["Data"])
    return j

@app.route('/InstanceIoReadMonitor/',methods=['GET','POST'])
def io_read():
    start_time = (datetime.datetime.now() + datetime.timedelta(hours=-6)).strftime("%Y-%m-%d %H:%M:%S")
    end_time = time.strftime("%Y-%m-%d %H:%M:%S", time.localtime())
    jsonData = Instance_Io_Read_Monitor(region_id, access_key_id, access_secret,start_time,end_time,id)
    print(jsonData)
    j = json.dumps(jsonData['data'][ "Data"])
    return j

@app.route('/InstanceIoReadMonitor/<start_time>,<end_time>,<region_id>,<id>',methods=['GET','POST'])
def select_io_read(start_time,end_time,region_id,id):
    jsonData = Instance_Io_Read_Monitor(region_id, access_key_id, access_secret, start_time, end_time, id)
    print(jsonData)
    j = json.dumps(jsonData['data']["Data"])
    return j

@app.route('/InstanceIoWriteMonitor/',methods=['GET','POST'])
def io_write():
    start_time = (datetime.datetime.now() + datetime.timedelta(hours=-6)).strftime("%Y-%m-%d %H:%M:%S")
    end_time = time.strftime("%Y-%m-%d %H:%M:%S", time.localtime())
    jsonData = Instance_Io_Write_Monitor(region_id, access_key_id, access_secret,start_time,end_time,id)
    print(jsonData)
    j = json.dumps(jsonData['data'][ "Data"])
    return j

@app.route('/InstanceIoWriteMonitor/<start_time>,<end_time>,<region_id>,<id>',methods=['GET','POST'])
def select_io_write(start_time,end_time,region_id,id):
    jsonData = Instance_Io_Write_Monitor(region_id, access_key_id, access_secret, start_time, end_time, id)
    print(jsonData)
    j = json.dumps(jsonData['data']["Data"])
    return j

@app.route('/InstanceIopsReadMonitor/',methods=['GET','POST'])
def iops_read():
    start_time = (datetime.datetime.now() + datetime.timedelta(hours=-6)).strftime("%Y-%m-%d %H:%M:%S")
    end_time = time.strftime("%Y-%m-%d %H:%M:%S", time.localtime())
    jsonData = Instance_Iops_Read_Monitor(region_id, access_key_id, access_secret,start_time,end_time,id)
    print(jsonData)
    j = json.dumps(jsonData['data'][ "Data"])
    return j

@app.route('/InstanceIopsReadMonitor/<start_time>,<end_time>,<region_id>,<id>',methods=['GET','POST'])
def select_iops_read(start_time,end_time,region_id,id):
    jsonData = Instance_Iops_Read_Monitor(region_id, access_key_id, access_secret, start_time, end_time, id)
    print(jsonData)
    j = json.dumps(jsonData['data']["Data"])
    return j

@app.route('/InstanceIopsWriteMonitor/',methods=['GET','POST'])
def iops_write():
    start_time = (datetime.datetime.now() + datetime.timedelta(hours=-6)).strftime("%Y-%m-%d %H:%M:%S")
    end_time = time.strftime("%Y-%m-%d %H:%M:%S", time.localtime())
    jsonData = Instance_Iops_Write_Monitor(region_id, access_key_id, access_secret,start_time,end_time,id)
    print(jsonData)
    j = json.dumps(jsonData['data'][ "Data"])
    return j

@app.route('/InstanceIopsWriteMonitor/<start_time>,<end_time>,<region_id>,<id>',methods=['GET','POST'])
def select_iops_write(start_time,end_time,region_id,id):
    jsonData = Instance_Iops_Write_Monitor(region_id, access_key_id, access_secret, start_time, end_time, id)
    print(jsonData)
    j = json.dumps(jsonData['data']["Data"])
    return j

@app.route('/log/',methods=['GET'])
def log():
    f = open('action.log', 'r')
    return f.read()

@app.route('/errorlog/',methods=['GET'])
def error():
    f =open('error.log','r')
    return f.read()

@app.route('/monitorlog/',methods=['GET'])
def monitor():
    f = open('monitor.log', 'r')
    return f.read()


if __name__ == '__main__':

    # 运行项目
    app.run(host='192.168.25.120', port=5000, debug=True, threaded=True)