#coding:utf-8
from flask import Flask,render_template,url_for
import json
from flask_cors import CORS
from tool.conf import id,region_id,access_key_id,access_secret
from instance.instance_disk_used_monitor import InstanceDiskUsedMonitor
import time
import datetime
# 生成Flask实例
app = Flask(__name__)
CORS(app, supports_credentials=True)

@app.route('/InstanceDiskUsedMonitor/',methods=['GET','POST'])
def disk():
    start_time = (datetime.datetime.now() + datetime.timedelta(hours=-6)).strftime("%Y-%m-%d %H:%M:%S")
    end_time = time.strftime("%Y-%m-%d %H:%M:%S", time.localtime())
    jsonData = InstanceDiskUsedMonitor(region_id, access_key_id, access_secret,start_time,end_time,id)
    print(jsonData)
    j = json.dumps(jsonData['data'][ "Data"])
    return j

@app.route('/InstanceDiskUsedMonitor/<start_time>,<end_time>,<region_id>,<id>',methods=['GET','POST'])
def select_disk(start_time,end_time,region_id,id):
    jsonData = InstanceDiskUsedMonitor(region_id, access_key_id, access_secret, start_time, end_time, id)
    print(jsonData)
    j = json.dumps(jsonData['data']["Data"])
    return j

if __name__ == '__main__':
    # 运行项目
    app.run(host='192.168.25.120', port=8080, debug=True, threaded=True)