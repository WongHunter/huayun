#coding:utf-8
from flask import Flask,render_template,url_for
import json
from flask_cors import CORS
from tool.conf import id,region_id,access_key_id,access_secret
from instance.describe_instances import Describe_Instance

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

if __name__ == '__main__':

    # 运行项目
    app.run(host='192.168.25.120', port=8080, debug=True, threaded=True)