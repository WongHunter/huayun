# !/usr/bin/python3
import pymongo
import json
import time
from sqlalchemy import Column, String, create_engine
from sqlalchemy.orm import sessionmaker
from sqlalchemy.ext.declarative import declarative_base
from datebase.save_mongo import save_Mongo
# 创建对象的基类:
Base = declarative_base()

# 定义User对象:
class User(Base):
    # 表的名字:
    __tablename__ = 'user'

    # 表的结构:
    Id = Column(String(20), primary_key=True)
    Name = Column(String(20))
class Instances(Base):
    __tablename__ = 'instances'
    Id = Column(String(50), primary_key=True)
    Name = Column(String(50))
    Status=Column(String(50))
    ProductStatus=Column(String(50))
    PayType=Column(String(50))
    Cpu=Column(Base.Integer)
    Memory=Column(String(50))
    Password=Column(String(50))
    KeyPairName=Column(String(50))
    CreateTime=Column(String(50))
    DueTime=Column(String(50))
    NetworkName=Column(String(50))
    IpAddress=Column(String(50))
    EIpAddress=Column(String(50))
    Bandwidth=Column(Base.Integer)
    EIPProductType=Column(String(50))
    Size=Column(String(50))
    VolumeName=Column(String(50))
    OsName=Column(String(50))
    OsBit=Column(Base.Integer)
    InstanceSeries=Column(String(50))
# 初始化数据库连接:
engine = create_engine('mysql+mysqlconnector://root:1@localhost:3306/cloud')
# 创建DBSession类型:
DBSession = sessionmaker(bind=engine)

def save_Mysql(dict):
    session = DBSession()
    new_user = User(dict)
    # 添加到session:
    session.add(new_user)
    # 提交即保存到数据库:
    session.commit()
    # 关闭session:
    session.close()
    return "MysqlTrue"