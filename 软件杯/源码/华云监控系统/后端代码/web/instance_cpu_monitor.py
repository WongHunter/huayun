#coding:utf-8
from flask import Flask,render_template,url_for
import json
from flask_cors import CORS
from tool.conf import id,region_id,access_key_id,access_secret
from instance.instance_cpu_monitor import Instance_Cpu_Monitor
import time
import datetime
# 生成Flask实例
app = Flask(__name__)
CORS(app, supports_credentials=True)

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

if __name__ == '__main__':
    # 运行项目
    app.run(host='192.168.25.120', port=8080, debug=True, threaded=True)