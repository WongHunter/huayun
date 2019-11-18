#coding:utf-8
from flask import Flask,render_template,url_for
import json
from flask_cors import CORS
from tool.conf import id,region_id,access_key_id,access_secret
from instance.instance_fip_in_monitor import Instance_Fip_In_Monitor
import time
import datetime
# 生成Flask实例
app = Flask(__name__)
CORS(app, supports_credentials=True)

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

if __name__ == '__main__':
    # 运行项目
    app.run(host='192.168.25.120', port=8080, debug=True, threaded=True)