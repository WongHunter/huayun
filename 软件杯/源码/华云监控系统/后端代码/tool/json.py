#!/usr/bing/env python
# -*- coding: utf-8 -*-
# @author: xiaoxiao
# @date  : 2018/12/7

dt = {}

def analysis_json_to_dict(json):
    # 如果传入的json是list
    if isinstance(json, list):
        # 遍历list的每个元素
        for i, val in enumerate(json):
            # 如果list的元素是一个字典
            if isinstance(val, dict):
                analysis_json_to_dict(val)
            # 否则，如果不是字典，则构建字典，其中value为''
            else:
                val_list = '{"' + str(val) + '":' + '""}'
                dt.update(eval(val_list))
    # 如果传入的json是一个dict
    elif isinstance(json, dict):
        # print("dict:" + str(json))
        # 遍历dict的每组元素
        for dict_key in json:
            dict_value = json[dict_key]
            # 如果dict_value是一个list
            if isinstance(dict_value, list):
                dt[dict_key] = {}
                # 遍历list，可能还有多组dict和其它结构，形如：[{"id" : 1,"name" : "Number1","age" : 11},{"id" : 2,"name" : "Number2","age" : 22}，"student"]，list里面有两组dict和一个元素student
                for i, val in enumerate(dict_value):
                    # 如果val是一个dict
                    if isinstance(val, dict):
                        # 遍历val（dict结构）
                        for val_k, val_value in val.items():
                            # 如果当前val_key已经存在于dt的key里面，则追加到这个key对应的value里面
                            if val_k in dt[dict_key].keys():
                                # 如果dt[dict_key][val_k]只有一个值，非list结构，则构造一个list，以保存多个值
                                if not isinstance(dt[dict_key][val_k], list):
                                    # 如果dt[dict_key][val_k]这个值是一个字符串
                                    if type(dt[dict_key][val_k]) is str:
                                        temp_str = str(dt[dict_key][val_k])
                                        dt[dict_key][val_k] = temp_str.strip(',').split(',')
                                    # 如果是int型，则先转成str，然后转换成list保存str，最后转换成list中保存int的值
                                    elif type(dt[dict_key][val_k]) is int:
                                        temp_str = str(dt[dict_key][val_k])
                                        dt[dict_key][val_k] = temp_str.strip(',').split(',')
                                        dt[dict_key][val_k] = [int(i) for i in dt[dict_key][val_k]]
                                    # 如果是float型，则先转成str，然后转换成list保存str，最后转换成list中保存float的值
                                    elif type(dt[dict_key][val_k]) is float:
                                        temp_str = str(dt[dict_key][val_k])
                                        dt[dict_key][val_k] = temp_str.strip(',').split(',')
                                        dt[dict_key][val_k] = [float(i) for i in dt[dict_key][val_k]]
                                    # 如果是bool型，则先转成str，然后转换成list保存str，最后转换成list中保存bool的值
                                    elif type(dt[dict_key][val_k]) is bool:
                                        temp_str = str(dt[dict_key][val_k])
                                        dt[dict_key][val_k] = temp_str.strip(',').split(',')
                                        dt[dict_key][val_k] = [bool(i) for i in dt[dict_key][val_k]]
                                    dt[dict_key][val_k].append(val_value)
                                # 否则，如果dt[val_k]已经是一个list，则直接追加到后面
                                else:
                                    dt[dict_key][val_k].append(val_value)
                            # 否则，如果当前val_key未存在于dt的key里面，则直接添加
                            else:
                                dt[dict_key][val_k] = val_value
                    # 否则，val不是dict，直接构造成dict形式，加入到dt中保存，如："student"：""
                    else:
                        val_list = '{"' + str(val) + '":' + '""}'
                        dt[dict_key].update(eval(val_list))
            # 否则，如果dict_value不是一个list
            else:
                # 如果当前key已经存在于dt里面，则追加到这个key对应的value里面
                if dict_key in dt.keys():
                    # 如果dt保存的value还不是list，则需要构造一个list
                    if not isinstance(dt[dict_key], list):
                        # 如果dt[dict_key][val_k]这个值是一个字符串
                        if isinstance(dt[dict_key], str):
                            temp_str = str(dt[dict_key])
                            dt[dict_key] = temp_str.strip(',').split(',')
                        # 否则，如果是int型或Boolean类型
                        else:
                            temp_str = str(dt[dict_key])
                            dt[dict_key] = temp_str.strip(',').split(',')
                            dt[dict_key] = [int(i) for i in dt[dict_key]]
                        dt[dict_key].append(dict_value)
                    # 否则，如果dt保存的值已经是list，直接追加
                    else:
                        dt[dict_key].append(dict_value)
                # 如果当前key未存在于dt里面，则直接增加key-value
                else:
                    dt[dict_key] = dict_value
    return dt