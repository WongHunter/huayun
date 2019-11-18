from flask_script import Manager
from flask_sqlalchemy import SQLAlchemy
from flask import Flask

app = Flask(__name__)
app.config['SQLALCHEMY_DATABASE_URI'] = 'mysql+pymysql://root:20111673@127.0.0.1:3306/demo'
db = SQLAlchemy(app)  #

manager = Manager(app)

#创建User用户，表名为user
class User(db.Model):
    __table__name = 'user'
    id = db.Column(db.Integer,primary_key=True)
    username = db.Column(db.String(20),index=True)
    sex = db.Column(db.Boolean,default=True)
    info = db.Column(db.String(50))

# 定义一个视图函数
@app.route('/create')
def create():
    # db.drop_all()  #删除仅为模型表
    db.create_all()  #创建模型表
    return '创建成功'

if __name__ == '__main__':
    manager.run()