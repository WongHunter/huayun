#coding:utf-8
from flask import Flask,render_template,url_for
import json
from flask_cors import CORS
# 生成Flask实例
app = Flask(__name__)
CORS(app, supports_credentials=True)

@app.route('/login/',methods=['GET','POST'])
def default():
    jsonData = { }
    jsonData = ''
    print(jsonData)
    j = json.dumps(jsonData)
    return j

@app.route('/home/<start_time>,<end_time>',methods=['GET','POST'])
def select(start_time,end_time):
    print(start_time,end_time)
    jsonData = {}
    jsonData = ''
    print(jsonData)
    j = json.dumps(jsonData)
    # 在浏览器上渲染my_template.html模板（为了查看输出的数据）
    return j

if __name__ == '__main__':
    # 运行项目
    app.run(host='192.168.25.120', port=5000, debug=True, threaded=True)