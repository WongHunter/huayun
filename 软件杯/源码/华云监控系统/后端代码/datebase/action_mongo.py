#!/usr/bin/python3

import pymongo

table='InstanceCpuMonitor'

myclient = pymongo.MongoClient("mongodb://localhost:27017/")
mydb = myclient["cloud"]
mycol = mydb[table]

print(str(mycol.find()))
