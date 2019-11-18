#!/usr/bin/python3
def Select_Log(file_name):
    try:
        f = open(file_name, 'r')
        s=f.read()
    finally:
        if f:
            f.close()
            print("err")
            return 'fales'
    return  s