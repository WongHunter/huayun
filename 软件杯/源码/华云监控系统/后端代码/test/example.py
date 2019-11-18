# -*- coding: UTF-8 -*-
from flask import Flask,render_template,url_for
import pymysql
import json
from instance.describe_instances import Describe_Instance
from flask_cors import CORS

region_id='cn-huaian'
access_key_id='32a0c827d06443d79fd10295367f7ab4'
access_secret='b3e35170b725442e9a45e9b1aed2b088'

def prn_obj(obj):
    print ('\n'.join(['%s:%s' % item for item in obj.__dict__.items()]))

# 自定义类
class MyClass:
    # 初始化
    def __init__(self):
        self.a = 2
##########################
# 字典转字符串json
json_str = Describe_Instance(region_id, access_key_id, access_secret)
print(json_str)
print(type(json_str))
#json转字典
json_dict = json.loads(json_str)
print(type(json_dict))
# 新建一个新的MyClass对象
myClass1 = MyClass()
# 将字典转化为对象
myClass1.__dict__ = json_dict
print(type(myClass1))
#类变量是字典
print(type(myClass1.data))

json_str1 = json.dumps(myClass1.data)
print(type(json_str1))
#json转字典
json_dict1 = json.loads(json_str1)
print(type(json_dict1))
# 新建一个新的MyClass对象
myClass2 = MyClass()
# 将字典转化为对象
myClass2.__dict__ = json_dict1
print(prn_obj(myClass2))

json_str2 = json.dumps(myClass2.InstanceSet)
print(type(json_str2))
#json转字典
json_dict2 = json.loads(json_str2)
print(type(json_dict2))
# 新建一个新的MyClass对象
myClass3 = MyClass()
# 将字典转化为对象

print(type(json_dict2[0]))
print(json_dict2[0])
myClass3.__dict__ = json_dict2[0]
print(prn_obj(myClass3))

jsonData = {}
Id = []
Name = []
Status=[]
ProductStatus=[]
PayType=[]
Cpu=[]
Memory=[]
Password=[]
KeyPairName=[]
CreateTime=[]
DueTime=[]
NetworkName=[]
IpAddress=[]
EIpAddress=[]
Bandwidth=[]
EIPProductType=[]
Size=[]
VolumeName=[]
OsName=[]
OsBit=[]
InstanceSeries=[]




